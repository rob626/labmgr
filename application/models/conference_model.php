<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conference_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all conference data.
	 */
	public function get_conferences() {
		$q = "SELECT * FROM conference";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get conference data by conference ID.
	 */
	public function get_conference($conference_id) {
		$q = "SELECT * FROM conference where conference_id = ?";
		$result = $this->db->query($q, $conference_id);
		return $result->result_array();
	}

	    /**
	     * Update conference data a conference ID.
	     */
	    public function update_conference($conference_id, $conference_name, $conference_desc) {
	    	$this->db->trans_start();

	    	$this->db->where('conference_id', $conference_id);
	    	$this->db->update('conference', array(
	    		'name' => $conference_name, 
	    		'description' => $conference_desc,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a conference record.
	     */
	    public function add_conference($conference_name, $conference_desc) {
	    	
	    	$result = $this->db->query("SELECT * FROM conference");
	    	$result = $result->result_array();

	    	if(isset($result[0]['conference_id'])) {
	    		$result = $this->conference_model->update_conference($result[0]['conference_id'], $conference_name, $conference_desc);
	    		return $result[0]['conference_id'];
	    	} else {
	    		$data = array(
					'name' => $conference_name,
					'description' => $conference_desc
				);
				$this->db->insert('conference', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a conference
	     */
	    public function delete_conference($conference_id) {
	    	$this->db->trans_start();
	    	$this->db->where('conference_id', $conference_id);
	    	$this->db->delete('conference');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}