<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	protected $token;
    protected $guid;
    private static $base = "http://%s:%s/gui/%s";

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('torrent_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
		$this->load->model('script_model');
		$this->load->model('vm_model');
	}

		private function paramImplode($glue, $param) {
        return $glue.implode($glue, is_array($param) ? $param : array($param));
    }

	private function makeRequest($host, $port, $user, $pass, $request, $decode = true, $options = array()) {
        $request = preg_replace('/^\?/', '?token='.$this->token . '&', $request);
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_setopt($ch, CURLOPT_URL, sprintf(self::$base, $host, $port, $request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
        curl_setopt($ch, CURLOPT_COOKIE, "GUID=".$this->guid);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $req = curl_exec($ch);
        curl_close($ch);
        return ($decode ? json_decode($req, true) : $req);
    }
	public function torrentAdd($filename, $host, $port, $user, $pass, &$estring = false) {
        
    $split = explode(":", $filename, 2);
    if (count($split) > 1 && (stristr("|http|https|file|magnet|", "|".$split[0]."|") !== false)) {
        //$this->makeRequest("?action=add-url&s=".urlencode($filename), false);
        $decode = true;
        //$request = preg_replace('/^\?/', '?token='.$this->token . '&', $request);
        $request = "?token=".$this->token ."&". "action=add-url&s=".urlencode($filename);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(self::$base, $host, $port, $request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
        curl_setopt($ch, CURLOPT_COOKIE, "GUID=".$this->guid);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $req = curl_exec($ch);
        curl_close($ch);
        return ($decode ? json_decode($req, true) : $req);
    }
    elseif (file_exists($filename)) {
        //$json = $this->makeRequest("?action=add-file", true, array(CURLOPT_POSTFIELDS => array("torrent_file" => new CurlFile(realpath($filename)))));
        //echo 'Sending file: ' . $filename . "<br>";
        $decode = true;
        $request = "?token=".$this->token ."&". "action=add-file";
        $ch = curl_init();
        $args['torrent_file'] = new CurlFile($filename);
        //curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_URL, sprintf(self::$base, $host, $port, $request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
        curl_setopt($ch, CURLOPT_COOKIE, "GUID=".$this->guid);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $req = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($req, true);
        if (isset($json['error'])) {
            //echo $json['error'];
            if ($estring !== false) $estring = $json['error'];
            return false;
        }
        return true;
    }
    else {
        echo "File doesn't exist.";
        if ($estring !== false) $estring = "File doesn't exist!";
        echo $estring;
        return false; 
    } 
}
	private function getToken($host, $port, $user, $pass) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf(self::$base, $host, $port, 'token.html'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $headers = substr($output, 0, $info['header_size']);
        if (preg_match("@Set-Cookie: GUID=([^;]+);@i", $headers, $matches)) {
            $this->guid = $matches[1];
        }
        if (preg_match('/<div id=\'token\'.+>(.*)<\/div>/', $output, $m)) {
            $this->token = $m[1];
            return true;
        }
        return false;
    }

	public function get_machines_by_room() {
		$room_id = $this->input->get('room_id');
		if($room_id == -1) {
			$machines = $this->machine_model->get_machines();
		} else {
			$machines = $this->machine_model->get_machines_by_room($room_id);
		}
		
		echo json_encode($machines);
	}

	public function get_machine_status() {
		$devices = $this->input->get('machines');
		$data['status'] = $this->machine_model->check_machine_status($devices);
		echo json_encode($data);
		//print_r($data);
	}

	public function get_ping_status() {
		$devices = $this->input->get('machines');
		$data['status'] = $this->machine_model->just_ping_test($devices);
		echo json_encode($data);
	}	

	public function reboot_machine() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->reboot($machine[0]['ip_address'], $machine[0]['os_id']));
	}

	public function shutdown_machine() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->shutdown($machine[0]['ip_address']));
	}

	public function mouse_move() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->mouse_move($machine[0]['ip_address']));
	}

	public function cleanup_watchdog() {
		$data = $this->input->get('data');
		$machines = array();

		// Get the list of machines from the input data
		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
		}

		// Call the function(s) for each machine and pass the ip address
		foreach($machines as $machine) {
			$this->logging->lwrite("cleanup dropins and hasbeenrun for ".$machine['ip_address']);			
			$output[] = $this->machine_model->cleanup_watchdog_dropins($machine['ip_address']);
			$output[] = $this->machine_model->cleanup_watchdog_hasbeenrun($machine['ip_address']);
		}
		
		echo json_encode($output);	
	}

	public function cleanup_watchdog_FULL() {
		$data = $this->input->get('data');
		$machines = array();

		// Get the list of machines from the input data
		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
		}

		// Call the function(s) for each machine and pass the ip address
		foreach($machines as $machine) {
			$this->logging->lwrite("cleanup log, dropins and hasbeenrun for ".$machine['ip_address']);
			$output[] = $this->machine_model->cleanup_watchdog_dropins($machine['ip_address']);
			$output[] = $this->machine_model->cleanup_watchdog_hasbeenrun($machine['ip_address']);
			$output[] = $this->machine_model->cleanup_watchdog_logfile($machine['ip_address']);
		}
		
		echo json_encode($output);	
	}
	public function get_torrent_status() {
		$machines = $this->input->get('machines');
		//$this->logging->lwrite("getting torrent status");
		//print_r($machines);
		$machines = $this->machine_model->just_ping_test($machines);
		//print_r($machines);

		foreach($machines as $key => $machine) {
			if($machine['status'] == 'ONLINE') {
				$m = $this->machine_model->get_machine_ip($machine['ip_address']);
				//print_r($m);
				//$this->logging->lwrite("looking at torrent data for ".$machine['ip_address']);
				$this->getToken($machine['ip_address'], '27555', $m['username'], $m['password']);
				$torrent_data = $this->makeRequest($machine['ip_address'], '27555', $m['username'], $m['password'], '?list=1');
				$machine['torrents'] = $torrent_data['torrents'];
				//print_r($machine['torrents']);
				$data['machines'][$key] = $machine;
			}
		}

		echo json_encode($data);
	}

	/**
	 * Get list of directories to delete.
	 */
	public function delete_dirs_list() {
		$data = $this->input->get('data');
		$machines = array();
		$unique_list = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
		}

		foreach($machines as $machine) {
			$output = $this->machine_model->lab_directories($machine['ip_address']);
			$unique_list = array_merge($unique_list, $output['cmd_output']);
		}
		$unique_list = array_unique($unique_list);
		sort($unique_list);

		echo json_encode($unique_list);
	}

	public function delete_dirs() {
		$data = $this->input->get('data');
		$machines = array();
		$dirs = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
			if($d['name'] == 'folder_ids[]') {
				$dirs[] = $d['value'];
			}
			if($d['name'] == 'dir' && !empty($d['value'])) {
				$dirs[] = $d['value'];
			}
		}

		foreach($machines as $machine) {
			foreach($dirs as $dir) {
				$output[] = $this->machine_model->delete_lab_dir($machine['ip_address'], $dir);
			}
		}

		echo json_encode($output);
	}


	/**
	 *
	 */
	public function start_stop_vms() {
		$data = $this->input->get('data');
		$start_vm_option = '';
		$vm_id = '';
		$vm = '';
		$machines = array();
		$stop_vm = 0;

		foreach($data as $d) {
			if($d['name'] == 'start_vm_option') {
				$start_vm_option = $d['value'];
			}
			if($d['name'] == 'vm_id') {
				$vm = $this->vm_model->get_vm($d['value']);
				$vm = $vm[0];
			}
			if($d['name'] == 'stop_all') {
				$stop_all = $d['value'];
			}
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
			if($d['name'] == 'stop_vm_by_machine') {
				$stop_vm = 1;
			}
			if($d['name'] == 'snapshot') {
				$vm['snapshot'] = $d['value'];
			}
		}

		if($stop_vm) {
			if($stop_all == 'stop_all') {
				foreach($machines as $machine) {
					$output[] = $this->vm_model->stop_all_vms($machine['ip_address'], $vm['path']);
				}
			} else {
				foreach($machines as $machine) {
						$output[] = $this->vm_model->stop_vm($machine['ip_address'], $vm['path']);
					}
			}

		} else {
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'revert_vm') {
				foreach($machines as $machine) {
					$output[] = $this->vm_model->revert_vm($machine['ip_address'], $vm['path'],$vm['snapshot']);
				}
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'start_vm') {
				foreach($machines as $machine) {
					$output[] = $this->vm_model->start_vm($machine['ip_address'], $vm['path']);			
				}
			}
		}

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function start_stop_vms_classroom() {
		$data = $this->input->get('data');
		$start_vm_option = '';
		$vm = '';
		$machines = array();
		$stop_vm = 0;
		$snapshot = NULL;

		//print_r($data);

		foreach($data as $d) {
			if($d['name'] == 'start_vm_option') {
				$start_vm_option = $d['value'];
			}
			if($d['name'] == 'vm_id') {
				$vm = $this->vm_model->get_vm($d['value']);
				$vm = $vm[0];
			}
			if($d['name'] == 'stop_all') {
				$stop_all = $d['value'];
			}
			if($d['name'] == 'room_ids[]') {
				$m = $this->machine_model->get_machines_by_room($d['value']);
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
			}
			if($d['name'] == 'stop_vm_by_machine') {
				$stop_vm = 1;
			}
			if($d['name'] == 'snapshot') {
				$vm['snapshot'] = $d['value'];
			}
		}
		//$machines = $machines[0];

		if($stop_vm == 1) {
			if(!empty($stop_all) && $stop_all == 'stop_all') {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->logging->lwrite("Attempting to stop all VMs on machine: ".print_r($m, true));
						$output[] = $this->vm_model->stop_all_vms($m['ip_address']);
					}
				}
			} else {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->logging->lwrite("Attempting to stop VM ".print_r($vm, true)." on machine: ".print_r($m, true));
						$output[] = $this->vm_model->stop_vm($m['ip_address'], $vm['path']);
					}
				}
			}
			

		} else {
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'revert_vm') {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$output[] = $this->vm_model->revert_vm($m['ip_address'], $vm['path'],$vm['snapshot']);
					}
				}
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'start_vm') {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$output[] = $this->vm_model->start_vm($m['ip_address'], $vm['path']);				
					}
				}
			}
		}

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function find_vms_classroom() {
		$this->logging->lwrite("find_vms_by_classroom (service)");

		$data = $this->input->get('data');
		$vm = '';
		$machines = array();

		//print_r($data);

		foreach($data as $d) {
			if($d['name'] == 'vm_id') {
				$vm = $this->vm_model->get_vm($d['value']);
				$vm = $vm[0];
			}
			if($d['name'] == 'room_ids[]') {
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
			}
		}

		foreach($machines as $machine) {
			foreach($machine as $m) {	
				$o = $this->vm_model->find_vm($m['ip_address'], $vm['path']);
				if (in_array($vm['path'], $o['cmd'])) {
					$this_room_name = $this->room_model->get_room($m['room_id'])[0]['name'];
					//print_r($this_room_name);
					$this->logging->lwrite("...Located VM ".$vm['path'].": Seat ".$m['seat']." (".$m['ip_address'].") in Room ".$this_room_name);
					$o['status'] = "VM running in Room ".$this_room_name." Seat ".$m['seat']." (".$m['ip_address'].")";
					$output[] = $o;	
				}		
			}
		}			

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function push_delete_torrents() {
		$data = $this->input->get('data');
		$start_vm_option = '';
		$torrents = array();
		$machines = array();
		$delete = 0;

		foreach($data as $d) {
			if($d['name'] == 'start_vm_option') {
				$start_vm_option = $d['value'];
			}
			if($d['name'] == 'torrent_ids[]') {
				array_push($torrents, $this->torrent_model->get_torrent($d['value'])[0]);

			}
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value']));
			}
			if($d['name'] == 'delete_option') {
				$delete_option = $d['value'];
				$delete = 1;
			}
		}

		if($delete_option == 'delete_torrent_data') {
				$delete_option = true;
			} else {
				$delete_option = false;
			}


		//$machines = $machines[0];
		if($delete == 1) {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->getToken($m['ip_address'], '27555', $m['username'], $m['password']);
						$retval = $this->makeRequest($m['ip_address'], '27555', $m['username'], $m['password'], "?action=".($delete_option ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
						if($retval) {
							$output[]['status'] = "Successfully sent to: " . $m['ip_address'] . "<br>";
						} else {
							$output[]['status'] = "Failed to send to: " . $m['ip_address'] . "<br>";
						}
					}
					
				}
			}

		} else {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->getToken($m['ip_address'], '27555', $m['username'], $m['password']);
						if($this->torrentAdd($torrent['path'], $m['ip_address'], '27555', $m['username'], $m['password'])) {
							$output[]['status'] = "Successfully sent to: " . $m['ip_address'] . "<br>";
						} else {
							$output[]['status'] = "Failed to send to: " . $m['ip_address'] . "<br>";
						}	
					}
								
				}
			}

		}

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function push_delete_torrents_classroom() {
		$data = $this->input->get('data');
		$start_vm_option = '';
		$torrents = array();
		$machines = array();
		$delete = 0;
		$output = array();

		foreach($data as $d) {
			if($d['name'] == 'start_vm_option') {
				$start_vm_option = $d['value'];
			}
			if($d['name'] == 'torrent_ids[]') {
				array_push($torrents, $this->torrent_model->get_torrent($d['value'])[0]);
			}
			if($d['name'] == 'room_ids[]') {
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
			}
			if($d['name'] == 'delete_option') {
				$delete_option = $d['value'];
				$delete = 1;
			}
		}

		//$machines = $machines[0];

		if($delete_option == 'delete_torrent_data') {
				$delete_option = true;
			} else {
				$delete_option = false;
			}

		if($delete == 1) {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->getToken($m['ip_address'], '27555', $m['username'], $m['password']);
						$retval = $this->makeRequest($m['ip_address'], '27555', $m['username'], $m['password'], "?action=".($delete_option ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
						if($retval) {
							$output[]['status'] = "Successfully sent to: " . $m['ip_address'] . "<br>";
						} else {
							$output[]['status'] = "Failed to send to: " . $m['ip_address'] . "<br>";
						}
					}
				}
			}

		} else {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					foreach($machine as $m) {
						$this->getToken($m['ip_address'], '27555', $m['username'], $m['password']);
						if($this->torrentAdd($torrent['path'], $m['ip_address'], '27555', $m['username'], $m['password'])) {
							$output[]['status'] = "Successfully sent to: " . $m['ip_address'] . "<br>";
						} else {
							$output[]['status'] = "Failed to send to: " . $m['ip_address'] . "<br>";
						}
					}
									
				}
			}

		}

		echo json_encode($output);
	}

	/**
	 * View the remote machine's watchdog log.
	 */
	public function view_watchdog_log() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->view_watchdog_log($machine[0]['ip_address']));
	}

	/**
	 * Launch SSH. This just basically returns the IP address
	 */
	public function ssh_machine() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($machine);
	}

	public function show_desktop() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'room_ids[]') {
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
				
			}
		}
		//$machines = $machines[0];

		foreach($machines as $machine) {
			foreach($machine as $m) {

				$output[] = $this->machine_model->show_desktop($m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * Run a single command.
	 */
	public function run_cmd() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'room_ids[]') {
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
				
			}
			if($d['name'] == 'cmd') {
				$cmd = $d['value'];
			}
		}
		//$machines = $machines[0];

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->machine_model->run_cmd($cmd, $m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * Validate IP/MAC address mapping
	 */
	public function validate_mac() {
		$data = $this->input->get('data');

		$machines = array();
		$from = '';
		$to = '';

		foreach($data as $d) {
			if($d['name'] == 'from_1') {
				$from .= $d['value'];
			}
			if($d['name'] == 'from_2') {
				$from .= '.'.$d['value'];
			}
			if($d['name'] == 'from_3') {
				$from .= '.'.$d['value'];
			}
			if($d['name'] == 'from_4') {
				$from .= '.'.$d['value'];
			}
			if($d['name'] == 'to_1') {
				$to .= $d['value'];
			}
			if($d['name'] == 'to_2') {
				$to .= '.'.$d['value'];
			}
			if($d['name'] == 'to_3') {
				$to .= '.'.$d['value'];
			}
			if($d['name'] == 'to_4') {
				$to .= '.'.$d['value'];
			}
		}
		
		$this->logging->lwrite("Validating MAC addresses for ".$from." to ".$to);

		$from_long = ip2long($from);
		$to_long = ip2long($to);

		// Going to fping 50 machines at a time.  The arp table seems to hold
		// a finite number of entries, so we don't want to overflow.

		// Start at the initial from address and add the chunk.  Keep doing that
		// until we reach the to address.
		$current = $from_long;
		$chunk_size = 20;

		while($current < $to_long) {
			$max = $current + $chunk_size;
			if($max > $to_long+1) {
				$max = $to_long+1;
			}

			// fping the next chunck, get a list of only online systems
			$reachable = shell_exec("fping -r 0 -t500 -a -g ".long2ip($current)." " . long2ip($max));
			
			// validate each online ip address in that chunck range
			$this->logging->lwrite("- reachable systems (".long2ip($current)."-".long2ip($max)."): ".$reachable);
			for($i = $current; $i <= $max; $i++) {
				if (strpos($reachable, long2ip($i)) !== false) {
					$this->logging->lwrite("- checking online system: ".long2ip($i));
					$output[] = $this->admin_model->validate_mac(long2ip($i));
				}
			}

			$current += $chunk_size;
		}
		
		$output = array_filter($output);

		echo json_encode($output);
	}

	public function update_ips() {
		$data = $this->input->get('data');
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				$update_info = explode('_', $d['value']);

				$machine = $this->machine_model->get_machine($update_info[0]);
				$machine[0]['new_ip'] = $update_info[1];
				array_push($machines, $machine);
			}
		}

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->admin_model->update_validated_ip($m['machine_id'], $m['new_ip']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * Validate vmx files
	 */
	public function validate_vmx() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value']));
			}
			if($d['name'] == 'root') {
				$root = $d['value'];
			}
		}

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->vm_model->validate_vmx($root, $m['ip_address']);
			}
		}

		echo json_encode($output);
	}


	/*	
	 * Run a single command.
	 */
	public function run_cmd_machine() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value']));
			}		

			if($d['name'] == 'cmd') {
				$cmd = $d['value'];
			}
		}
		//$machines = $machines[0];

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->machine_model->run_cmd($cmd, $m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * Copy files from the server to remote machines.
	 */
	public function copy_file() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value']));
			}
			if($d['name'] == 'remote_path') {
				$remote_path = $d['value'];
			}
			if($d['name'] == 'local_file') {
				$file = UPLOADS_DIR . $d['value'];
			}
		}
		//$machines = $machines[0];

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->machine_model->send_file($file, $remote_path, $m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * Copy files from remote machines to uploads dir
	 */
	public function copy_file_from() {
		$data = $this->input->get('data');
		
		$machines = array();

		foreach($data as $d) {
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value']));
			}
			if($d['name'] == 'remote_path') {
				$remote_path = $d['value'];
			}
		}
		//$machines = $machines[0];

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$output[] = $this->machine_model->get_remote_file($remote_path, $m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function stop_all_classroom() {
		$room_id = $this->input->get('room_id');
		$machines = array();
		array_push($machines, $this->machine_model->get_machines_by_room($room_id));

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$this->logging->lwrite("Attempting to stop all VMs on machine: ".$m['ip_address']);
				$output[] = $this->vm_model->stop_all_vms($m['ip_address']);
			}
		} 

		echo json_encode($output);
	}

	/**
	 *
	 */
	public function reboot_classroom() {
		$room_id = $this->input->get('room_id');
		$machines = array();
		array_push($machines, $this->machine_model->get_machines_by_room($room_id));

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$this->logging->lwrite("Attempting to reboot machine: ".$m['ip_address']);
				$output[] = $this->machine_model->reboot($m['ip_address'], $m['os_id']);
			}
		}

		echo json_encode($output);
	}

	/**
	 * 
	 */
	public function mouse_move_classroom() {
		$room_id = $this->input->get('room_id');
		$machines= array();
		array_push($machines, $this->machine_model->get_machines_by_room($room_id));

		foreach($machines as $machine) {
			foreach($machine as $m) {
				$this->logging->lwrite("Moving mouse for: ".$m['ip_address']);
				$output[] = $this->machine_model->mouse_move($m['ip_address']);
			}
		}

		echo json_encode($output);
	}

	public function truncate_db() {

		$output = array(
            'status' => "Running script...",
            'output' => exec('./database/truncate_db.sh', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        echo json_encode($output);
	}

	public function truncate_conference_db() {

		$output = array(
            'status' => "Running script...",
            'output' => exec('./database/truncate_db_conference.sh', $cmd_output, $exit_status),
            'cmd_output' => $cmd_output,
            'exit_status' => $exit_status
        );

        echo json_encode($output);
	}

	public function export_db() {
		$output = $this->admin_model->export_db();

		echo json_encode($output);
	}

}