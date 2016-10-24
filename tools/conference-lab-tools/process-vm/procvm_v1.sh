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

DEF_search_root=.
DEF_vmware_path=C:/Program\ Files\ \(x86\)/VMware/VMware\ Workstation/
tmp_file=delete.tmp
 
# ----------------------------------
# Step #2: User defined function
# ----------------------------------
pause() {
  unset fackEnterKey
  read -p "Press [Enter] key to continue..." fackEnterKey
  if [ "$fackEnterKey" = "q" ]; then echo; my_exit; fi

  if [ "$fackEnterKey" = "|" ]; then 
    echo
    echo -e "${RED}     password is $password ${STD}" 
    echo
    read -p "Press [Enter] key to continue..." fackEnterKey
  fi
}

define_vmware_path() {
  read -p "Enter VMWARE PATH [$DEF_vmware_path]: " vmware_path
  vmware_path=${vmware_path:-$DEF_vmware_path}
}

define_search_root() {
  read -p "Enter SEARCH ROOT [$DEF_search_root]: " search_root
  search_root=${search_root:-$DEF_search_root}
}

search_dir_structure() {

  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  while IFS='' read -r line || [[ -n "$line" ]]; do
    echo
    echo "File: $line"
    size=${#line}+7
    for (( i=2; i <= $size; ++i )); do echo -n =; done
    echo
    if grep -iq uuid.action "$line"; then
      OUTPUT="$(grep -i uuid.action "$line")"
      echo "UUID.ACTION value:         ${OUTPUT}"
    else
      echo "UUID.ACTION value:         -" 
    fi

    if grep -iq msg.autoanswer "$line"; then
      OUTPUT="$(grep -i msg.autoanswer "$line")"
      echo "MSG.AUTOANSWER value:      ${OUTPUT}"
    else
      echo "MSG.AUTOANSWER value:      -" 
    fi

    echo
    "$vmware_path/vmrun.exe" listSnapshots "$line"
    echo

  done < "$tmp_file"  
  rm $tmp_file
  pause
}

process_vmx_files() {

  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  while IFS='' read -r -u9 line || [[ -n "$line" ]]; do
    update_vmx_uuid=n
    update_vmx_autoanswer=n
    echo
    echo "File: $line"
    size=${#line}+7
    for (( i=2; i <= $size; ++i )); do echo -n =; done
    echo
    if grep -iq uuid.action "$line"; then
      OUTPUT="$(grep -i uuid.action "$line")"
      echo "UUID.ACTION value:         ${OUTPUT}"
    else
      echo "UUID.ACTION value:         -"
      update_vmx_uuid=y
    fi

    if grep -iq msg.autoanswer "$line"; then
      OUTPUT="$(grep -i msg.autoanswer "$line")"
      echo "MSG.AUTOANSWER value:      ${OUTPUT}"
    else
      echo "MSG.AUTOANSWER value:      -"
      update_vmx_autoanswer=y  
    fi

    if [ "$update_vmx_uuid" = "y" ] || [ "$update_vmx_autoanswer" = "y" ]; then
      echo
    fi

    if [ "$update_vmx_uuid" = "y" ]; then
      unset update_vmx_uuid 
      read -p "No UUID.ACTION.     Add (y/n)? [y]: " update_vmx_uuid 
      if [ "$update_vmx_uuid" != "n" ]; then 
        echo -e "\r" >> “$line”
        echo -e "# Added by procvm.sh\r" >> “$line”
        echo -e "uuid.action = \"create\"\r"  >> “$line” 
      fi
    fi

    if [ "$update_vmx_autoanswer" = "y" ]; then
      unset update_vmx_autoanswer 
      read -p "No MSG.AUTOANSWER.  Add (y/n)? [y]: " update_vmx_autoanswer  
      if [ "$update_vmx_autoanswer" != "n" ]; then 
        echo -e "\r" >> “$line”
        echo -e "# Added by procvm.sh\r" >> “$line”
        echo -e "msg.autoanswer = TRUE\r" >> “$line” 
      fi
    fi

  done 9< "$tmp_file"  
  rm $tmp_file
  pause
}

generate_vmx_report() {

  find $search_root -name "*vmx" -type f -exec ls {} \; 
  echo

  pause
}

report_spaces() {

  pattern=" |'"

  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  echo
  echo "These files and directories have spaces in them:"
  echo "================================================"
  echo
  
  while IFS='' read -r -u9 line || [[ -n "$line" ]]; do
	
	DIR=$(dirname "${line}")
	FILE=$(basename "${line}")
	
	if [[ $FILE =~ $pattern ]]; then
	  echo "FILE:       $line"
    fi
	
	if [[ $DIR =~ $pattern ]]; then
	  echo "DIRECTORY:  $line"
    fi
  done 9< "$tmp_file"  
	
  echo
  echo "Use the Remove spaces function to replace spaces with underscores."
  echo 
  
  pause
}

remove_spaces() {

  pattern=" |'"
  remove_the_spaces=n

  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  while IFS='' read -r -u9 line || [[ -n "$line" ]]; do
	
	DIR=$(dirname "${line}")
	FILE=$(basename "${line}")
	
	if [[ $FILE =~ $pattern ]]; then
	  NEWFILE="${FILE// /_}"
      unset remove_the_spaces 
	  echo "FILE:  $line"
      read -p "  Rename:  '$FILE'  to  '$NEWFILE' (y/n)? [y]: " remove_the_spaces  
      if [ "$remove_the_spaces" != "n" ]; then 
        echo "  --renaming $FILE"
		mv "$DIR/$FILE" "$DIR/$NEWFILE"
      fi
	  echo
    fi
	
	if [[ $DIR =~ $pattern ]]; then
	  NEWDIR="${DIR// /_}"
      unset remove_the_spaces 
	  echo "DIRECTORY:  $line"
      read -p "  Rename DIRECTORY:  '$DIR'  to  '$NEWDIR' (y/n)? [y]: " remove_the_spaces  
      if [ "$remove_the_spaces" != "n" ]; then 
        echo "  --renaming $DIR"
		mv "$DIR" "$NEWDIR"
      fi
	  echo
    fi
  done 9< "$tmp_file"  
	
  pause
}

generate_vmx_snapshot_report() {

  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  while IFS='' read -r -u9 line || [[ -n "$line" ]]; do
    echo -n "$line"

    snapshot_list=$("$vmware_path/vmrun.exe" listSnapshots "$line")
	readarray -t snapshot_array <<<"$snapshot_list"
	
	for (( i=1; i <= 10; ++i )); do 
		if [ -n "${snapshot_array[i]}" ]; then
			echo -n ", ${snapshot_array[i]}" | tr -d '\r'
		fi
	done

  echo
	
  done 9< "$tmp_file"  
  
  rm $tmp_file
  echo
  pause
}

display_readme() {
  echo
  echo "This script ..."

  pause
}

# function to display menus
show_menus() {
  clear
  echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"  
  echo " GSA Project / Directory / ACL Maintanence for lab images"
  echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
  echo
  echo "Search root:      $search_root"
  echo "Path for VMrun:   $vmware_path"
  echo
  echo "1. Search for vmx file and list snapshots"
  echo "2. Process vmx files (add uuid.action and msg.autoanswer)"
  echo "3. Report on spaces in vmx filenames and paths"
  echo "4. Remove spaces from vmx filenames and paths"
  echo "5. Generate vmx file report"
  echo "6. Generate vmx file with snapshot report"
  echo
  echo "7. Define search root"  
  echo "8. Define path to VMware"
  echo "9. Exit"
  echo
}

# read input from the keyboard and take a action
# invoke the one() when the user select 1 from the menu option.
# invoke the two() when the user select 2 from the menu option.
# Exit when user the user select 3 form the menu option.
read_options() {
  local choice
  read -p "Enter choice [ 1 - 99, q] " choice
  case $choice in
    q) echo
        my_exit ;;

    1|as) search_dir_structure ;;
    2|pr) process_vmx_files ;;
	3|sr) report_spaces ;;
	4|rs) remove_spaces ;;
	5|gr) generate_vmx_report ;;
	6|gsr) generate_vmx_snapshot_report ;;

    7|sp) define_search_root ;;
    8|vp) define_vmware_path ;;
    9) echo
        my_exit ;;
    ?|h) display_readme ;;
    *) echo -e "${RED}Error...${STD}" && sleep 2
  esac
}

my_exit() {

  echo
  exit 0
}

 
search_root=$DEF_search_root
vmware_path=$DEF_vmware_path

# -----------------------------------
# Step #1: Main logic - infinite loop
# ------------------------------------
while true
do
 
  show_menus
  read_options
done
