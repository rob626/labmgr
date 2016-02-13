<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all script data.
	 */
	public function get_scripts() {
		$q = "SELECT * FROM script";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get script data by script ID.
	 */
	public function get_script($script_id) {
		$q = "SELECT * FROM script where script_id = ?";
		$result = $this->db->query($q, $script_id);
		return $result->result_array();
	}

	    /**
	     * Update script data a script ID.
	     */
	    public function update_script($script_id, $script_name, $script_desc, $script_path, $script_parameter, $script_os) {
	    	$this->db->trans_start();

	    	$this->db->where('script_id', $script_id);
	    	$this->db->update('script', array(
	    		'name' => $script_name, 
	    		'description' => $script_desc,
	    		'path' => $script_path,
	    		'parameter' => $script_parameter,
	    		'os' => $script_os,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a script record.
	     */
	    public function add_script($script_name, $script_desc, $script_path, $script_parameter, $script_os) {
	    	
	    	$result = $this->db->query("SELECT * FROM script where name = ?", $script_name);
	    	$result = $result->result_array();

	    	if(isset($result[0]['script_id'])) {
	    		return $result[0]['script_id'];
	    	} else {
	    		$data = array(
					'name' => $script_name,
					'description' => $script_desc,
					'path' => $script_path,
		    		'parameter' => $script_parameter,
		    		'os' => $script_os
				);
				$this->db->insert('script', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a script
	     */
	    public function delete_script($script_id) {
	    	$this->db->trans_start();
	    	$this->db->where('script_id', $script_id);
	    	$this->db->delete('script');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	    public function get_uploaded_files() {
	    	$uploads = scandir(UPLOADS_DIR);
	        foreach($uploads as $key => $value) {
	            if($value == '.' || $value == '..') {
	                    unset($uploads[$key]);
	            }
	        }
	        return $uploads;
		    }

	}