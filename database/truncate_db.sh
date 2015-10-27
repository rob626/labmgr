#!/bin/bash
DATABASE_NAME=labmgr
BACKUPFILE=/tmp/$DATABASE_NAME.$(date +%Y%m%d%H%M%S).db.sql
echo "Creating backup..." $BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUPFILE
echo "Truncating tables..."
mysql -u root -Nse 'show tables' $DATABASE_NAME | while read table; do mysql -u root -e "truncate table $table" $DATABASE_NAME; done