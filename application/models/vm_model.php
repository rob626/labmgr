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

	    /**
	     * Start a VM
	     */
	    public function start_vm($ip) {
	    	$path = 'C:/labs/AL1/vm/viper24vm1.vmx';
	    	$dropins_dir = '/cygdrive/c/labmgr-wd/dropins/start.gui-command';
	    	$command = 'vmrun -T ws start '.$path;
	    	/* $file_name = './start.gui-command';
	    	$file = fopen($file_name, "w");
	    	echo fwrite($file, $command);
	    	fclose($file);*/

	    	echo "Sending start vm command to: ".$ip;

	    	echo "<br>Cert: " . FCPATH . 'certs/labmgr';
	    	echo "<br>Command: " . $command;
	    	//return shell_exec('scp -i ./certs/labmgr '.$file_name.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/');
	    	//return shell_exec('./scripts/start_vm.sh');
	    	return shell_exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "echo '.$command.' > '.$dropins_dir.'"');
	    	//return shell_exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' touch file.txt');
	    }

	    /**
	     * Stop a VM
	     */
	    public function stop_vm($ip) {
	    	$path = 'C:/labs/AL1/vm/viper24vm1.vmx';
	    	$dropins_dir = '/cygdrive/c/labmgr-wd/dropins/stop.gui-command';
	    	$command = 'vmrun -T ws stop '.$path. ' hard';
	    	
	    	echo "Sending stop vm command to: ".$ip;

	    	echo "<br>Cert: " . FCPATH . 'certs/labmgr';
	    	echo "<br>Command: " . $command;
	    	//return shell_exec('./scripts/start_vm.sh');
	    	return shell_exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' "echo '.$command.' > '.$dropins_dir.'"');
	    	//return shell_exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" IBM_USER@' . $ip . ' touch file.txt');
	    }

	}