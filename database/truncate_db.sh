#!/bin/bash
DATABASE_NAME=labmgr
echo "Creating backup..." $DATABASE_NAME
mysqldump -u root $DATABASE_NAME > $DATABASE_NAME.$(date +%Y%m%d%H%M%S).db.sql
echo "Truncating tables..."
mysql -u root -Nse 'show tables' $DATABASE_NAME | while read table; do mysql -u root -e "truncate table $table" $DATABASE_NAME; done