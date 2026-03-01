#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
# shellcheck disable=SC1091
source "$SCRIPT_DIR/common.sh"

dbmig_context
echo ""

if [[ -f "$CURSOR_FILE" ]]; then
  echo "Cursor file: $CURSOR_FILE"
  cat "$CURSOR_FILE"
else
  echo "Cursor: not initialized"
fi

echo ""
echo "Current master status:"
read_master_status || true

echo ""
echo "Migration files:"
find "$BINLOG_DIR" -maxdepth 1 -type f -name '*.binlog' | sort
