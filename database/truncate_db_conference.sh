#!/bin/bash
DATABASE_NAME=labmgr
BACKUPFILE=$(pwd)/database/backups/$DATABASE_NAME\_$(date +%Y-%m-%d_%H-%M-%S)_reset-backup.db.sql
echo "Creating backup...." $BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUPFILE
echo "Truncating tables..."
mysql -u root $DATABASE_NAME < $(pwd)/database/truncate_db_conference.sql
echo "Done"