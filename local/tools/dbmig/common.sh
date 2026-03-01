#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SITE_ROOT="$(cd "${SCRIPT_DIR}/../../.." && pwd)"
STACK_DIR_DEFAULT="$(cd "${SITE_ROOT}/../.." && pwd)"

STACK_DIR="${STACK_DIR:-$STACK_DIR_DEFAULT}"
STACK_COMPOSE_FILE="${STACK_COMPOSE_FILE:-${STACK_DIR}/docker-compose.yml}"
STACK_SERVICE_DB="${STACK_SERVICE_DB:-db}"

ROOT_DB_USER="${ROOT_DB_USER:-root}"
ROOT_DB_PASS="${ROOT_DB_PASS:-root}"

APP_DB_NAME="${APP_DB_NAME:-fors36_site}"
APP_DB_USER="${APP_DB_USER:-fors36_user}"
APP_DB_PASS="${APP_DB_PASS:-}"

MIG_DIR="${MIG_DIR:-${SITE_ROOT}/local/db/migrations}"
BINLOG_DIR="${BINLOG_DIR:-${MIG_DIR}/binlog}"
STATE_DIR="${STATE_DIR:-${MIG_DIR}/state}"
CURSOR_FILE="${CURSOR_FILE:-${STATE_DIR}/cursor.env}"

mkdir -p "$BINLOG_DIR" "$STATE_DIR"

detect_docker_bin() {
  if command -v docker >/dev/null 2>&1; then
    command -v docker
    return 0
  fi
  if [[ -x "/usr/local/bin/docker" ]]; then
    echo "/usr/local/bin/docker"
    return 0
  fi
  return 1
}

DOCKER_BIN="${DOCKER_BIN:-$(detect_docker_bin || true)}"
if [[ -z "$DOCKER_BIN" ]]; then
  echo "ERROR: docker binary not found in PATH and /usr/local/bin/docker is unavailable." >&2
  exit 1
fi

compose_exec_db() {
  "$DOCKER_BIN" compose -f "$STACK_COMPOSE_FILE" exec -T "$STACK_SERVICE_DB" "$@"
}

mysql_root_exec() {
  compose_exec_db mysql -N -B -u"$ROOT_DB_USER" -p"$ROOT_DB_PASS" "$@"
}

read_master_status() {
  mysql_root_exec -e "SHOW MASTER STATUS" | awk 'NR==1 {print $1" "$2}'
}

load_cursor() {
  if [[ ! -f "$CURSOR_FILE" ]]; then
    echo "Cursor not initialized: $CURSOR_FILE" >&2
    echo "Run: local/tools/dbmig/init.sh" >&2
    exit 1
  fi
  # shellcheck disable=SC1090
  source "$CURSOR_FILE"
  : "${BINLOG_FILE:?missing BINLOG_FILE in cursor}"
  : "${BINLOG_POS:?missing BINLOG_POS in cursor}"
}

save_cursor() {
  local file="$1"
  local pos="$2"
  cat > "$CURSOR_FILE" <<EOF
BINLOG_FILE=${file}
BINLOG_POS=${pos}
UPDATED_AT=$(date -u +"%Y-%m-%dT%H:%M:%SZ")
EOF
}

get_binlog_range() {
  local start_file="$1"
  local end_file="$2"
  mysql_root_exec -e "SHOW BINARY LOGS" | awk -v s="$start_file" -v e="$end_file" '
    $1==s {flag=1}
    flag==1 {print $1}
    $1==e {flag=0; exit}
  '
}

next_migration_file() {
  local ts seq
  ts="$(date -u +"%Y%m%dT%H%M%SZ")"
  seq="$(find "$BINLOG_DIR" -maxdepth 1 -type f -name '*.binlog' | wc -l | tr -d ' ')"
  seq=$((seq + 1))
  printf "%s/%04d_%s.binlog" "$BINLOG_DIR" "$seq" "$ts"
}
