<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all user data.
	 */
	public function get_users() {
		$q = "SELECT * FROM user";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get user data by user ID.
	 */
	public function get_user($user_id) {
		$q = "SELECT * FROM user where user_id = ?";
		$result = $this->db->query($q, $user_id);
		return $result->result_array();
	}

    /**
     * Update user data a user ID.
     */
    public function update_user($user_id, $username, $password, $role, $firstname, $lastname) {
    	$this->db->trans_start();
    	$password = hash('sha256', $password);

    	$this->db->where('user_id', $user_id);
    	$this->db->update('user', array(
    		'username' => $username, 
    		'password' => $password,
    		'role' => $role,
    		'first_name' => $firstname,
    		'last_name' => $lastname,
    		'last_update_timestamp' => date("Y-m-d H:i:s")
    		)
    	);

    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

    /**
     * Add a user record.
     */
    public function add_user($username, $password, $role, $firstname, $lastname) {
    	
    	$result = $this->db->query("SELECT * FROM user where username = ?", $username);
    	$result = $result->result_array();

    	if(isset($result[0]['user_id'])) {
    		return $result[0];
    	} else {
    		$data = array(
				'username' => $username, 
	    		'password' => hash('sha256', $password),
	    		'role' => $role,
	    		'first_name' => $firstname,
	    		'last_name' => $lastname,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
			);
			$this->db->insert('user', $data);

    	return $this->db->insert_id();
    	}
    }
    

    /**
     * Delete a user
     */
    public function delete_user($user_id) {
    	$this->db->trans_start();
    	$this->db->where('user_id', $user_id);
    	$this->db->delete('user');
    	$this->db->trans_complete();
    	
    	return $this->db->trans_status();
    }

}