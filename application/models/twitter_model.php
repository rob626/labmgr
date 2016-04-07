<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Set Twitter reporting on or off.
	 */
	public function set_on_off($switch) {
		$this->db->trans_start();

    	$this->db->where('twitter_id', 1);
    	$this->db->update('server', array(
    		'twitter_enabled' => $switch
    		)
    	);

    	$this->db->trans_complete();
    	return $this->db->trans_status();
	}

	public function twitter_enabled() {
		$q = "SELECT twitter_enabled FROM twitter where twitter_id = 1";
		$result = $this->db->query($q);
		$result = $result->result_array();
		if($result[0]['twitter_enabled'] == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	public function get_twitter_status() {
		return $status;
	}

}