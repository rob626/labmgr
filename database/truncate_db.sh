#!/bin/bash
DATABASE_NAME=labmgr
BACKUPFILE=/tmp/$DATABASE_NAME_$(date +%Y-%m-%d_%H-%M-%S)_reset-backup.db.sql
echo "Creating backup..." $BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUPFILE
echo "Truncating tables..."
mysql -u root -Nse 'show tables' $DATABASE_NAME | while read table; do mysql -u root -e "truncate table $table" $DATABASE_NAME; done
echo "Done"