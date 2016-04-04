#!/bin/bash
echo "SCRIPT START"
ssh -i "/home/robert/labmgr/certs/labmgr" -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@192.168.15.106 "ls -ltr"

