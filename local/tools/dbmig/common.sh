#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SITE_ROOT="$(cd "${SCRIPT_DIR}/../../.." && pwd)"
STACK_DIR_DEFAULT="$(cd "${SITE_ROOT}/../.." && pwd)"

STACK_DIR="${STACK_DIR:-$STACK_DIR_DEFAULT}"
STACK_COMPOSE_FILE="${STACK_COMPOSE_FILE:-${STACK_DIR}/docker-compose.yml}"
STACK_SERVICE_DB="${STACK_SERVICE_DB:-db}"
DBMIG_MODE="${DBMIG_MODE:-auto}" # auto|compose|mysql
SETTINGS_FILE="${SETTINGS_FILE:-${SITE_ROOT}/bitrix/.settings.php}"

ROOT_DB_USER="${ROOT_DB_USER:-root}"
ROOT_DB_PASS="${ROOT_DB_PASS:-root}"

APP_DB_HOST="${APP_DB_HOST:-}"
APP_DB_PORT="${APP_DB_PORT:-}"
APP_DB_NAME="${APP_DB_NAME:-}"
APP_DB_USER="${APP_DB_USER:-}"
APP_DB_PASS="${APP_DB_PASS:-}"

MIG_DIR="${MIG_DIR:-${SITE_ROOT}/local/db/migrations}"
BINLOG_DIR="${BINLOG_DIR:-${MIG_DIR}/binlog}"
STATE_DIR="${STATE_DIR:-${MIG_DIR}/state}"
CURSOR_FILE="${CURSOR_FILE:-${STATE_DIR}/cursor.env}"

mkdir -p "$BINLOG_DIR" "$STATE_DIR"

detect_bin() {
  local name="$1"
  shift || true
  if command -v "$name" >/dev/null 2>&1; then
    command -v "$name"
    return 0
  fi
  while [[ $# -gt 0 ]]; do
    if [[ -x "$1" ]]; then
      echo "$1"
      return 0
    fi
    shift
  done
  return 1
}

load_bitrix_connection() {
  local settings="$1"
  if [[ ! -f "$settings" ]]; then
    return 1
  fi
  # shellcheck disable=SC2016
  php -r '
    $f = $argv[1];
    if (!is_file($f)) {
      exit(1);
    }
    $s = include $f;
    if (!is_array($s) || !isset($s["connections"]["value"]["default"])) {
      exit(2);
    }
    $c = $s["connections"]["value"]["default"];
    $host = isset($c["host"]) ? (string)$c["host"] : "";
    $db   = isset($c["database"]) ? (string)$c["database"] : "";
    $user = isset($c["login"]) ? (string)$c["login"] : "";
    $pass = isset($c["password"]) ? (string)$c["password"] : "";
    echo $host, "\t", $db, "\t", $user, "\t", $pass;
  ' "$settings"
}

if conn="$(load_bitrix_connection "$SETTINGS_FILE" 2>/dev/null || true)"; then
  if [[ -n "$conn" ]]; then
    IFS=$'\t' read -r settings_host settings_db settings_user settings_pass <<<"$conn"
    [[ -z "$APP_DB_HOST" ]] && APP_DB_HOST="$settings_host"
    [[ -z "$APP_DB_NAME" ]] && APP_DB_NAME="$settings_db"
    [[ -z "$APP_DB_USER" ]] && APP_DB_USER="$settings_user"
    [[ -z "$APP_DB_PASS" ]] && APP_DB_PASS="$settings_pass"
  fi
fi

APP_DB_HOST="${APP_DB_HOST:-db}"
APP_DB_NAME="${APP_DB_NAME:-fors36_site}"
APP_DB_USER="${APP_DB_USER:-fors36_user}"

if [[ "$APP_DB_HOST" == *:* && -z "$APP_DB_PORT" ]]; then
  APP_DB_PORT="${APP_DB_HOST##*:}"
  APP_DB_HOST="${APP_DB_HOST%%:*}"
fi

detect_docker_bin() {
  detect_bin docker /usr/local/bin/docker /usr/bin/docker
}

detect_mysql_bin() {
  detect_bin mysql /usr/local/bin/mysql /usr/bin/mysql
}

detect_mysqlbinlog_bin() {
  detect_bin mysqlbinlog /usr/local/bin/mysqlbinlog /usr/bin/mysqlbinlog
}

DOCKER_BIN="${DOCKER_BIN:-$(detect_docker_bin || true)}"
MYSQL_BIN="${MYSQL_BIN:-$(detect_mysql_bin || true)}"
MYSQLBINLOG_BIN="${MYSQLBINLOG_BIN:-$(detect_mysqlbinlog_bin || true)}"

DBMIG_MODE_RESOLVED="$DBMIG_MODE"
if [[ "$DBMIG_MODE_RESOLVED" == "auto" ]]; then
  if [[ -n "$DOCKER_BIN" && -f "$STACK_COMPOSE_FILE" ]]; then
    DBMIG_MODE_RESOLVED="compose"
  else
    DBMIG_MODE_RESOLVED="mysql"
  fi
fi

case "$DBMIG_MODE_RESOLVED" in
  compose)
    if [[ -z "$DOCKER_BIN" ]]; then
      echo "ERROR: docker binary not found for compose mode." >&2
      exit 1
    fi
    if [[ ! -f "$STACK_COMPOSE_FILE" ]]; then
      echo "ERROR: compose file not found: $STACK_COMPOSE_FILE" >&2
      exit 1
    fi
    MONITOR_DB_HOST="${MONITOR_DB_HOST:-}"
    MONITOR_DB_PORT="${MONITOR_DB_PORT:-}"
    MONITOR_DB_USER="${MONITOR_DB_USER:-$ROOT_DB_USER}"
    MONITOR_DB_PASS="${MONITOR_DB_PASS:-$ROOT_DB_PASS}"
    ;;
  mysql)
    if [[ -z "$MYSQL_BIN" ]]; then
      echo "ERROR: mysql client binary not found for mysql mode." >&2
      exit 1
    fi
    MONITOR_DB_HOST="${MONITOR_DB_HOST:-$APP_DB_HOST}"
    MONITOR_DB_PORT="${MONITOR_DB_PORT:-$APP_DB_PORT}"
    MONITOR_DB_USER="${MONITOR_DB_USER:-$APP_DB_USER}"
    MONITOR_DB_PASS="${MONITOR_DB_PASS:-$APP_DB_PASS}"
    ;;
  *)
    echo "ERROR: unsupported DBMIG_MODE: $DBMIG_MODE_RESOLVED (use auto|compose|mysql)" >&2
    exit 1
    ;;
esac

compose_exec_db() {
  "$DOCKER_BIN" compose -f "$STACK_COMPOSE_FILE" exec -T "$STACK_SERVICE_DB" "$@"
}

compose_mysql_nodb_exec() {
  local user="$1"
  local pass="$2"
  local sql="$3"
  local -a cmd
  cmd=(mysql -N -B -u"$user")
  if [[ -n "$pass" ]]; then
    cmd+=("-p$pass")
  fi
  cmd+=(-e "$sql")
  compose_exec_db "${cmd[@]}"
}

compose_mysql_db_exec() {
  local sql="$1"
  local -a cmd
  cmd=(mysql -N -B -u"$APP_DB_USER")
  if [[ -n "$APP_DB_PASS" ]]; then
    cmd+=("-p$APP_DB_PASS")
  fi
  cmd+=("$APP_DB_NAME" -e "$sql")
  compose_exec_db "${cmd[@]}"
}

compose_mysql_db_import() {
  local file="$1"
  local -a cmd
  cmd=(mysql -u"$APP_DB_USER")
  if [[ -n "$APP_DB_PASS" ]]; then
    cmd+=("-p$APP_DB_PASS")
  fi
  cmd+=("$APP_DB_NAME")
  compose_exec_db "${cmd[@]}" < "$file"
}

compose_dump_binlog() {
  local logf="$1"
  shift || true
  compose_exec_db mysqlbinlog --database="$APP_DB_NAME" "$@" "/var/lib/mysql/${logf}"
}

mysql_direct_nodb_exec() {
  local sql="$1"
  local -a cmd
  cmd=("$MYSQL_BIN" -N -B -h"$MONITOR_DB_HOST" -u"$MONITOR_DB_USER")
  if [[ -n "$MONITOR_DB_PORT" ]]; then
    cmd+=(-P"$MONITOR_DB_PORT")
  fi
  if [[ -n "$MONITOR_DB_PASS" ]]; then
    cmd+=("-p$MONITOR_DB_PASS")
  fi
  "${cmd[@]}" -e "$sql"
}

mysql_direct_db_exec() {
  local sql="$1"
  local -a cmd
  cmd=("$MYSQL_BIN" -N -B -h"$APP_DB_HOST" -u"$APP_DB_USER")
  if [[ -n "$APP_DB_PORT" ]]; then
    cmd+=(-P"$APP_DB_PORT")
  fi
  if [[ -n "$APP_DB_PASS" ]]; then
    cmd+=("-p$APP_DB_PASS")
  fi
  cmd+=("$APP_DB_NAME")
  "${cmd[@]}" -e "$sql"
}

mysql_direct_db_import() {
  local file="$1"
  local -a cmd
  cmd=("$MYSQL_BIN" -h"$APP_DB_HOST" -u"$APP_DB_USER")
  if [[ -n "$APP_DB_PORT" ]]; then
    cmd+=(-P"$APP_DB_PORT")
  fi
  if [[ -n "$APP_DB_PASS" ]]; then
    cmd+=("-p$APP_DB_PASS")
  fi
  cmd+=("$APP_DB_NAME")
  "${cmd[@]}" < "$file"
}

mysql_direct_dump_binlog() {
  local logf="$1"
  shift || true
  if [[ -z "$MYSQLBINLOG_BIN" ]]; then
    echo "ERROR: mysqlbinlog binary not found for mysql mode." >&2
    return 1
  fi
  local -a cmd
  cmd=("$MYSQLBINLOG_BIN" --read-from-remote-server "--host=${MONITOR_DB_HOST}" "--user=${MONITOR_DB_USER}")
  if [[ -n "$MONITOR_DB_PORT" ]]; then
    cmd+=("--port=${MONITOR_DB_PORT}")
  fi
  if [[ -n "$MONITOR_DB_PASS" ]]; then
    cmd+=("--password=${MONITOR_DB_PASS}")
  fi
  cmd+=("--database=${APP_DB_NAME}")
  if [[ $# -gt 0 ]]; then
    cmd+=("$@")
  fi
  cmd+=("$logf")
  "${cmd[@]}"
}

db_monitor_exec() {
  local sql="$1"
  if [[ "$DBMIG_MODE_RESOLVED" == "compose" ]]; then
    compose_mysql_nodb_exec "$MONITOR_DB_USER" "$MONITOR_DB_PASS" "$sql"
  else
    mysql_direct_nodb_exec "$sql"
  fi
}

db_app_exec() {
  local sql="$1"
  if [[ "$DBMIG_MODE_RESOLVED" == "compose" ]]; then
    compose_mysql_db_exec "$sql"
  else
    mysql_direct_db_exec "$sql"
  fi
}

db_app_import() {
  local file="$1"
  if [[ "$DBMIG_MODE_RESOLVED" == "compose" ]]; then
    compose_mysql_db_import "$file"
  else
    mysql_direct_db_import "$file"
  fi
}

dump_binlog() {
  local logf="$1"
  shift || true
  if [[ "$DBMIG_MODE_RESOLVED" == "compose" ]]; then
    compose_dump_binlog "$logf" "$@"
  else
    mysql_direct_dump_binlog "$logf" "$@"
  fi
}

read_master_status() {
  db_monitor_exec "SHOW MASTER STATUS" | awk 'NR==1 {print $1" "$2}'
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
  db_monitor_exec "SHOW BINARY LOGS" | awk -v s="$start_file" -v e="$end_file" '
    $1==s {flag=1}
    flag==1 {print $1}
    $1==e {flag=0; exit}
  '
}

dbmig_context() {
  echo "Mode: $DBMIG_MODE_RESOLVED"
  local target_host="$APP_DB_HOST"
  if [[ -n "$APP_DB_PORT" ]]; then
    target_host="${target_host}:${APP_DB_PORT}"
  fi
  echo "Target DB: ${APP_DB_USER}@${target_host}/${APP_DB_NAME}"
  if [[ "$DBMIG_MODE_RESOLVED" == "compose" ]]; then
    echo "Compose file: $STACK_COMPOSE_FILE"
  else
    local monitor_host="$MONITOR_DB_HOST"
    if [[ -n "$MONITOR_DB_PORT" ]]; then
      monitor_host="${monitor_host}:${MONITOR_DB_PORT}"
    fi
    echo "Monitor DB: ${MONITOR_DB_USER}@${monitor_host}"
  fi
}

next_migration_file() {
  local ts seq
  ts="$(date -u +"%Y%m%dT%H%M%SZ")"
  seq="$(find "$BINLOG_DIR" -maxdepth 1 -type f -name '*.binlog' | wc -l | tr -d ' ')"
  seq=$((seq + 1))
  printf "%s/%04d_%s.binlog" "$BINLOG_DIR" "$seq" "$ts"
}
