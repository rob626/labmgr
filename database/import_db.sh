#!/bin/bash

if [[ ! $1 ]]; then
        echo "Missing file to import"
        exit -2
fi
echo "Loading " $1
mysql -u root labmgr < $1
