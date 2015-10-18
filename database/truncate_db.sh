#!/bin/bash
DATABASE_NAME=labmgr
mysql -u root -Nse 'show tables' $DATABASE_NAME | while read table; do mysql -u root -e "truncate table $table" $DATABASE_NAME; done