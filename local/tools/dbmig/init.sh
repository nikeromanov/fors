#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
# shellcheck disable=SC1091
source "$SCRIPT_DIR/common.sh"

status="$(read_master_status || true)"
if [[ -z "$status" ]]; then
  echo "ERROR: binlog is disabled or unavailable."
  echo "Enable MariaDB binary log first, then rerun init." >&2
  exit 1
fi

read -r file pos <<<"$status"
save_cursor "$file" "$pos"

echo "Initialized cursor: $file:$pos"
echo "Cursor file: $CURSOR_FILE"
