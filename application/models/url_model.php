<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class url_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all url data.
	 */
	public function get_urls() {
		$q = "SELECT * FROM url";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get url data by url ID.
	 */
	public function get_url($url_id) {
		$q = "SELECT * FROM url where url_id = ?";
		$result = $this->db->query($q, $url_id);
		return $result->result_array();
	}

	    /**
	     * Update url data a url ID.
	     */
	    public function update_url($url_id, $url_name, $url_path) {
	    	$this->db->trans_start();

	    	$this->db->where('url_id', $url_id);
	    	$this->db->update('url', array(
	    		'name' => $url_name,
	    		'path' => $url_path,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a url record.
	     */
	    public function add_url($url_name, $url_path) {

	    	$result = $this->db->query("SELECT * FROM url where name = ?", $url_name);
	    	$result = $result->result_array();

	    	if(isset($result[0]['url_id'])) {
	    		return $result[0]['url_id'];
	    	} else {
	    		$data = array(
					'name' => $url_name,
					'path' => $url_path
				);
				$this->db->insert('url', $data);

	    	return $this->db->insert_id();
	    	}
	    }


	    /**
	     * Delete a url
	     */
	    public function delete_url($url_id) {
	    	$this->db->trans_start();
	    	$this->db->where('url_id', $url_id);
	    	$this->db->delete('url');
	    	$this->db->trans_complete();

	    	return $this->db->trans_status();
	    }

	    /**
	     * Start a browser with a url.
	     */
	    public function start_browser($ip, $url, $browser, $url_suffix) {

	    	$url = trim($url);

	    	if($browser == 'cleanbrowser') {
	    		$browser = "C:\\Users\\cleanbrowser\\cleanbrowser.bat";
	    	}
	    	if($browser == 'cleanonly') {
	    		$browser = "C:\\Users\\cleanbrowser\\cleanbrowser.bat -clean";
	    	}

	    	if(!empty($url_suffix)) {
	    		$command = $browser. ' "'.$url.$url_suffix.'"';
	    		$file = './uploads/'.$ip.uniqid().'.gui-command';
	    	} else {
	    		$command = $browser. ' "'.$url.'"';
	    		$file = './uploads/'.$ip.uniqid().'.gui-command';
	    	}
	    	
	    	file_put_contents($file, $command);

	    	$output = array(
	    		'status' => "Sending start browser command to: ".$ip." on browser ".$browser,
	    		'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
	    		'cmd' => $command,
	    		'exit_status' => ''
    		);

    		unlink($file);
	    	return $output;
	    }
	}
