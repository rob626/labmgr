#!/bin/bash
# A menu driven shell script sample template 
## ----------------------------------
# Step #1: Define variables
# ----------------------------------
EDITOR=vim
PASSWD=/etc/passwd
#RED='\033[0;41;30m'
RED='\033[0;45;37m'
opt1='\033[0;31;41m'
opt2='\033[0;44;39m'
STD='\033[0;0;39m'

PROCESS_ALL=0
STARTING_WITH=""
STARTING_PATH="."
FOLDER=""
MKTORRENT_PATH="."
MKTORRENT_VERBOSE=""
DEBUG=0
START_TRIGGER=0

tmp_file=delete.tmp
log_file=mktorrent-batch.log

pause() {
  unset fackEnterKey
  read -p "Press [Enter] key to continue..." fackEnterKey
}

show_help() {
  echo "-a | --all: creates a torrent for each sub folder."  
  echo "-h | --help: prints this help message."
  echo "-s | --starting: starts with a specific folder.  Useful when you ended early."
  echo "-p | --path: Must be first parameter. Root directory to create torrent of folder.  Default is . "
  echo "-f | --folder: create torrent of just a list of folders"
  echo "-m | --mktorrent_location: patht to mktorrent exe.  Default is ."
  echo "-v | --verbose: use verbose for mktorrent."
  echo
  
  exit
}

while [[ $# > 0 ]]
do
key="$1"

case $key in
    -h|--help)
    show_help
    shift # past argument
	break
    ;;
    -a|--all)
    PROCESS_ALL=1
    ;;
	-s|--starting)
    STARTING_WITH=$2
    shift # past argument
    ;;
	-p|--path)
    STARTING_PATH=$2
    shift # past argument
    ;;
	-f|--folder)
    FOLDER=$2
    shift # past argument
    ;;
	-v|--verbose)
    MKTORRENT_VERBOSE="-v"
    ;;
	-m|--mktorrent_location)
    MKTORRENT_PATH=$2
    shift # past argument
    ;;
	-d|--debug)
    DEBUG=1
    ;;
    *)
    echo "Unknown arguement(s), try --help"
    ;;
esac
shift # past argument or value
done

if [[ $DEBUG > 0 ]]; then 
	echo PROCESS_ALL = $PROCESS_ALL
	echo STARTING_PATH = $STARTING_PATH
	echo STARTING_WITH = $STARTING_WITH
	echo FOLDER = $FOLDER
	echo MKTORRENT_PATH = $MKTORRENT_PATH
	echo MKTORRENT_VERBOSE = $MKTORRENT_VERBOSE
fi

echo
pause
echo

if [[ $PROCESS_ALL = 1 ]]; then
	if [[ $DEBUG > 0 ]]; then echo "Processing all in $STARTING_PATH"; fi
	
	for D in $STARTING_PATH/*; do
		if [ -d "${D}" ]; then
			SESSION=$(basename "${D}")

			echo
			echo >> $log_file
			echo "Starting mktorrent for $SESSION as part of $STARTING_PATH"
			echo "$(date): Starting mktorrent for $SESSION as part of $STARTING_PATH" >> $log_file
			$MKTORRENT_PATH/mktorrent $MKTORRENT_VERBOSE -l 25 -a http://tracker.url -o $SESSION.torrent $STARTING_PATH/$SESSION/
			echo "$(date): Done with mktorrent for folder $SESSION as part of $STARTING_PATH" >> $log_file
		fi
	done
	exit
fi

if [[ $STARTING_WITH != "" ]]; then
	if [[ $DEBUG > 0 ]]; then echo "Processing all in $STARTING_PATH starting with $STARTING_WITH"; fi

	for D in $STARTING_PATH/*; do
		if [ -d "${D}" ]; then
			SESSION=$(basename "${D}")

			if [[ $STARTING_WITH = $SESSION ]]; then
				START_TRIGGER=1
				if [[ $DEBUG > 0 ]]; then echo "Found starting point"; fi
			fi
			
			if [[ $START_TRIGGER = 1 ]]; then
				echo "$(date): Starting mktorrent for $SESSION as part of $STARTING_PATH" >> $log_file
				$MKTORRENT_PATH/mktorrent $MKTORRENT_VERBOSE -l 25 -a http://tracker.url -o $SESSION.torrent $STARTING_PATH/$SESSION/
				echo "$(date): Done with mktorrent for folder $SESSION as part of $STARTING_PATH" >> $log_file
				echo >> $log_file
			fi
		fi
	done
	exit
fi

if [[ $FOLDER != "" ]]; then
	if [[ $DEBUG > 0 ]]; then echo "Processing folder $FOLDER"; fi
		
	echo "$(date): Starting mktorrent for $FOLDER in $STARTING_PATH" >> $log_file
	$MKTORRENT_PATH/mktorrent $MKTORRENT_VERBOSE -l 25 -a http://tracker.url -o $FOLDER.torrent $STARTING_PATH/$FOLDER/
	echo "$(date): Done with mktorrent for $FOLDER in $STARTING_PATH" >> $log_file
	echo >> $log_file
	exit
fi

echo "Not sure what I was supposed to do."
exit

echo "$(date): Starting mktorrent for %FOLDER"
$MKTORRENT_PATH/mktorrent $MKTORRENT_VERBOSE -l 25 -a http://tracker.url -o $FOLDER.torrent c:/Labs/$FOLDER/

