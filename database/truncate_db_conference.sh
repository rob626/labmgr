#!/bin/bash
DATABASE_NAME=labmgr
BACKUPFILE=/tmp/$DATABASE_NAME.$(date +%Y%m%d%H%M%S).db.sql
echo "Creating backup..." $BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUPFILE
echo "Truncating tables..."
mysql -u root $DATABASE_NAME < truncate_db_conference.sql