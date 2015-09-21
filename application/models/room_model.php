<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all room data.
	 */
	public function get_rooms() {
		$q = "SELECT * FROM room";
		$result = $this->db->query($q);
		return $result->result_array();
	}

}