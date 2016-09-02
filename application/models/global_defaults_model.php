<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_defaults_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all global_defaults data.
	 */
	public function get_global_defaults() {
		$q = "SELECT * FROM global_defaults";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get global_defaults data by global_defaults ID.
	 */
	public function get_global_default($default_id) {
		$q = "SELECT * FROM global_defaults where default_id = ?";
		$result = $this->db->query($q, $default_id);
		return $result->result_array();
	}

	    /**
	     * Update global_defaults data a global_defaults ID.
	     */
	    public function update_global_defaults($default_id, $global_defaults_name, $global_defaults_val) {
	    	$this->db->trans_start();

	    	$this->db->where('default_id', $default_id);
	    	$this->db->update('global_defaults', array(
	    		'name' => $global_defaults_name, 
	    		'value' => $global_defaults_val,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a global_defaults record.
	     */
	    public function add_global_defaults($global_defaults_name, $global_defaults_val) {
	    	
	    	$result = $this->db->query("SELECT * FROM global_defaults where name = ?", $global_defaults_name);
	    	$result = $result->result_array();

	    	if(isset($result[0]['default_id'])) {
	    		return $result[0]['default_id'];
	    	} else {
	    		$data = array(
					'name' => $global_defaults_name,
					'value' => $global_defaults_val
				);
				$this->db->insert('global_defaults', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a global_defaults
	     */
	    public function delete_global_default($default_id) {
	    	$this->db->trans_start();
	    	$this->db->where('default_id', $default_id);
	    	$this->db->delete('global_defaults');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}