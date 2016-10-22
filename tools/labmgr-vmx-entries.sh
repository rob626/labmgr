#!/bin/bash
#RED='\033[0;41;30m'
RED='\033[0;45;37m'
opt1='\033[0;31;41m'
opt2='\033[0;44;39m'
STD='\033[0;0;39m'

DEF_search_root=C:/Labs
DEF_vmware_path=C:/Program\ Files\ \(x86\)/VMware/VMware\ Workstation/
tmp_file=delete.tmp
 
echo_vm_name() {
    vm_name2="$(cut -d/ -f3<<<$1)"
    vm_name3="$(cut -d/ -f4<<<$1)"

    if [[ $vm_name3 == *".vmx"* ]]; then
	vm_name3=""
    fi

    case "$nameformat" in
	"23") if [ "$vm_name3" == "" ]; then 
		vm_name=$vm_name2
	    else
		vm_name=$vm_name2-$vm_name3
	    fi ;;
	"2") vm_name=$vm_name2 ;;
	"3") if [ "$vm_name3" == "" ]; then 
		vm_name=$vm_name2
	    else
		vm_name=$vm_name3
	    fi ;;
    esac

    echo -n "$vm_name, "
}

generate_vmx_snapshot_report() {
  find $search_root -name "*vmx" -type f -exec ls {} \; > $tmp_file

  while IFS='' read -r -u9 line || [[ -n "$line" ]]; do
    echo_vm_name "$line"
    echo -n "$line,"

    snapshot_list=$("$vmware_path/vmrun.exe" listSnapshots "$line")
    readarray -t snapshot_array <<<"$snapshot_list"

    if [ "$snapshots" == "multiple" ]; then
	snapshot_output=""
	for (( i=1; i <= 20; ++i )); do 
	    if [ -n "${snapshot_array[i]}" ]; then
		snapshot_output+=$(echo "///${snapshot_array[i]}" | tr -d '\r')
	    fi
	done
	if [ "$snapshot_output" == "" ]; then
	    echo ";"
	else
	    echo "$snapshot_output;"
	fi
    fi

    if [ "$snapshots" == "single" ]; then
	if [ ${#snapshot_array[@]} = 1 ]; then
	    echo ";"
	else
	    echo "///${snapshot_array[-1]};" | tr -d '\r'
	fi
    fi

    if [ "$snapshots" == "none" ]; then
	echo ";"
    fi
  done 9< "$tmp_file"  
  
  rm $tmp_file
}

my_exit() {
  if [ "$quietmode" == "no" ]; then
      echo
  fi

  exit 0
}

search_root=$DEF_search_root
vmware_path=$DEF_vmware_path

quietmode=no
header=no
snapshots=none
nameformat=23

for var in "$@"; do
    case $var in
	q|quiet) quietmode=yes ;;
	h|header) header=yes ;;
	n|none) snapshots=none ;;
	s|single) snapshots=single ;;
	m|multiple) snapshots=multiple ;;
	r=*|root=*) search_root="${var#*=}" ;;
	23) nameformat=23 ;;
	2) nameformat=2 ;;
	3) nameformat=3 ;;
	*) echo -e "${RED}Error...${STD}" && my_exit
    esac
done

if [ "$quietmode" == "no" ]; then
    echo
    echo "This script outputs the list of vmx files under C:\Labs in the following format:"
    echo "    vm-name, vmx-path,///snapshot///snapshot///snapshot;"
    echo 
    echo "Use command line arguments to control the snapshot list:"
    echo "    none | n (default) - no snapshots"
    echo "    single | s - single snapshot (latest snapshot)"
    echo "    multiple | m  - multiple snapshots"
    echo
    echo "Use command line arguemnts to control the name (given C:\Labs\A123\vm1\myvm.vmx)"
    echo "    23 (default) - use the 2nd-3rd element of the path for the name (A123-vm1)"
    echo "    2 - use the 2nd element of the path for the name (A123)"
    echo "    3 - use the 3rd element of the path for the name (vm1)"
    echo
    echo "Use command line arguement q|quiet to suppress this intial help, and h|header to"
    echo "    add a header line with the host IP address to the start of the output "
    echo
    echo "Use command line arguement r|root=<root-path> to change the default search root from C:\Labs"
    echo 
    echo "To run the script remotely, try:"
    echo "    ssh IBM_USER@9.37.99.76 'bash -s multiple 23' < labmgr-vmx-entries.sh"
    echo "    ssh IBM_USER@9.37.99.76 'bash -s single 3' < labmgr-vmx-entries.sh > output.log"
    echo
    
    echo "Looking for VMX files under $search_root (snapshots=$snapshots, name=$nameformat)"
    echo
fi

if [ "$header" == "yes" ]; then
    my_ip=$(ipconfig | grep -i "IPv4 Address" | cut -d: -f2 | head -1)
    echo $my_ip:
fi

generate_vmx_snapshot_report
my_exit

