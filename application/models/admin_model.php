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

}