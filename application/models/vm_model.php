<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vm_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get all vm data.
	 */
	public function get_vms() {
		$q = "SELECT * FROM vm";
		$result = $this->db->query($q);
		return $result->result_array();
	}

	/**
	 * Get vm data by vm ID.
	 */
	public function get_vm($vm_id) {
		$q = "SELECT * FROM vm where vm_id = ?";
		$result = $this->db->query($q, $vm_id);
		return $result->result_array();
	}

	    /**
	     * Update vm data a vm ID.
	     */
	    public function update_vm($vm_id, $vm_name, $vm_path, $vm_hypervisor, $vm_snapshot) {
	    	$this->db->trans_start();

	    	$this->db->where('vm_id', $vm_id);
	    	$this->db->update('vm', array(
	    		'name' => $vm_name, 
	    		'path' => $vm_path,
	    		'hypervisor' => $vm_hypervisor,
	    		'snapshot' => $vm_snapshot,
	    		'last_update_timestamp' => date("Y-m-d H:i:s")
	    		)
	    	);

	    	$this->db->trans_complete();
	    	return $this->db->trans_status();
	    }

	    /**
	     * Add a vm record.
	     */
	    public function add_vm($vm_name, $vm_path, $vm_hypervisor, $vm_snapshot) {
	    	
	    	$result = $this->db->query("SELECT * FROM vm where name = ?", $vm_name);
	    	$result = $result->result_array();

	    	if(isset($result[0]['vm_id'])) {
	    		return $result[0]['vm_id'];
	    	} else {
	    		$data = array(
					'name' => $vm_name,
					'path' => $vm_path,
		    		'hypervisor' => $vm_hypervisor,
		    		'snapshot' => $vm_snapshot,
				);
				$this->db->insert('vm', $data);

	    	return $this->db->insert_id();
	    	}
	    }
	    

	    /**
	     * Delete a vm
	     */
	    public function delete_vm($vm_id) {
	    	$this->db->trans_start();
	    	$this->db->where('vm_id', $vm_id);
	    	$this->db->delete('vm');
	    	$this->db->trans_complete();
	    	
	    	return $this->db->trans_status();
	    }

	}