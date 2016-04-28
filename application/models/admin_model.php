<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all torrent_client data.
	 */
	public function get_torrent_clients() {
		$q = "SELECT * FROM torrent_client";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get torrent_client data by torrent_client ID.
	 */
	public function get_torrent_client($torrent_client_id) {
		$q = "SELECT * FROM torrent_client where torrent_client_id = ?";
		$result = $this->db->query($q, $torrent_client_id);
		return $result->result_array();
	}

    /**
     * Update torrent_client data a torrent_client ID.
     */
    public function update_torrent_client($torrent_client_id, $torrent_client_name, $torrent_client_desc) {
    	$this->db->trans_start();

    	$this->db->where('torrent_client_id', $torrent_client_id);
    	$this->db->update('torrent_client', array(
    		'name' => $torrent_client_name, 
    		'description' => $torrent_client_desc,
    		'last_update_timestamp' => date("Y-m-d H:i:s")
    		)
    	);

    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

    /**
     * Add a torrent_client record.
     */
    public function add_torrent_client($torrent_client_name, $torrent_client_desc) {
    	
    	$result = $this->db->query("SELECT * FROM torrent_client where name = ?", $torrent_client_name);
    	$result = $result->result_array();

    	if(isset($result[0]['torrent_client_id'])) {
    		return $result[0]['torrent_client_id'];
    	} else {
    		$data = array(
				'name' => $torrent_client_name,
				'description' => $torrent_client_desc
			);
			$this->db->insert('torrent_client', $data);

    	return $this->db->insert_id();
    	}
    }
    

    /**
     * Delete a torrent_client
     */
    public function delete_torrent_client($torrent_client_id) {
    	$this->db->trans_start();
    	$this->db->where('torrent_client_id', $torrent_client_id);
    	$this->db->delete('torrent_client');
    	$this->db->trans_complete();
    	
    	return $this->db->trans_status();
    }

    /**
     * Get all operating_system data.
     */
    public function get_operating_systems() {
        $q = "SELECT * FROM os";
        $result = $this->db->query($q);
        return $result->result_array();
    }

    /**
     * Get operating_system data by operating_system ID.
     */
    public function get_operating_system($operating_system_id) {
        $q = "SELECT * FROM os where os_id = ?";
        $result = $this->db->query($q, $operating_system_id);
        return $result->result_array();
    }

    /**
     * Update operating_system data a operating_system ID.
     */
    public function update_operating_system($operating_system_id, $operating_system_name, $operating_system_desc) {
        $this->db->trans_start();

        $this->db->where('os_id', $operating_system_id);
        $this->db->update('os', array(
            'name' => $operating_system_name, 
            'description' => $operating_system_desc,
            'last_update_timestamp' => date("Y-m-d H:i:s")
            )
        );

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Add a operating_system record.
     */
    public function add_operating_system($operating_system_name, $operating_system_desc) {
        
        $result = $this->db->query("SELECT * FROM os where name = ?", $operating_system_name);
        $result = $result->result_array();

        if(isset($result[0]['os_id'])) {
            return $result[0]['os_id'];
        } else {
            $data = array(
                'name' => $operating_system_name,
                'description' => $operating_system_desc
            );
            $this->db->insert('os', $data);

        return $this->db->insert_id();
        }
    }
    

    /**
     * Delete a operating_system
     */
    public function delete_operating_system($operating_system_id) {
        $this->db->trans_start();
        $this->db->where('os_id', $operating_system_id);
        $this->db->delete('os');
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    /**
     * Export the current database.
     */
    public function export_db($backup_file=NULL) {
        if(empty($backup_file)) {
            $output = array(
                'status' => "Running script...",
                'output' => exec('./database/backup_db.sh', $cmd_output, $exit_status),
                'cmd_output' => $cmd_output,
                'exit_status' => $exit_status
            );
        } else {
            $output = array(
                'status' => "Running script...",
                'output' => exec('./database/backup_db.sh '. $backup_file, $cmd_output, $exit_status),
                'cmd_output' => $cmd_output,
                'exit_status' => $exit_status
            );
        }
        

        $backups = scandir(DB_BACKUP_DIR);
        foreach($backups as $key => $value) {
            if($value == '.' || $value == '..') {
                    unset($backups[$key]);
            }
        }
        $output['current_backups'] = $backups;
        return $output;
    }

    public function import_db($backup_file) {
        $backup_file = DB_BACKUP_DIR.$backup_file;

        $output = array(
                'status' => "Running import script...",
                'output' => exec('./database/import_db.sh ' . $backup_file, $cmd_output, $exit_status),
                'cmd_output' => $cmd_output,
                'exit_status' => $exit_status
            );

        $backups = scandir(DB_BACKUP_DIR);
        foreach($backups as $key => $value) {
            if($value == '.' || $value == '..') {
                    unset($backups[$key]);
            }
        }
        $output['current_backups'] = $backups;
        return $output;
    }

    /*
     * Get current backups
     */
    public function get_db_backups() {
        $backups = scandir(DB_BACKUP_DIR);
        foreach($backups as $key => $value) {
            if($value == '.' || $value == '..') {
                    unset($backups[$key]);
            }
        }

        return $backups;
    }

    /**
     * Change or update backup file name.
     */
    public function update_backup_name($old_name, $new_name) {
         return rename(DB_BACKUP_DIR.$old_name, DB_BACKUP_DIR.$filename);
    }

    /**
     * This function looks at the MAC addresses in the 
     * database and checks to see if they are still mapped
     * to the IP addresses in the ARP. 
     */
    public function validate_ips() {
        $sql = "SELECT machine_id, ip_address, mac_address FROM machine;";
        $result = $this->db->query($sql);
        $machines = $result->result_array();
        $output = array();

        foreach($machines as $machine) {
            if(!empty($machine['mac_address']) && $machine['mac_address'] != 'Unable to get MAC Address.') {
                shell_exec("ping -c 1 " . $machine['ip_address']);
                $arp_mac = shell_exec("arp -a " . $machine['ip_address'] . " | awk '{print $4}'");
            
                if(trim($machine['mac_address']) == trim($mac_arp)) {
                    //echo "They match";
                } else {
                    $output[] = "Validation Error! MAC in DB: " .$machine['mac_address']. " MAC from ARP: ".$mac." <br>";
                    //echo "Validation Error! MAC in DB: " .$machine['mac_address']. " MAC from ARP: ".$mac." <br>";
                }

            }
        }

        return $output;
    }

    /**
     * Validate MAC addresses against IPs. This is the inverse of the above function.
     * Take the IP address, check if it is in the arp table.  
     * Return the machine information only if the IP address does not match
     */
    public function validate_mac($ip) {
        $output = '';
        // No need to ping... fping already called.  Check arp table.
        $arp_mac = shell_exec("arp -a " . $ip . " | awk '{print $4}'");
        
        $this->logging->lwrite("Validating MAC 1 (ip=".$ip.",MAC=".$arp_mac.")");
        if(!empty($arp_mac)) {
            if(trim($arp_mac) != 'entries') {
                // Found the IP address in the arp table.  Check the DB entry for the MAC address
                $this->logging->lwrite("Validating MAC (ip=".$ip.",MAC=".$arp_mac.")");
                $sql = "SELECT * FROM machine where mac_address = ?";
                $result = $this->db->query($sql, trim($arp_mac));
                if($result->num_rows() >= 1) {
                    $machine = $result->result_array();
                    $machine = $machine[0];
                }
                
                if(!empty($machine)) {
                    // Check to see if the entry in the DB for the MAC has the same IP address
                    if(trim($machine['ip_address']) == trim($ip)) {
                        // The IP address in the DB matches the IP address in the arp table, do nothing
                        //$output = $machine['ip_address'] .' = '. $ip;
                    } else {
                        // The IP in the DB does not match, that means we have an IP address change
                        //$output = "Validation Error: ". $machine;
                        $machine['new_ip'] = $ip;
                        $machine['room_name'] = $this->room_model->get_room($machine['room_id']);
                        $this->logging->lwrite("Validating MAC - room name =".$machine['room_name']);
                        $output = "Validation Error! RoomID: ".$machine['room_id']." Seat: ".$machine['seat']." MAC:" .$machine['mac_address']. " Old IP: ".$machine['ip_address']." New IP: ".$ip." <br>";
                        //echo "Validation Error! MAC in DB: " .$machine['mac_address']. " MAC from ARP: ".$mac." <br>";
                        return $machine;
                    }
                }
            }
        }
        
    }

    /**
     * Update IP address based on Machine ID.
     */
    public function update_validated_ip($id, $new_ip) {
        $this->db->trans_start();

        $this->db->where('machine_id', $id);
        $this->db->update('machine', array(
            'ip_address' => $new_ip, 
            'last_update_timestamp' => date("Y-m-d H:i:s")
            )
        );

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}