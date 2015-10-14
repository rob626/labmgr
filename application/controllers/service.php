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
		$data['status'] = $this->machine_model->ping_test_arr($devices);
		echo json_encode($data);
	}

	public function reboot_machine() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->reboot($machine[0]['ip_address']));
	}

	public function shutdown_machine() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->shutdown($machine[0]['ip_address']));
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
			if($d['name'] == 'machine_ids[]') {
				array_push($machines, $this->machine_model->get_machine($d['value'])[0]);
			}
			if($d['name'] == 'stop_vm_by_machine') {
				$stop_vm = 1;
			}
		}

		if($stop_vm) {
			foreach($machines as $machine) {
					$output[] = $this->vm_model->stop_vm($machine['ip_address'], $vm['path']);
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

		foreach($data as $d) {
			if($d['name'] == 'start_vm_option') {
				$start_vm_option = $d['value'];
			}
			if($d['name'] == 'vm_id') {
				$vm = $this->vm_model->get_vm($d['value']);
				$vm = $vm[0];
			}
			if($d['name'] == 'room_ids[]') {
				$m = $this->machine_model->get_machines_by_room($d['value']);
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
			}
			if($d['name'] == 'stop_vm_by_machine') {
				$stop_vm = 1;
			}
		}
		$machines = $machines[0];

		if($stop_vm == 1) {
			foreach($machines as $machine) {
					$output[] = $this->vm_model->stop_vm($machine['ip_address'], $vm['path']);
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
	public function push_delete_torrents_classroom() {
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
			if($d['name'] == 'room_ids[]') {
				array_push($machines, $this->machine_model->get_machines_by_room($d['value']));
			}
			if($d['name'] == 'delete_option') {
				$delete_option = $d['value'];
			}
		}
		$machines = $machines[0];

		if($delete == 1) {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
					$retval = $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', "?action=".($delete_option ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
					if($retval) {
						$output['status'] = "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						$output['status'] = "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}

		} else {
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
					if($this->torrentAdd($torrent['path'], $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
						$output[]['status'] = "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						$output[]['status'] = "Failed to send to: " . $machine['ip_address'] . "<br>";
					}				
				}
			}

		}

		echo json_encode($output);
	}

	public function view_watchdog_log() {
		$machine_id = $this->input->get('machine_id');
		$machine = $this->machine_model->get_machine($machine_id);
		echo json_encode($this->machine_model->view_watchdog_log($machine[0]['ip_address']));
	}

}