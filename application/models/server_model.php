<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all server data.
	 */
	public function get_servers() {
		$q = "SELECT * FROM server";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get server data by server ID.
	 */
	public function get_server($server_id) {
		$q = "SELECT * FROM server where server_id = ?";
		$result = $this->db->query($q, $server_id);
		return $result->result_array();
	}

	    /**
	     * Update server data a server ID.
	     */
	    public function update_server($server_id, $server_name, $server_desc) {
	    	$this->db->trans_start();

	    	$this->db->where('server_id', $server_id);
	    	$this->db->update('server', array(
	    		'name' => $server_name, 
	    		'description' => $server_desc,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a server record.
	     */
	    public function add_server($server_name, $server_desc) {
	    	
	    	$result = $this->db->query("SELECT * FROM server");
	    	$result = $result->result_array();

	    	if(isset($result[0]['server_id'])) {
	    		$result = $this->server_model->update_server($result[0]['server_id'], $server_name, $server_desc);
	    		return $result[0]['server_id'];
	    	} else {
	    		$data = array(
					'name' => $server_name,
					'description' => $server_desc
				);
				$this->db->insert('server', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a server
	     */
	    public function delete_server($server_id) {
	    	$this->db->trans_start();
	    	$this->db->where('server_id', $server_id);
	    	$this->db->delete('server');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}