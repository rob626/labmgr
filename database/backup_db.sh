#!/bin/bash

DATABASE_NAME=labmgr
BACKUP_DIR=$(pwd)/database/backups
BACKUPFILE=$DATABASE_NAME.$(date +%Y%m%d%H%M%S).db.sql
echo "Creating backup..." $BACKUP_DIR/$BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUP_DIR/$BACKUPFILE