#!/bin/bash
DATABASE_NAME=labmgr

mysqldump -u root $DATABASE_NAME > $(date +%Y%m%d%H%M%S).db.sql
mysql -u root -Nse 'show tables' $DATABASE_NAME | while read table; do mysql -u root -e "truncate table $table" $DATABASE_NAME; done