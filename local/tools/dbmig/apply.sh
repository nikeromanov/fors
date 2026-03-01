#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
# shellcheck disable=SC1091
source "$SCRIPT_DIR/common.sh"

if [[ -z "$APP_DB_PASS" ]]; then
  echo "ERROR: APP_DB_PASS is empty. Export APP_DB_PASS before apply." >&2
  exit 1
fi

mysql_root_exec -e "CREATE TABLE IF NOT EXISTS ${APP_DB_NAME}.__db_migrations (id INT AUTO_INCREMENT PRIMARY KEY, filename VARCHAR(255) NOT NULL UNIQUE, checksum CHAR(40) NOT NULL, applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"

shopt -s nullglob
files=("$BINLOG_DIR"/*.binlog)
if [[ ${#files[@]} -eq 0 ]]; then
  echo "No migration files in $BINLOG_DIR"
  exit 0
fi

for f in "${files[@]}"; do
  base="$(basename "$f")"
  checksum="$(shasum "$f" | awk '{print $1}')"

  exists="$(mysql_root_exec -e "SELECT COUNT(*) FROM ${APP_DB_NAME}.__db_migrations WHERE filename='${base}'" | tr -d '[:space:]')"
  if [[ "$exists" != "0" ]]; then
    echo "Skip already applied: $base"
    continue
  fi

  echo "Applying: $base"
  compose_exec_db mysql -u"$APP_DB_USER" -p"$APP_DB_PASS" "$APP_DB_NAME" < "$f"
  mysql_root_exec -e "INSERT INTO ${APP_DB_NAME}.__db_migrations(filename, checksum) VALUES ('${base}', '${checksum}')"
  echo "Applied: $base"
done

echo "Done."
