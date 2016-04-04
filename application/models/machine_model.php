<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Machine_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all machine data.
	 */
	public function get_machines() {
		$q = "SELECT * FROM machine";
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
		$q = "SELECT * FROM machine where room_id = ?";
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "shutdown -s -t 0 -f"', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    		);

    	return $output;
    }

    public function ping_test_arr($machines) {
    	$updated_machines = array();
	    	foreach($machines as $machine) {
	    		$machine['status'] = $this->ping_test($machine['ip_address']);
                $machine['disk_usage'] = false;
                $machine['lab_directories'] = 0;
                $machine['lab_directory_list'] = "";
                $machine['vm_count_list'] = "..";
                $machine['vm_count'] = "..";
                $machine['vm_process_count'] = "-";
                if($machine['status'] == 'ONLINE') {
                    $mac = shell_exec("arp -a " . $machine['ip_address'] . " | awk '{print $4}'");
                    if(trim($machine['mac_address']) == trim($mac)) {
                        $machine['mac_status'] = 'TRUE';
                    } else {
                        $machine['mac_status'] = 'FALSE';
                        //echo "Validation Error! MAC in DB: " .$machine['mac_address']. " MAC from ARP: ".$mac." <br>";
                    }

                    if(!empty($this->disk_usage($machine['ip_address'])['cmd_output'][1])){
                        $machine['disk_usage'] = $this->disk_usage($machine['ip_address'])['cmd_output'][1];
                    }
                    
                    if(!empty($machine['disk_usage'])) {
                        $pos = strrpos($machine['disk_usage'], "%");
                        $machine['disk_usage'] = substr($machine['disk_usage'], $pos-3,3);
                    }

                    // $machine['lab_directory_list'] = $this->lab_directories($machine['ip_address']);
                    // $machine['lab_directories'] = count($machine['lab_directory_list']['cmd_output']);
                    $lab_dir_list = $this->lab_directories($machine['ip_address']);
                    $machine['lab_directories'] = count($lab_dir_list['cmd_output']);
                    $machine['lab_directory_list'] = "- " . implode("\n- ", $lab_dir_list['cmd_output']);

                    $machine['vm_count_list'] = $this->vm_count_list($machine['ip_address']);
                    if(!empty($machine['vm_count_list']['cmd_output'][0])) {
                        $machine['vm_count'] = preg_replace('/\D/', '', $machine['vm_count_list']['cmd_output'][0]);
                        $machine['vm_process_count'] = $this->vm_processes($machine['ip_address'])['cmd_output'][0];
                    }
                    
                    if ($machine['vm_process_count'] == 0) {
                        $machine['vm_count'] = "-";
                    }
                }

                array_push($updated_machines, $machine);
	    	}
	    	return $updated_machines;
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
     * Clean up (delete) the dropins directory.
     */
    public function clean_dropins($ip) {
    	$output = array(
    		'status' => "Sending rm -rf command to: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "rm -rf /cygdrive/c/labmgr-wd/dropins/* "', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "cat /cygdrive/c/labmgr-wd/labmgr-logfile.log "', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "df -h "', $cmd_output, $exit_status),
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
            // 'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "find /cygdrive/c/Labs/* -maxdepth 0 -type d | wc -l "', $cmd_output, $exit_status),
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" ibm_user@' . $ip . ' "find /cygdrive/c/Labs/* -maxdepth 0 -type d "', $cmd_output, $exit_status),
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
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "vmrun -T ws list "', $cmd_output, $exit_status),
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
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "ps -eW | grep -i vmware | wc -l "', $cmd_output, $exit_status),
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
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
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
            'status' => "Attempting to send file ".$file . " to " .$ip. " remote path: " . $remote_path,
            'output' => exec('scp -r -i ./certs/labmgr -o "StrictHostKeyChecking no " '.$file.' ibm_user@' . $ip . ':'.$remote_path, $cmd_output, $exit_status),
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
     * Delete lab dir from machine
     */
    public function delete_lab_dir($ip, $path) {
        $output = array(
            'status' => "Deleting dir: ".$path.", on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" ibm_user@' . $ip . ' "rm -rf '.$path.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

}