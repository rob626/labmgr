<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Machine_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all machine data.
	 */
	public function get_machines() {
		//$q = "SELECT machine FROM machine";
        $q = "SELECT m.*, r.name from machine m, room r where m.room_id = r.room_id";
		$result = $this->db->query($q);
		return $result->result_array();
	}

    public function get_next_seat($room_id) {
        $q = "SELECT * FROM machine where room_id = ? ORDER by seat desc";
        $result = $this->db->query($q, $room_id);
        $result = $result->result_array();
        return $result[0]['seat']+1;
         
    }

    /**
     * Get machine by IP address.
     */
    public function get_machine_ip($ip) {
        $q = "SELECT * FROM machine where ip_address = ?";
        $result = $this->db->query($q, $ip);
        $result = $result->result_array();
        return $result[0];
    }

	/**
	 * Get machine data by machine ID.
	 */
	public function get_machine($machine_id) {
		$q = "SELECT * FROM machine where machine_id = ?";
		$result = $this->db->query($q, $machine_id);
		return $result->result_array();
	}

	/**
	 * Get machines by room ID
	 */
	public function get_machines_by_room($room_id) {
		$q = "SELECT m.*, r.name FROM machine m, room r where m.room_id = r.room_id AND m.room_id = ?";
		$result = $this->db->query($q, $room_id);
		return $result->result_array();
	}

    /**
     * Add a machine record.
     */
    public function add_machine($room_id, $seat, $mac_address, $ip_address, $operating_system, $username, $password, $torrent_client, $transport_type) {
	    if(empty($mac_address)) {
            $mac_address = $this->get_mac($ip_address);
        }

		$data = array(
			'room_id' => $room_id,
			'seat' => $seat,
			'mac_address' => $mac_address,
			'ip_address' => $ip_address,
			'os_id' => $operating_system,
			'username' => $username,
			'password' => $password,
			'torrent_client_id' => $torrent_client,
			'transport_type' => $transport_type
		);
		$this->db->insert('machine', $data);

	return $this->db->insert_id();
    	
    }

	/**
     * Update machine data a machine ID.
     */
    public function update_machine($machine_id, $room_id, $seat, $mac_address, $ip_address, $operating_system, $username, $password, $torrent_client, $transport_type) {
    	$this->db->trans_start();

    	$this->db->where('machine_id', $machine_id);
    	$this->db->update('machine', array(
    		'room_id' => $room_id,
			'seat' => $seat,
			'mac_address' => $mac_address,
			'ip_address' => $ip_address,
			'os_id' => $operating_system,
			'username' => $username,
			'password' => $password,
			'torrent_client_id' => $torrent_client,
			'transport_type' => $transport_type,
    		'last_update_timestamp' => date("Y-m-d H:i:s")
    		)
    	);

    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

	/**
     * Delete a machine
     */
	public function delete_machine($machine_id) {
		$this->db->trans_start();
		$this->db->where('machine_id', $machine_id);
		$this->db->delete('machine');
		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	/**
     * Reboot machine
     */
    public function reboot($ip, $os_id) {
    	//echo "Sending reboot command to: ".$ip;


        switch ($os_id) {
            case 1: //Windows
                $cmd = 'shutdown -r -t 0 -f';
                break;
            case 2: //Linux
                $cmd = 'sudo reboot';
                break;
            case 3: //Mac
                $cmd = 'sudo reboot';
                break;
            default:
                echo "Invalid OS";
        }
        

    	$output = array(
    		'status' => "Sending reboot command to: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    		);
  
    	return $output;
    }

    /**
     * Shutdown machine
     */
    public function shutdown($ip) {
    	//echo "Sending shutdown command to: ".$ip;
    	$output = array(
    		'status' => "Sending shutdown command to: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "shutdown -s -t 0 -f"', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    		);

    	return $output;
    }

    /**
     * Mouse move
     */
    public function mouse_move($ip) {
        $command = "echo Dim objResult > \delete-me.vbs \n";
        $command .= "echo Set objShell = WScript.CreateObject(\"WScript.Shell\") >> \delete-me.vbs \n";
        $command .= "echo objResult = objShell.sendkeys(\"{NUMLOCK}{NUMLOCK}\") >> \delete-me.vbs \n";
        $command .= "\n";
        $command .= "cscript //nologo \delete-me.vbs\n";
        $command .= "\n";
        $command .= "del \delete-me.vbs\n";

        $file = './uploads/mouse_move.bat';

        file_put_contents($file, $command);

        $output = array(
            'status' => "Sending mouse move to: ".$ip,
            'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
            'cmd' => $command,
            'exit_status' => ''
        );

        unlink($file);
        return $output;
    }

    public function check_machine_status($machines) {
    	$updated_machines = array();
            
        $machines = $this->just_ping_test($machines);
    	foreach($machines as $machine) {
            $machine['disk_usage'] = false;
            $machine['lab_directories'] = 0;
            $machine['lab_directory_list'] = "";
            $machine['vm_count'] = "..";
            $machine['vm_process_count'] = "-";
            if($machine['status'] == 'ONLINE') {
                $machine_statuses = implode("\n", $this->get_machine_statuses($machine['ip_address'])['cmd_output']);
                //print_r($machine_statuses);
                $machine['disk_usage'] = $this->parse_string($machine_statuses, "===1===", "===2===");
                
                if(!empty($machine['disk_usage'])) {
                    $pos0 = strpos($machine['disk_usage'], "%");
                    $pos = strpos($machine['disk_usage'], "%", $pos0 + 1);
                    $machine['disk_usage'] = trim(substr($machine['disk_usage'], $pos-3,3));
                }
                
                $lab_dir_list = trim($this->parse_string($machine_statuses, "===2===", "===3==="));
                $machine['lab_directories'] = substr_count($lab_dir_list, "\n") + 1;
                $machine['lab_directory_list'] = "- " . str_replace("\n", "\n- ", $lab_dir_list);

                $machine['running_vm_list'] = trim($this->parse_string($machine_statuses, "===3===", "===4==="));
                if(!empty($machine['running_vm_list'])) {
                    $machine['running_vm_list'] = str_replace("\n", "\n- ", $machine['running_vm_list']);
                    $machine['vm_count'] = substr_count($machine['running_vm_list'], "\n");
                    $machine['vm_process_count'] = trim($this->parse_string($machine_statuses, "===4===", "===5==="));
                }
                
                if ($machine['vm_process_count'] == 0) {
                    $machine['vm_count'] = "-";
                }
            }

            array_push($updated_machines, $machine);
    	}

    	return $updated_machines;
    }

    public function just_ping_test($machines) {
        $chunk_size = 20;
        $current = 0;
        $machine_count = count($machines);

        while($current < $machine_count) {
            $machine_list = "";
            $max = $current + $chunk_size;
            if($max > $machine_count) $max = $machine_count;

            // build list of IP addresses to check
            for ($i = $current; $i < $max; $i++) {
                $machine_list .= $machines[$i]['ip_address'] . " ";
            }

            // get a list of machines NOT online (-u only lists those not connected)
            $output = shell_exec('fping -r 0 -t500 -u ' . $machine_list);

            for ($i = $current; $i < $max; $i++) {
                if (strpos($output, $machines[$i]['ip_address']) !== false) {
                   $machines[$i]['status'] = "OFFLINE";
                    if (array_key_exists('mac_address', $machines[$i])) {
                        $machines[$i]['mac_status'] = 'FALSE';
                    }
                } else {
                    $machines[$i]['status'] =  "ONLINE";
                    if (array_key_exists('mac_address', $machines[$i])) {
                        $mac = shell_exec("arp -a " . $machines[$i]['ip_address'] . " | awk '{print $4}'");
                        if(strcasecmp(trim($machines[$i]['mac_address']), trim($mac)) == 0 ) {
                            $machines[$i]['mac_status'] = 'TRUE';
                        } else {
                            $machines[$i]['mac_status'] = 'FALSE';
                            //echo "Validation Error! MAC in DB: " .$machine['mac_address']. " MAC from ARP: ".$mac." <br>";
                        }
                    }
                }
            }
            $current += $chunk_size;
        }

        return $machines;
    }

    /**
     * Return the status of the machine by doing a ping test
     */
    public function ping_test($ip) {
    	$output = exec("ping -c1 -n -W 1 ".$ip, $cmd_output, $exit_status);

        if($exit_status == 0){   
		   return "ONLINE";
		} else {
		   return "OFFLINE";
		} 
    }

    /**
     * Get statuses 1 - disk usage, 2 - lab dirs, 3 - vm-running, 4 - vm-processes 
     */
    public function get_machine_statuses($ip) {
        //echo "Sending shutdown command to: ".$ip;
        $output = array(
            'status' => "Sending shutdown command to: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 5" IBM_USER@' . $ip . ' "echo ===1===; df -h; echo ===2===; find /cygdrive/c/Labs/*  -maxdepth 0 -type d ; echo ===3===; vmrun -T ws list; echo ===4===; ps -eW | grep -i vmware.exe | wc -l; echo ===5==="', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
            );

        return $output;
    }

    public function parse_string($string, $start, $end) {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * Clean up (delete) the dropins directory.
     */
    public function cleanup_watchdog_dropins($ip) {
        //echo $ip;
    	$output = array(
    		'status' => "Cleaning up dropins directory on: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "rm -rf /cygdrive/c/labmgr-wd/dropins/* "', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    	);

    	return $output;
    }

    /**
     * Clean up (delete) the hasbeenrun directory.
     */
    public function cleanup_watchdog_hasbeenrun($ip) {
        $this->logging->lfile("./application/logs/test_lfile");
        $this->logging->lwrite("clean_watchdog_hasbeenrun (model)");

        $output = array(
            'status' => "Cleaning up hasbeenrun directory on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "rm -rf /cygdrive/c/labmgr-wd/hasbeenrun/* "', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Clean up (delete) the wd logfile.
     */
    public function cleanup_watchdog_logfile($ip) {
        $output = array(
            'status' => "Cleaning up watchdog logfile on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "rm -rf /cygdrive/c/labmgr-wd/labmgr-logfile.log "', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }
    /**
     * Connect to a remote machine and view the watch dog's log file.
	 */
    public function view_watchdog_log($ip) {
    	$output = array(
    		'status' => "Attempting to read remote logfile: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "cat /cygdrive/c/labmgr-wd/labmgr-logfile.log "', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    	);

    	return $output;
    }

    /**
     * Connect to a remote machine and view disk usage.
	 */
    public function disk_usage($ip) {
    	$output = array(
    		'status' => "Attempting to read remote disk usage: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "df -h "', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    	);

    	return $output;
    }

    /**
     * Connect to a remote machine and get count for lab directories.
     */
    public function lab_directories($ip) {

        $output = array(
            'status' => "Attempting to count lab directories: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "find /cygdrive/c/Labs/* -maxdepth 0 -type d "', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Connect to a remote machine and get count of vm images currently running.
     */
    public function vm_count_list($ip) {
        $output = array(
            'status' => "Attempting to count running vms: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "vmrun -T ws list "', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Connect to a remote machine and get count of vm images currently running.
     */
    public function vm_processes($ip) {
        $output = array(
            'status' => "Attempting to count running vmware processes: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "ps -eW | grep -i vmware | wc -l "', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }


    /*
     * Run a command on a machine.
     */
    public function run_cmd($cmd, $ip) {
        $output = array(
            'status' => "Running command,".$cmd.", on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    public function show_desktop($ip) {
        $command = "powershell -command \"& { \$x = New-Object -ComObject Shell.Application; \$x.minimizeall() }\"";
        $file = './uploads/show_desktop.bat';

        file_put_contents($file, $command);

        $output = array(
            'status' => "Sending Show desktop to: ".$ip,
            'output' => exec('scp -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        unlink($file);
        return $output;
    } 

    public function bg_info_config($ip, $content) {

        $cmd = 'echo '. $content . ' > /cygdrive/c/labmgr-seat-info.txt';

        $output = array(
            'status' => 'Sending BGinfo Config to ' . $ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Send a file to a machine using scp.
     */
    public function send_file($file, $remote_path, $ip) {
        $output = array(
            'status' => "mkdir: Attempting to send file ".$file . " to " .$ip. " remote path: " . $remote_path,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "mkdir -p '.$remote_path.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        $output = array(
            'status' => "Attempting to send file ".$file . " to " .$ip. " remote path: " . $remote_path,
            'output' => exec('scp -r -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" '.$file.' IBM_USER@' . $ip . ':'.$remote_path, $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }


    /**
     * Get a file from a machine using scp.
     */
    public function get_remote_file($remote_path, $ip) {
        //mkdir("./uploads/".$ip);
        $output = array(
            'status' => "Attempting to get file(s) from remote path: " . $remote_path. " from " .$ip ,
            'output' => exec('scp -r -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ':'.$remote_path.' ./uploads/'.$ip.'/', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Returns MAC Address.
     */
    public function get_mac($ip) {

        $output = array(
            'status' => "Grepping for: ".$ip,
            'output' => exec("arp -a " . $ip . " | awk '{print $4}'", $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        if(!empty($cmd_output[0]) && $cmd_output[0] != 'entries') {
            return $cmd_output[0];
        } else {
            return 'Unable to get MAC Address.';
        }

    }

    /**
     * Returns MAC Address via ssh and vbs script.
     */
    public function get_mac_via_ssh($ip) {
        // Copy over getmac.vbs
        $command = "if WScript.Arguments.Count = 0 Then Wscript.Quit 2001 \n";
        $command .= "Dim ObjWMI: Set ObjWMI = GetObject(\"winmgmts:{impersonationLevel=impersonate}!\\\\.\\root\\cimv2\") \n";
        $command .= "Dim colItems : Set NICS = ObjWMI.ExecQuery(\"Select * From Win32_NetworkAdapterConfiguration Where IPEnabled = True\") \n";
        $command .= "Dim adapterCFG, IPaddr \n";
        $command .= "For each adapterCFG in NICS 'Loop through adapters and get needed information.... \n";
        $command .= " For Each IPaddr  in adapterCFG.IPAddress \n";
        $command .= "  if WScript.Arguments.Item(0) = IPaddr Then \n";
        $command .= "    WScript.Echo adapterCFG.MACAddress \n";
        $command .= "  End if \n";
        $command .= " Next  \n";
        $command .= "Next  \n";
        $command .= "WScript.Quit 2001 \n";

        $file = './uploads/getmac.vbs';

        file_put_contents($file, $command);

        $output = array(
            'status' => "Sending getmac.vbs to: ".$ip,
            'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/temp/'),
            'cmd' => $file,
            'exit_status' => ''
        );
        unlink($file);
        
        $output = array(
            'status' => "ssh to machine to get MAC address: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip .' "cscript //nologo C:/temp/getmac.vbs ' . $ip.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        if(!empty($cmd_output[0]) && $cmd_output[0] != 'entries') {
            return $cmd_output[0];
        } else {
            return 'Unable to get MAC Address.';
        }

    }

    /**
     * Delete lab dir from machine
     */
    public function delete_lab_dir($ip, $path) {
        $output = array(
            'status' => "Deleting dir: ".$path.", on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "rm -rf '.$path.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

    /**
     * Find all the broken MAC addresses in the DB and attempt to fix them.
     */
    public function fix_broken_macs() {
        $result = $this->get_broken_macs();
        $output = array();

        /* echo "<pre>";
        print_r($result);
        echo "</pre>"; */

        foreach($result as $machine) {
            shell_exec("fping -r 0 -t500 -q -g " . $machine['ip_address']);
             
            $mac = $this->get_mac($machine['ip_address']);

            // If the MAC address wasn't available through the arp table (for example, the machine
            // has a router between it and the labmgr server), attempt to ssh and ask the machine 
            // to return the MAC address 
            if($mac = 'Unable to get MAC Address.') {
                $mac = $this->get_mac_via_ssh($machine['ip_address']);
            }

            if($mac != 'Unable to get MAC Address.') {
                $retval = $this->update_machine($machine['machine_id'], $machine['room_id'], $machine['seat'], $mac, $machine['ip_address'], $machine['os_id'],$machine['username'],$machine['password'],$machine['torrent_client_id'], $machine['transport_type']);
                $machine['mac_address'] = $mac;
                if($retval) {
                    $output[] = $machine;
                }
            }
        }
        return $output;
    }

    /**
     * Find all the missing or null MAC addresses. 
     */
    public function get_broken_macs() {
        $q = "SELECT * FROM machine where mac_address like '%Unable to get MAC Address.%' OR mac_address is null OR mac_address = ''";
        $result = $this->db->query($q);
        $result = $result->result_array();

        return $result;
    }

    /**
     * Determine if all seats are sequential and 
     * if there are any duplicates.
     */
    public function validate_seats($room_id) {
        $q = "SELECT * FROM machine where room_id = ? order by seat";
        $result = $this->db->query($q, $room_id);
        $result = $result->result_array();

        $output = array();

        $seats = array();
        foreach($result as $machine) {
            $seats[] = $machine['seat'];
        }

        $dupes = array();
        $misses = array();
        $missing_seats="";
        $duplicate_seats="";
        if(!empty($seats)) {
            for($i = 1; $i <= max($seats); $i++) {  // look to see if possible seats 1..max in the list
                $this_seat_count=0; // start by assuming seat is not there

                for($j = 0; $j < count($seats); $j++) { // loop through list of seats and count instances of this seat
                    if($i == $seats[$j]) $this_seat_count++;
                }

                if($this_seat_count==0) {
                    $misses[] = $i;
                }
                if($this_seat_count>1) {
                    for($j = 1; $j< $this_seat_count; $j++) {
                        $dupes[] = $i;
                    }
                }
            }
        }
        $output['missing_seats'] = $misses;
        $output['duplicates'] = $dupes;

        return $output;

    }

    /**
     * See if there are any duplicate IP addresses or MAC addresses
     */
    public function machine_duplicates() {
        $output = array();
        $machines_mac = array();
        $machines_ip = array();

        $this->logging->lwrite("Checking for duplicate machines (ip and mac addresses)");

        $q = "SELECT ip_address, COUNT(*) c FROM machine GROUP BY ip_address HAVING c > 1";
        $ip_results = $this->db->query($q);
        $ip_results = $ip_results->result_array();

        $q = "SELECT mac_address, COUNT(*) c FROM machine GROUP BY mac_address HAVING c > 1";
        $mac_results = $this->db->query($q);
        $mac_results = $mac_results->result_array();

        $count = 0;
        foreach($ip_results as $result) {
            $this->logging->lwrite("- IP address: ".$result['ip_address']." count: ".$result['c']);
            $q = "SELECT * FROM machine where ip_address = ?";
            $result = $this->db->query($q, trim($result['ip_address']));
            $machines_dup_ip = $result->result_array();
            $ip_results[$count]['machines'] = $machines_dup_ip;
            //print_r($machines_dup_ip);
            $count++;
        }

        $count = 0;
        foreach($mac_results as $result) {
            $this->logging->lwrite("Mac address: ".$result['mac_address']." count: ".$result['c']);
            $q = "SELECT * FROM machine where mac_address = ?";
            $result = $this->db->query($q, trim($result['mac_address']));
            $machines_dup_mac = $result->result_array();
            $mac_results[$count]['machines'] = $machines_dup_mac;
            //print_r($machines_dup_mac);
            $count++;
        }

        $output['duplicate_ips'] = $ip_results;
        $output['duplicate_macs'] = $mac_results;

        return $output;
    }
}