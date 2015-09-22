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

	/**
	 * Get room data by room ID.
	 */
	public function get_room($room_id) {
		$q = "SELECT * FROM room where room_id = ?";
		$result = $this->db->query($q, $room_id);
		return $result->result_array();
	}

	    /**
	     * Update room data a Room ID.
	     */
	    public function update_room($room_id, $room_name, $room_desc) {
	    	$this->db->trans_start();

	    	$this->db->where('room_id', $room_id);
	    	$this->db->update('room', array(
	    		'name' => $room_name, 
	    		'description' => $room_desc,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a room record.
	     */
	    public function add_room($room_name, $room_desc) {
	    	
	    	$result = $this->db->query("SELECT * FROM room where name = ?", $room_name);
	    	$result = $result->result_array();

	    	if(isset($result[0]['room_id'])) {
	    		return $result[0]['room_id'];
	    	} else {
	    		$data = array(
					'name' => $room_name,
					'description' => $room_desc
				);
				$this->db->insert('room', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a room
	     */
	    public function delete_room($room_id) {
	    	$this->db->trans_start();
	    	$this->db->where('room_id', $room_id);
	    	$this->db->delete('room');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}