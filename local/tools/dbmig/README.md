# dbmig

Binlog-based auto migrations for `fors36_site`.

## Modes
- `compose` - reads binlog inside Docker DB container.
- `mysql` - connects directly via `mysql`/`mysqlbinlog` (shared-hosting friendly).
- `auto` (default) - uses `compose` when compose file exists, otherwise `mysql`.

## Quick start
1. Initialize cursor:
```bash
cd /Users/qaqa/bitrix-local/site/fors36
local/tools/dbmig/init.sh
```

2. Capture new DB changes:
```bash
local/tools/dbmig/capture.sh
```

3. Apply on target DB:
```bash
APP_DB_PASS='your_password' local/tools/dbmig/apply.sh
```

4. Status:
```bash
local/tools/dbmig/status.sh
```

## Environment overrides
- `DBMIG_MODE=compose|mysql|auto`
- `STACK_COMPOSE_FILE=/abs/path/docker-compose.yml` (for compose mode)
- `APP_DB_HOST`, `APP_DB_PORT`, `APP_DB_NAME`, `APP_DB_USER`, `APP_DB_PASS`
- `MONITOR_DB_HOST`, `MONITOR_DB_PORT`, `MONITOR_DB_USER`, `MONITOR_DB_PASS` (for binlog status/range)

By default DB credentials are auto-read from `bitrix/.settings.php`.

## Shared-hosting note
For `init.sh` and `capture.sh` DB user used in monitor mode must have enough rights to read binlog metadata (`SHOW MASTER STATUS`, `SHOW BINARY LOGS`; typically `REPLICATION CLIENT` or equivalent).
