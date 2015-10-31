<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Torrent_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all torrent data.
	 */
	public function get_torrents() {
		$q = "SELECT * FROM torrent";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get torrent data by torrent ID.
	 */
	public function get_torrent($torrent_id) {
		$q = "SELECT * FROM torrent where torrent_id = ?";
		$result = $this->db->query($q, $torrent_id);
		return $result->result_array();
	}

	    /**
	     * Update torrent data a torrent ID.
	     */
	    public function update_torrent($torrent_id, $torrent_name, $hash, $torrent_path, $torrent_file) {
	    	$this->db->trans_start();

	    	$this->db->where('torrent_id', $torrent_id);
	    	$this->db->update('torrent', array(
	    		'name' => $torrent_name, 
	    		'hash' => $hash,
	    		'path' => $torrent_path,
	    		'torrent_file' => $torrent_file,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a torrent record.
	     */
	    public function add_torrent($torrent_name, $hash, $torrent_path, $torrent_file) {
	    	
	    	$result = $this->db->query("SELECT * FROM torrent where hash = ?", $hash);
	    	$result = $result->result_array();

	    	if(isset($result[0]['torrent_id'])) {
	    		return $result[0]['torrent_id'];
	    	} else {
	    		$data = array(
					'name' => $torrent_name,
					'hash' => $hash,
					'path' => $torrent_path,
					'torrent_file' => $torrent_file
				);
				$this->db->insert('torrent', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a torrent
	     */
	    public function delete_torrent($torrent_id) {
	    	$this->db->trans_start();
	    	$this->db->where('torrent_id', $torrent_id);
	    	$this->db->delete('torrent');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}