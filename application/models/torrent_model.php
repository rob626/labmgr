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
	 * Get the torrents that have been uploaded
	 * to the server machine so that we can add 
	 * them all at once.
	 */
	public function get_torrents_on_server() {
		$uploaded_torrents = scandir(UPLOADS_DIR);
		foreach($uploaded_torrents as $key => $value) {
            if($value == '.' || $value == '..') {
                    unset($uploaded_torrents[$key]);
            }
        }
        return $uploaded_torrents;
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
	 * Search for torrents with the same name.
	 */
	public function search_torrent_name($name) {
		$q = "SELECT * FROM torrent where name = ?";
		$result = $this->db->query($q, $name);
		return $result->result_array();
	}

	    /**
	     * Update torrent data a torrent ID.
	     */
	    public function update_torrent($torrent_id, $torrent_name, $hash, $torrent_path, $torrent_file = '', $torrent_version = 1) {
	    	$this->db->trans_start();

	    	$this->db->where('torrent_id', $torrent_id);
	    	$this->db->update('torrent', array(
	    		'name' => $torrent_name, 
	    		'hash' => $hash,
	    		'path' => $torrent_path,
	    		'torrent_file' => $torrent_file,
	    		'torrent_version' => $torrent_version,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a torrent record.
	     */
	    public function add_torrent($torrent_name, $hash, $torrent_path, $torrent_file, $torrent_version = 1) {
	    	
	    	// make sure that the torrent doesn't already exist in the DB.  
	    	// If the same torrent (based on the hash) has a new name, allow that
	    	$sql = "SELECT * FROM torrent where hash = ? AND name = ?";
			$result = $this->db->query($sql, array($hash, $torrent_name));
	    	$result = $result->result_array();

	    	if(isset($result[0]['torrent_id'])) {
	    		$this->logging->lwrite("NOT adding ".$torrent_name." (hash ".$hash.") as it appears to already exit");
	    		return $result[0]['torrent_id'];
	    	} else {
	    		$this->logging->lwrite("Adding ".$torrent_name." (hash ".$hash.")");
	    		$data = array(
					'name' => $torrent_name,
					'hash' => $hash,
					'path' => $torrent_path,
					'torrent_file' => $torrent_file,
					'torrent_version' => $torrent_version
				);
				$this->db->insert('torrent', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a torrent from the DB.  Also move the torrent file (or folder) to the
	     * archive folder.
	     */
	    public function delete_torrent($torrent_id) {
	    	// make sure the torrents/archive directory exists
			if (!is_dir(TORRENT_UPLOAD_DIR."archive")) {
				mkdir(TORRENT_UPLOAD_DIR."archive");
			}

			$t = $this->torrent_model->get_torrent($torrent_id);
			$this->logging->lwrite("Deleting torrent: ".$t[0]['name']);
			$troot = basename(TORRENT_UPLOAD_DIR);  // this should be 'torrents'
			$tpath = $t[0]['path'];
			
			if (($pos = strpos($tpath, $troot)) !== FALSE) { 
    			$tpath_after_root = substr($tpath, $pos + strlen($troot) + 1); // should be path after torrents folder
    			$tpath_after_root_dir = dirname($tpath_after_root);  // should be the unique folder name
			}

			if ($tpath_after_root_dir == ".") {
				// in case there is not unique folder name between 'torrents' and the torrent file
				$this->logging->lwrite("Archiving ".$t[0]['name'].": ".TORRENT_UPLOAD_DIR.$tpath_after_root." to ".TORRENT_UPLOAD_DIR."archive/".basename($tpath));
				rename(TORRENT_UPLOAD_DIR.$tpath_after_root, TORRENT_UPLOAD_DIR."archive/".basename($tpath));
			} else {
				// move the whole folder to the archive directory
				$this->logging->lwrite("Archiving ".$t[0]['name'].": ".TORRENT_UPLOAD_DIR.$tpath_after_root_dir."/ to ".TORRENT_UPLOAD_DIR."archive/".$tpath_after_root_dir."/");
				rename(TORRENT_UPLOAD_DIR.$tpath_after_root_dir, TORRENT_UPLOAD_DIR."archive/".$tpath_after_root_dir);
			}

			// remove the torrent entry from the db
	    	$this->db->trans_start();
	    	$this->db->where('torrent_id', $torrent_id);
	    	$this->db->delete('torrent');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}