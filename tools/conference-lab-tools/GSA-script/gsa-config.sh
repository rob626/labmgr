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

DEF_GSA_CELL=bldgsa.ibm.com
DEF_GSA_PATH=/gsa/bldgsa/projects/i/
DEF_GSA_PROJECT=ic16-lab-images
# DEF_GSA_PATH=/gsa/bldgsa/projects/w/
# DEF_GSA_PROJECT=websphere-tech-u
DEF_GSA_USER=jpn

RC_FILE=.gsa-config-rc
 
# ----------------------------------
# Step #2: User defined function
# ----------------------------------
pause(){
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
 
show_config() {
  echo
  echo "     GSA_CELL is $GSA_CELL"
  echo "     GSA_PATH is $GSA_PATH"
  echo "     GSA_PROJECT is $GSA_PROJECT"
  echo "     GSA_USER is $GSA_USER"
  echo "     password is *********"
  echo
  pause
}
config-connection() {
  echo

  read -p "Enter GSA Cell [$DEF_GSA_CELL]: " GSA_CELL
  GSA_CELL=${GSA_CELL:-$DEF_GSA_CELL}

  read -p "Enter GSA Path [$DEF_GSA_PATH]: " GSA_PATH
  GSA_PATH=${GSA_PATH:-$DEF_GSA_PATH}

  read -p "Enter GSA Project [$DEF_GSA_PROJECT]: " GSA_PROJECT
  GSA_PROJECT=${GSA_PROJECT:-$DEF_GSA_PROJECT}

  read -p "Enter GSA Project [$DEF_GSA_USER]: " GSA_USER
  GSA_USER=${GSA_USER:-$DEF_GSA_USER}

  set_password

  show_config

  read -p "Save data, including password, in local file (y/n)? [n]: " FILE_SAVE
  if [ "$FILE_SAVE" = "y" ]; then
    echo "#!/bin/bash" > $RC_FILE
    echo "GSA_SCRIPT_CELL=\"$GSA_CELL\"" >> $RC_FILE
    echo "GSA_SCRIPT_PATH=\"$GSA_PATH\"" >> $RC_FILE
    echo "GSA_SCRIPT_PROJECT=\"$GSA_PROJECT\"" >> $RC_FILE
    echo "GSA_SCRIPT_USER=\"$GSA_USER\"" >> $RC_FILE
    ENCODED_PASSWORD=`echo -n "$password" | base64`
    echo "GSA_SCRIPT_PASSWORD=\"$ENCODED_PASSWORD\"" >> $RC_FILE
  fi

  pause
}

read_rc_file() {
  if [ -f $RC_FILE ]; then
    echo
    read -p "Read existing config file (y/n)? [y]: " READ_CONFIG_FILE
    if [ "$READ_CONFIG_FILE" = "n" ]; then
      echo
      echo "Config file not read"
    else
      . $RC_FILE
      echo "sourced $GSA_SCRIPT_PASSWORD"
      echo

      GSA_CELL=$GSA_SCRIPT_CELL
      GSA_PATH=$GSA_SCRIPT_PATH
      GSA_PROJECT=$GSA_SCRIPT_PROJECT
      GSA_USER=$GSA_SCRIPT_USER
      password=$(echo -ne "$GSA_SCRIPT_PASSWORD" | base64 --decode)

      show_config
    fi
  fi

}

list_session_directory() {
  echo 
  echo "Show directory information... $1"
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi
  # curl -k -u johndoe:password -X GET https://smbgsa.ibm.com/cgi-bin/dir/list/gsa/smbgsa/home/j/o/johndoe/
  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/cgi-bin/dir/list/$GSA_PATH/$GSA_PROJECT/$SESSION
  echo 
  
  pause

}

# show group info
list_session_group() {
  # curl --netrc -u jpn:xxxxxxxx -X GET https://bldgsa.ibm.com/cgi-bin/group/show/p/websphere-tech-u/a114
  echo 
  echo "Show group information... group-$1"
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi

  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/cgi-bin/group/show/p/$GSA_PROJECT/group-$SESSION
  echo 
  
  pause
}

# show group membership
list_session_group_members() {
  # curl --netrc -u jpn:xxxxxxxx! -X GET https://bldgsa.ibm.com/api/gsa_groups/p/websphere-tech-u/a114
  echo 
  echo "Show group membership... group-$1"
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi

  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/group-$SESSION
  echo 
  
  pause
}

# show group membership
list_shared_group_members() {
  # curl --netrc -u jpn:xxxxxxxx! -X GET https://bldgsa.ibm.com/api/gsa_groups/p/websphere-tech-u/a114
  echo 
  echo "Show group membership... shared"
  echo

  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/shared
  echo 
  
  pause
}

list_session_ACL() {
  echo 
  echo "Show ACL information... $1"
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi
  # curl -k --netrc -u $USER:$PASSWD -X GET https://$GSA-CELL/cgi-bin/acl/show/gsa/projects/$PROJECT-DIR/$DIR
  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/cgi-bin/acl/show/$GSA_PATH/$GSA_PROJECT/$SESSION
  echo 
  
  pause

}

# read in the password
set_password() {
  unset password;
  echo -e "Enter GSA password: \c"
  while IFS= read -r -s -n1 pass; do
    if [[ -z $pass ]]; then
       echo
       break
    else
       echo -n '*'
       password+=$pass
    fi
  done
 }

# add session - create directory, add group, add group members, add acl
add_session() {
  # curl -k --netrc -u jpn:xxxxxxxx! -X GET https://bldgsa.ibm.com/api/gsa_groups/p/websphere-tech-u/a114
  echo 
  echo "Add session..."
  echo

  read -p "Enter session name []: " SESSION
  SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  read -p "Enter list of GSA users []: " GSA_USER_LIST

  unset GROUP_LIST
  for i in $(echo $GSA_USER_LIST | tr "," "\n")
    do
      if [ -n "$GROUP_LIST" ]; then GROUP_LIST+=", "; fi
      GROUP_LIST+="\"$i\""
    done
  echo "GROUP_LIST is $GROUP_LIST"

  echo
  echo -e "${RED}  Creating directory $SESSION...${STD}"
  echo
  # curl -k -u johndoe:password -X PUT https://smbgsa.ibm.com/cgi-bin/dir/create/gsa/smbgsa/home/j/o/johndoe/testdir
  curl -k --netrc -u $GSA_USER:$password -X PUT https://$GSA_CELL/cgi-bin/dir/create/$GSA_PATH/$GSA_PROJECT/$SESSION
  echo -e "    ${opt2}...done creating directory${STD}"
  echo

  echo -e "${RED}  Create Group group-$SESSION...${STD}"
  echo
  # curl -k -X POST -u johndoe:password https://smbgsa.ibm.com/cgi-bin/group/create/p/johndoe_proj/testers
  curl -k --netrc -u $GSA_USER:$password -X POST https://$GSA_CELL/cgi-bin/group/create/p/$GSA_PROJECT/group-$SESSION
  echo -e "    ${opt2}...done creating group${STD}"
  echo

  echo -e "${RED}  Adding users ($GSA_USER_LIST) to group group-$SESSION...${STD}"
  echo 
  echo "{" > add_users.xml
  echo "\"metadata\" : { " >> add_users.xml
  echo "              \"gsa_add_ids\" : [ $GROUP_LIST ]" >> add_users.xml
  echo "       }" >> add_users.xml
  echo "}" >> add_users.xml

  # curl -k --netrc -u jpn:xxxxxxxx -H "Content-Type: application/gsa-group" -X PUT -d '{ "metadata" : { "gsa_add_ids" : [ "jpn", "milligan" ] } }' https://bldgsa.ibm.com/api/gsa_groups/p/websphere-tech-u/a123
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-Type: application/gsa-group" -d @add_users.xml https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/group-$SESSION
  
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-Type: application/gsa-group" -d @add_users.xml https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/shared
  
  rm add_users.xml
  echo -e "    ${opt2}...done adding user lists to group${STD}"
  echo

  echo -e "${RED}  Adding ACLs to direcorty $SESSION${STD}"
  echo

  echo "<add_acl>" > add_acl.xml
  echo "  <add_obj_acl>" >> add_acl.xml
  echo "    <mask_ace>rwxc</mask_ace>" >> add_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">rwx-</ext_group_ace>" >> add_acl.xml
  echo "  </add_obj_acl>" >> add_acl.xml
  echo "  <add_inh_acl>" >> add_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">rwx-</ext_group_ace>   " >> add_acl.xml
  echo "  </add_inh_acl>" >> add_acl.xml
  echo "</add_acl>" >> add_acl.xml
  # curl -k --netrc -u jpn:xxxxxxxx -X PUT -H "Content-type: text/xml" -d @add_acl.xml https://bldgsa.ibm.com/cgi-bin/acl/add/gsa/projects/w/websphere-tech-u/a123
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-type: text/xml" -d @add_acl.xml https://$GSA_CELL/cgi-bin/acl/add/$GSA_PATH/$GSA_PROJECT/$SESSION
  rm add_acl.xml
  echo -e "    ${opt2}...done adding ACLs${STD}"
  echo

  pause
}

add_user() {
  echo 
  echo "Adding users to a group..."
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi

  read -p "Enter list of GSA users []: " GSA_USER_LIST

  unset GROUP_LIST
  for i in $(echo $GSA_USER_LIST | tr "," "\n")
    do
      if [ -n "$GROUP_LIST" ]; then GROUP_LIST+=", "; fi
      GROUP_LIST+="\"$i\""
    done
  echo "GROUP_LIST is $GROUP_LIST"

  echo -e "${RED}  Adding users ($GSA_USER_LIST) to group $SESSION...${STD}"
  echo 
  echo "{" > add_users.xml
  echo "\"metadata\" : { " >> add_users.xml
  echo "              \"gsa_add_ids\" : [ $GROUP_LIST ]" >> add_users.xml
  echo "       }" >> add_users.xml
  echo "}" >> add_users.xml

  # curl -k --netrc -u jpn:xxxxxxxx -H "Content-Type: application/gsa-group" -X PUT -d '{ "metadata" : { "gsa_add_ids" : [ "jpn", "milligan" ] } }' https://bldgsa.ibm.com/api/gsa_groups/p/websphere-tech-u/a123
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-Type: application/gsa-group" -d @add_users.xml https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/group-$SESSION
  
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-Type: application/gsa-group" -d @add_users.xml https://$GSA_CELL/api/gsa_groups/p/$GSA_PROJECT/shared
  rm add_users.xml
  echo -e "    ${opt2}...done adding user lists to group${STD}"

  pause
}

list_user() {
  echo 
  echo "Looking up GSA IDs based on internet address (for example bob@us.ibm.com)..."
  echo

  read -p "Enter users internet email address: " USER_EMAIL

  echo
  echo -e "${RED}  Listing GSA IDs for user $USER_EMAIL${STD}"
  echo

  curl -k --netrc -u $GSA_USER:$password -X GET https://$GSA_CELL/api/gsa_intranet_ids/$USER_EMAIL

  echo -e "    ${opt2}...done listing GSA IDs (r/w)${STD}"
  echo

  pause
}

read_only() {
  echo 
  echo "Setting session to READ ONLY..."
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi

  echo
  echo -e "${RED}  Modifying ACL to READ ONLY for direcorty $SESSION${STD}"
  echo

  echo "<chg_acl>" > mod_acl.xml
  echo "  <chg_obj_acl>" >> mod_acl.xml
  echo "    <mask_ace>rwxc</mask_ace>" >> mod_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">r-x-</ext_group_ace>" >> mod_acl.xml
  echo "  </chg_obj_acl>" >> mod_acl.xml
  echo "  <chg_inh_acl>" >> mod_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">r-x-</ext_group_ace>   " >> mod_acl.xml
  echo "  </chg_inh_acl>" >> mod_acl.xml
  echo "</chg_acl>" >> mod_acl.xml
  # curl -k --netrc -u jpn:xxxxxxxx -X PUT -H "Content-type: text/xml" -d @add_acl.xml https://bldgsa.ibm.com/cgi-bin/acl/add/gsa/projects/w/websphere-tech-u/a123
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-type: text/xml" -d @mod_acl.xml https://$GSA_CELL/cgi-bin/acl/change/$GSA_PATH/$GSA_PROJECT/$SESSION
  rm mod_acl.xml
  echo -e "    ${opt2}...done modifying ACLs (r)${STD}"
  echo

  pause
}

read_write()  {
  echo 
  echo "Setting session to READ/WRITE..."
  echo

  if [ -z "$1" ]; then
    read -p "Enter Session [$SESSION]: " SESSION_NAME
    SESSION=${SESSION_NAME:-$SESSION}
    SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"
  else
    SESSION="$1"
  fi

  echo
  echo -e "${RED}  Modifying ACL to READ/WRITE for direcorty $SESSION${STD}"
  echo

  echo "<chg_acl>" > mod_acl.xml
  echo "  <chg_obj_acl>" >> mod_acl.xml
  echo "    <mask_ace>rwxc</mask_ace>" >> mod_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">rwx-</ext_group_ace>" >> mod_acl.xml
  echo "  </chg_obj_acl>" >> mod_acl.xml
  echo "  <chg_inh_acl>" >> mod_acl.xml
  echo "    <ext_group_ace gsa_group=\"p/$GSA_PROJECT/group-$SESSION\">rwx-</ext_group_ace>   " >> mod_acl.xml
  echo "  </chg_inh_acl>" >> mod_acl.xml
  echo "</chg_acl>" >> mod_acl.xml
  # curl -k --netrc -u jpn:xxxxxxxx -X PUT -H "Content-type: text/xml" -d @add_acl.xml https://bldgsa.ibm.com/cgi-bin/acl/add/gsa/projects/w/websphere-tech-u/a123
  curl -k --netrc -u $GSA_USER:$password -X PUT -H "Content-type: text/xml" -d @mod_acl.xml https://$GSA_CELL/cgi-bin/acl/change/$GSA_PATH/$GSA_PROJECT/$SESSION
  rm mod_acl.xml
  echo -e "    ${opt2}...done modifying ACLs (r/w)${STD}"
  echo

  pause
}

list_session_info() {

  read -p "Enter Session [$SESSION]: " SESSION_NAME
  SESSION=${SESSION_NAME:-$SESSION}
  SESSION="$(tr [A-Z] [a-z] <<< "$SESSION")"

  list_session_directory $SESSION

  list_session_group $SESSION

  list_session_group_members $SESSION
  
  list_shared_group_members

  list_session_ACL $SESSION
 
}

display_readme() {
  echo
  echo "This script attempt to help manage the GSA space for conference lab work."
  echo
  echo "The main function is to save time when creating and managing SESSIONS.  What "
  echo "this means is that if there is alab session called abc1234, this script will "
  echo "create the following:"
  echo "  - A directory called abc1234"
  echo "  - A GSA project group called group-abc1234"
  echo "  - Add a set of GSA users to the project group group-abc1234"
  echo "  - An ACL of RW access for group group-abc1234 on the directory abc1234"
  echo
  echo "Doing these steps manually from the GSA tools tends to be very time consuming."
  echo
  echo "Additionally, the script automates the processes for:"
  echo "  - adding additional users to project groups"
  echo "  - changing ACLs on directories to either RO (read-only) or RW (read-write)"
  echo "  - looking up GSA users from internet email addresses"
  echo
  echo "There are additional functions to list various bits of GSA configuration, "
  echo "including session directory information, session group information, session "
  echo "group membership, and session ACL information."
  echo
  echo "In order to perform these opertions, the script needs to know about the GSA "
  echo "cell, path, project name, user and password.  These need to be made available "
  echo "before starting. Once entered, they can be stored in a local config file "
  echo "(the password is encoded). Upon exit, you have the option to keep or delete "
  echo "the config file."
  echo

  pause
}

# function to display menus
show_menus() {
  clear
  echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"  
  echo " GSA Project / Directory / ACL Maintanence for lab images"
  echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
  echo
  if [ -z $password ]; then 
    echo -e "    ${RED}Password is NOT set.  Use 1) Configure the GSA connection to set${STD}" 
    echo
  fi
  echo "1. Configure the GSA connection (cell, project, user, password)"
  echo "2. Add session (add directory, group, group members, ACL"
  echo "3. Add users (to group)"
  echo "4. List users (lookup GSA IDs)"
  echo "5. Lock directory (set ACL to read only)"
  echo "6. Unlock directory (set ACL to read/write)"
  echo "7. Show configuration"
  echo "9. List functions..."
  echo "98. Display README (explains how things work)"
  echo "99. Exit"
  echo
}

show_list_menu() {
  echo
  echo "91. List Session info (list all the info for a session)"
  echo "92. List Session directory information"
  echo "93. List Session Group information"
  echo "94. List Session Group Membership"
  echo "95. List Session ACL"
  echo "96. List shared Group Membership"
  echo 
  read_options
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
    1|cc) config-connection ;;
    2|as) add_session ;;
    3|au) add_user ;;
    4|lu) list_user ;;
    5|ro) read_only ;;
    6|rw) read_write ;;
    7|sc) show_config ;;
    9|lm) show_list_menu ;;
    91|si) list_session_info ;;
    92|di) list_session_directory ;;
    93|gi) list_session_group ;;
    94|gm) list_session_group_members;;
    95|ai) list_session_ACL ;;
	96|sg) list_shared_group_members ;;
    \?|h) command_help ;;
    98|rm) display_readme ;;
    99) echo
        my_exit ;;
    *) echo -e "${RED}Error...${STD}" && sleep 3
  esac
}

command_help() {
  echo
  echo "q) exit"
  echo "1|cc) config-connection"
  echo "2|as) add_session"
  echo "3|au) add_user"
  echo "4|lu) list_user"
  echo "5|ro) read_only"
  echo "6|rw) read_write"
  echo "7|sc) show_config"
  echo "9|lm) show_list_menu"
  echo "91|si) list_session_info"
  echo "92|di) list_session_directory"
  echo "93|gi) list_session_group"
  echo "94|gm) list_session_group_members"
  echo "95|ai) list_session_ACL"
  echo "96|sg) list_shared_group_members"
  echo "98|rm) Display the README (how this works)"
  echo "99|q) exit / quit"
  echo "\?|h) command help"

  echo

  pause
}

my_exit() {
  if [ -f $RC_FILE ]; then
    echo 
    read -p "Delete existing config file (y/n)? [n]: " DELETE_CONFIG_FILE
    if [ "$DELETE_CONFIG_FILE" = "y" ]; then
      rm $RC_FILE
    fi
  fi
  echo
  exit 0
}

# ----------------------------------------------
# Step #3: Trap CTRL+C, CTRL+Z and quit singles
# ----------------------------------------------
trap '' SIGINT SIGQUIT SIGTSTP
 
 # if there is an rc file with saved configuration, offer to read it
 read_rc_file

# -----------------------------------
# Step #4: Main logic - infinite loop
# ------------------------------------
while true
do
 
  show_menus
  read_options
done
