#!/bin/bash

DATABASE_NAME=labmgr
BACKUP_DIR=$(pwd)/database/backups

if [[ $1 ]]; then
	BACKUPFILE=$1
else
	BACKUPFILE=$DATABASE_NAME_$(date +%Y-%m-%d_%H-%M-%S).db.sql
fi

echo "Creating backup..." $BACKUP_DIR/$BACKUPFILE
mysqldump -u root $DATABASE_NAME > $BACKUP_DIR/$BACKUPFILE