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
	    public function start_vm($ip, $path) {
	    	//$path = 'C:/labs/AL1/vm/viper24vm1.vmx';
	    	$path = str_replace('\\', '/', trim($path));
	    	$dropins_dir = '/cygdrive/c/labmgr-wd/dropins/start.gui-command';
	    	$command = 'vmrun -T ws start "'.$path.'"';
    	
	    	$file = './uploads/start'.uniqid().'.gui-command';
	    	file_put_contents($file, $command);
	    	/*
	    	echo "Sending start vm command to: ".$ip;
	    	echo "<br>Cert: " . FCPATH . 'certs/labmgr';
	    	echo "<br>Command: " . $command;
			*/
	    	$output = array(
	    		'status' => "Sending start vm command to: ".$ip,
	    		'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
	    		'cmd' => $command,
	    		'exit_status' => ''
    		);
    		unlink($file);
	    	return $output;
	    }

		/**
	     * Revert to snapshot for a VM
	     */
	    public function revert_vm($ip, $path, $snapshot) {
	    	$path = str_replace('\\', '/', $path);
	    	//$path = 'C:/labs/AL1/vm/viper24vm1.vmx';
	    	$path = str_replace('\\', '/', trim($path));
	    	$dropins_dir = '/cygdrive/c/labmgr-wd/dropins/revert.gui-command';
	    	$command = 'vmrun -T ws revertToSnapshot "'.$path. '" "'.$snapshot. '"';
	    	
	    	$file = './uploads/revert'.uniqid().'.gui-command';
	    	file_put_contents($file, $command);
	    	/*echo "Sending revert vm command to: ".$ip;

	    	echo "<br>Cert: " . FCPATH . 'certs/labmgr';
	    	echo "<br>Command: " . $command;
	    	return shell_exec('scp -i ./certs/labmgr '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/');
	    	*/
	    	$output = array(
	    		'status' => "Sending revert vm command to: ".$ip,
	    		'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
	    		'cmd' => $command,
	    		'exit_status' => ''
    		);
    		unlink($file);
	    	return $output;
	    }

	    /**
	     * Stop a VM
	     */
	    public function stop_vm($ip, $path) {
	    	$path = str_replace('\\', '/', $path);
	    	//$path = 'C:/labs/AL1/vm/viper24vm1.vmx';
	    	$path = str_replace('\\', '/', $path);
	    	$dropins_dir = '/cygdrive/c/labmgr-wd/dropins/stop.gui-command';
	    	$command = 'vmrun -T ws stop "'.$path. '" hard';
	    	
	    	$file = './uploads/stop'.uniqid().'.gui-command';
	    	file_put_contents($file, $command);
	    	/*
	    	echo "Sending stop vm command to: ".$ip;

	    	echo "<br>Cert: " . FCPATH . 'certs/labmgr';
	    	echo "<br>Command: " . $command;
	    	*/
	    	//return shell_exec('scp -i ./certs/labmgr '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/');

	    	$output = array(
	    		'status' => "Sending stop vm command to: ".$ip,
	    		'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
	    		'cmd' => $command,
	    		'exit_status' => ''
    		);
    		unlink($file);
	    	return $output;
	    }

	    /**
	     * Finds a VM
	     */
	    public function find_vm($ip, $path) {

	    	$output = array(
	    		'status' => "Finding VM on machine: ".$ip,
	    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "vmrun -T ws list"', $cmd_output, $exit_status),
	    		'cmd' => $cmd_output,
	    		'exit_status' => ''
    		);

	    	return $output;
	    }

	    /**
	     * Stop all running VMs on a machine.
	     */
	    public function stop_all_vms($ip) {
	    	$list_output = array(
	    		'status' => "Attempting to gather running VMs: ".$ip,
	    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "vmrun -T ws list"', $cmd_output, $exit_status),
	    		'cmd_output' => $cmd_output,
	    		'exit_status' => $exit_status
	    		);

	    	$command = '';
	    	$file = './uploads/stop'.uniqid().'.bat';
	    	unset($list_output['cmd_output'][0]);
	    	foreach($list_output['cmd_output'] as $list) {
	    		$command .= 'vmrun -T ws stop "'.$list. '" hard \r\n'.PHP_EOL;
	    		file_put_contents($file, $command, FILE_APPEND);
	    	}
	    	file_put_contents($file, 'ping 127.0.0.1 -n 5 > nul'.PHP_EOL, FILE_APPEND);
	    	file_put_contents($file, 'taskkill /f /im vmware.exe'.PHP_EOL, FILE_APPEND);

	    	

	    	$output = array(
	    		'status' => "Sending stop all VMs command to: ".$ip,
	    		'output' => shell_exec('scp -i ./certs/labmgr -o StrictHostKeyChecking=no -o ConnectTimeout=1 '.$file.' IBM_USER@' . $ip. ':/cygdrive/c/labmgr-wd/dropins/'),
	    		'cmd' => $command,
	    		'exit_status' => ''
    		);
    		unlink($file);
	    	return $output;
	    }

	public function validate_vmx($root, $ip) {
		$output = array(
	    		//'status' => "Attemping to find files in: " . $root . ' on ' .$ip,
	    		'status' => "Checking local vmx files under: " . $root . " on " .$ip. " against vmx files<br>listed in the labmgr DB (<font color='green'>green == matched</font>, <font color='red'>red == not matched</font>)<br><br>",
	    		'output' => '',
	    		'cmd_output' => '',
	    		'exit_status' => ''
    		);
		$list_output = array(
    		'status' => "Attempting to find files: ".$ip,
    		'output' => exec('ssh -i ./certs/labmgr -o "StrictHostKeyChecking no" -o "ConnectTimeout = 1" IBM_USER@' . $ip . ' "find '.$root.' -name *.vmx"', $cmd_output, $exit_status),
    		'cmd_output' => $cmd_output,
    		'exit_status' => $exit_status
	    );

	    $vms = $this->get_vms();

	    foreach($cmd_output as $find_result) {
	    	$find_result = str_replace('/', '\\', $find_result);
	    	$match=false;
	    	foreach($vms as $vm) {
	    		if(strcasecmp(trim($vm['path']), trim($find_result)) == 0) {
	    			$match = true;
	    		}
	    	}
	    	if($match) {
	    		$output['cmd_output'][] = "<font color='green'> Match: " .$find_result .'</font><br>';
	    	} else {
	    		$output['cmd_output'][] = "<font color='red'> No match: " . $find_result  . '</font><br>';
	    	}

	    }

	    /*
	    echo "<pre>";
	    print_r($list_output);
	    print_r($vms);
	    echo "</pre>";
	    die(); */ 

		return $output;
	}



}