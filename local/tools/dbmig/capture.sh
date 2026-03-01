#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
# shellcheck disable=SC1091
source "$SCRIPT_DIR/common.sh"

load_cursor
start_file="$BINLOG_FILE"
start_pos="$BINLOG_POS"

status="$(read_master_status || true)"
if [[ -z "$status" ]]; then
  echo "ERROR: binlog is disabled or unavailable." >&2
  exit 1
fi
read -r end_file end_pos <<<"$status"

if [[ "$start_file" == "$end_file" && "$start_pos" == "$end_pos" ]]; then
  echo "No DB changes since cursor ($start_file:$start_pos)."
  exit 0
fi

out_file="$(next_migration_file)"
{
  echo "-- Auto-captured DB migration"
  echo "-- Generated: $(date -u +"%Y-%m-%dT%H:%M:%SZ")"
  echo "-- DB: ${APP_DB_NAME}"
  echo "-- Range: ${start_file}:${start_pos} -> ${end_file}:${end_pos}"
  echo
} > "$out_file"

range="$(get_binlog_range "$start_file" "$end_file")"
if [[ -z "$range" ]]; then
  echo "ERROR: unable to resolve binlog range $start_file..$end_file" >&2
  rm -f "$out_file"
  exit 1
fi

while IFS= read -r logf; do
  [[ -z "$logf" ]] && continue
  start_opt=""
  stop_opt=""
  if [[ "$logf" == "$start_file" ]]; then
    start_opt="--start-position=${start_pos}"
  fi
  if [[ "$logf" == "$end_file" ]]; then
    stop_opt="--stop-position=${end_pos}"
  fi

  compose_exec_db sh -lc "mysqlbinlog --database='${APP_DB_NAME}' ${start_opt} ${stop_opt} /var/lib/mysql/${logf}" >> "$out_file"
done <<< "$range"

if [[ ! -s "$out_file" ]]; then
  echo "ERROR: empty migration output." >&2
  rm -f "$out_file"
  exit 1
fi

save_cursor "$end_file" "$end_pos"

echo "Captured migration: $out_file"
echo "Cursor moved to: $end_file:$end_pos"
