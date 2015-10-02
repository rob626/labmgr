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
			'torrent_client' => $torrent_client,
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
    	echo "Sending reboot command to: ".$ip;
    	return shell_exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "shutdown -r -t 0 -f"');
    }

}