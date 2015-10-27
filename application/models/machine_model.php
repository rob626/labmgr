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
	
		$data = array(
			'room_id' => $room_id,
			'seat' => $seat,
			'mac_address' => $mac_address,
			'ip_address' => $ip_address,
			'operating_system' => $operating_system,
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
			'operating_system' => $operating_system,
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
    public function reboot($ip) {
    	//echo "Sending reboot command to: ".$ip;
    	$output = array(
    		'status' => "Sending reboot command to: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "shutdown -r -t 0 -f"', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "shutdown -s -t 0 -f"', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    		);

    	return $output;
    }

    public function ping_test_arr($machines) {
    	$updated_machines = array();
	    	foreach($machines as $machine) {
	    		$machine['status'] = $this->ping_test($machine['ip_address']);
                $machine['disk_usage'] = $this->disk_usage($machine['ip_address'])['cmd_output'][1];
	    		$pos = strrpos($machine['disk_usage'], "%");
                $machine['disk_usage'] = substr($machine['disk_usage'], $pos-3,3);
                array_push($updated_machines, $machine);
	    	}
	    	return $updated_machines;
    }

    /**
     * Return the status of the machine by doing a ping test
     */
    public function ping_test($ip) {
    	$host = $ip; 
		$port = 22; 
		$waitTimeoutInSeconds = 1; 
		if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
		   return "ONLINE";
		} else {
		   return "OFFLINE";
		} 
		fclose($fp);
    }

    /**
     * Clean up (delete) the dropins directory.
     */
    public function clean_dropins($ip) {
    	$output = array(
    		'status' => "Sending rm -rf command to: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "rm -rf /cygdrive/c/labmgr-wd/dropins/* "', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "cat /cygdrive/c/labmgr-wd/labmgr-logfile.log "', $cmd_output, $exit_status),
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
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "df -h "', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
    	);

    	return $output;
    }

    /*
     *
     */
    public function run_cmd($cmd, $ip) {
        $output = array(
            'status' => "Running command,".$cmd.", on: ".$ip,
            'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "'.$cmd.'"', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        return $output;
    }

}