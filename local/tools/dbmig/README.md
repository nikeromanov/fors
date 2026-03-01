# dbmig

Binlog-based auto migrations for `fors36_site`.

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
