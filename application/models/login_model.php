<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function login($username, $password) {
    	if($this->validate($username, $password)) {
    		//$uid = $this->sync_login_user($username);
            
            //$this->session->set_userdata('uid', $uid);
            $this->session->set_userdata('username', $username);
            return TRUE;
    	} else {
    		return FALSE;
    	}
    }


    private function validate($username, $password) {
    	$password = hash('sha256', $password);

    	$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    	$result = $this->db->query($sql, array($username, $password));
    	$result = $result->result_array();
    	if(!empty($result[0]['user_id'])) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

}