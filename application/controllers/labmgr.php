<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labmgr extends MY_Controller {

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
		$this->load->model('global_defaults_model');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/labmgr
	 *	- or -  
	 * 		http://example.com/index.php/labmgr/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/labmgr/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 $this->load->template('home');

	}

	public function get_utorrents() {
		/* $params = array(
			'host' => '192.168.15.190',
			'port' => $this->global_defaults_model->get_global('torrent_port')['value'],
			'user' => 'admin',
			'pass' => 'web1sphere'
			);
		$this->load->library('utorrent', $params); */
		$machine['ip_address'] = '172.20.128.72';
		echo "Running utorrent lib... <br>";
		echo "<pre>";
		$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
		print_r($this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', '?list=1'));

		//print_r($this->utorrent->torrentRemove('BADBC42E639D870A24E70A7AAFA5389DDDDA0079'));
		echo "</pre>";
	}

	public function decode_test() {
		$filename = '/home/robert/Desktop/Ubuntu_64-bit.5.torrent';
		$this->load->library('bencoded');
		$this->bencoded->FromFile($filename);
		$hash = $this->bencoded->InfoHash();
		echo "Hash: " . $hash;
		echo "<pre>";
		echo "</pre>";
	}


	public function test() {

		print_r($this->machine_model->ping_test('1.2.3.4'));
		
		die();
		/*
		print_r($this->machine_model->get_next_seat());
		die();

		$this->getToken('192.168.15.103', $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
				$torrent_data = $this->makeRequest('192.168.15.103', $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', '?list=1');


		echo "<pre>";
		print_r($torrent_data);
		echo "</pre>";
		die();
		
		for($i=0; $i<10; $i++) {
			$device['device_ip'] = '172.20.124.173';
			$device['status'] = 'Some Status';
			$message = $device['device_ip'].": ". $device['status'] . " " . date("Y-m-d H:i:s");
			//'7064640911@txt.att.net',
			$num = array('4124892645@vtext.com');
			$this->load->library('email');
			$conf = array(
				'protocol' => 'smtp',
				'smtp_host' => '9.17.195.168',
				'mailtype' => 'html',
				'charset' => 'utf-8' 
				);

			$this->email->initialize($conf);
			$this->email->from('rabush@us.ibm.com', 'ICT Management Console');
			$this->email->to($num); 
			//$this->email->subject('Email Text Test 2');
			$this->email->message($message);	

			$this->email->send();
		}
		echo $this->email->print_debugger();
		die(); */
		//echo FCPATH;
		//echo $this->machine_model->ping_test('192.168.1.179');
		echo "<pre>";
		$this->machine_model->reboot('172.20.128.64');
		echo "</pre>";
		die();
		define('0', 'UTORRENT_TORRENT_HASH');
		$output = array(
			0 => 'BADBC42E639D870A24E70A7AAFA5389DDDDA0079',
			1 => '201'
			);

		$types = array(
			'0' => 'UTORRENT_TORRENT_HASH',
			'1' => 'UTORRENT_TORRENT_STATUS'
			);
		$combined = array();
		foreach($output as $key => $value) {
			foreach($types as $type_key => $type_value) {
				if($key == $type_key) {
					//echo $type_value .' => '. $value . '<br>';
					$combined[$type_value] = $value;
				}
			}
		}
		print_r($combined);
	}


	public function remove_all_torrents() {
		$machines = $this->machine_model->get_machines();
		$hash = '3798819A90FE09CA7B0F515A76E3CFDF7EB0D9CA';
		$data = true;
		foreach($machines as $machine) {
			$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
			 $this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $hash), false);
		}
	}

	public function send_torrents_to_machines() {
		$machines = $this->machine_model->get_machines();
		$filename = '/home/robert/Desktop/Ubuntu_64-bit.5.torrent';

		
		foreach($machines as $machine) {

			$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');

			if($this->torrentAdd($filename, $machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere')) {
				echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
			} else {
				echo "Failed to send to: " . $machine['ip_address'] . "<br>";
			}
		}
		

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
        echo 'Sending file: ' . $filename . "<br>";
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
            echo $json['error'];
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

    public function machine_status() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			

		} else {
			$room_id = $this->input->get('room');

			if (empty($room_id) || $room_id == -1){
				$data['machines'] = $this->machine_model->get_machines();
			} else {
				$data['machines'] = $this->machine_model->get_machines_by_room($room_id);
			}

	    	
			/*foreach($data['machines'] as $key => $machine) {
				$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
				$torrent_data = $this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', '?list=1');
				$machine['torrents'] = $torrent_data['torrents'];
				$data['machines'][$key] = $machine;
			}  */

			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('machine_status', $data);
		}
    }

    public function start_vms_by_machine() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/*echo "<pre>";
			print_r($_POST);
			die(); */

			$start_vm_option = $this->input->post('start_vm_option');
			$vm = $this->vm_model->get_vm($this->input->post('vm_id'));
			$vm = $vm[0];
			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'revert_vm') {
				foreach($machines as $machine) {
					$this->vm_model->revert_vm($machine['ip_address'], $vm['path'],$vm['snapshot']);
				}
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'start_vm') {
				foreach($machines as $machine) {
					echo $this->vm_model->start_vm($machine['ip_address'], $vm['path']);			
				}
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('start_vms_by_machine', $data);
		}
    }

    public function stop_vms_by_machine() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			/*echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			die(); */
			$vm = $this->vm_model->get_vm($this->input->post('vm_id'));
			$vm = $vm[0];
			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
			}
			
			foreach($machines as $machine) {
				echo $this->vm_model->stop_vm($machine['ip_address'], $vm['path']);			
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('stop_vms_by_machine', $data);
		}
    }

    public function push_torrents_by_machine() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			$torrent_ids = $this->input->post('torrent_ids');
			$torrents = array();
			foreach($torrent_ids as $torrent_id) {
				$t = $this->torrent_model->get_torrent($torrent_id);
				array_push($torrents, $t[0]);
			}
			
			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
			}
			
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');

					if($this->torrentAdd($torrent['path'], $machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere')) {
						echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						echo "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['torrents'] = $this->torrent_model->get_torrents();
			$this->load->template('push_torrents_by_machine', $data);
		}
    }

    public function delete_torrents_by_machine() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);

			if($this->input->post('delete_option') == 'delete_torrent_data') {
				$data = true;
			} else {
				$data = false;
			}
			$torrent_ids = $this->input->post('torrent_ids');
			$torrents = array();
			foreach($torrent_ids as $torrent_id) {
				$t = $this->torrent_model->get_torrent($torrent_id);
				array_push($torrents, $t[0]);
			}
			

			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
			}
			
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');

					$retval = $this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
					if($retval) {
						echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						echo "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['torrents'] = $this->torrent_model->get_torrents();
			$this->load->template('delete_torrents_by_machine', $data);
		}
    }

    public function delete_torrents_by_classroom() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			//die();
			if($this->input->post('delete_option') == 'delete_torrent_data') {
				$data = true;
			} else {
				$data = false;
			}

			$torrent_ids = $this->input->post('torrent_ids');
			$torrents = array();
			foreach($torrent_ids as $torrent_id) {
				$t = $this->torrent_model->get_torrent($torrent_id);
				array_push($torrents, $t[0]);
			}
			
			/*
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			*/
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
					$retval = $this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
					if($retval) {
						echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						echo "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}
			foreach($machines as $machine) {
				$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');
				$retval = $this->makeRequest($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
				if($retval) {
					echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
				} else {
					echo "Failed to send to: " . $machine['ip_address'] . "<br>";
				}
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			//$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['torrents'] = $this->torrent_model->get_torrents();
			$this->load->template('delete_torrents_by_classroom', $data);
		}
    }

    public function start_vms_by_classroom() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			
			$start_vm_option = $this->input->post('start_vm_option');
			$vm = $this->vm_model->get_vm($this->input->post('vm_id'));
			$vm = $vm[0];
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'revert_vm') {
				foreach($machines as $machine) {
					$this->vm_model->revert_vm($machine['ip_address'], $vm['path'],$vm['snapshot']);
				}
			}
			
			if($start_vm_option == 'revert_start_vm' || $start_vm_option == 'start_vm') {
				foreach($machines as $machine) {
					echo $this->vm_model->start_vm($machine['ip_address'], $vm['path']);			
				}
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['rooms'] = $this->room_model->get_rooms();
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('start_vms_by_class', $data);
		}
    }

    public function stop_vms_by_classroom() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			
			$vm = $this->vm_model->get_vm($this->input->post('vm_id'));
			$vm = $vm[0];
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			
			foreach($machines as $machine) {
				$this->vm_model->stop_vm($machine['ip_address'], $vm['path']);
			}
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			$data['rooms'] = $this->room_model->get_rooms();
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('stop_vms_by_class', $data);
		}
    }

    public function find_vms_by_classroom() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// not going to get here since the post it taken by the js
			$this->logging->lwrite("find_vms_by_classroom (controller - POST)");
			$vm = $this->vm_model->get_vm($this->input->post('vm_id'));
			$vm = $vm[0];
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}

			foreach($machines as $machine) {
				if ($this->vm_model->find_vm($machine['ip_address'], $vm['path']) == 1) {
					$this_room_name = $this->room_model->get_room($machine['room_id'])[0]['name'];
					$this->logging->lwrite("...Located VM: Seat ".$machine['seat']." (".$machine['ip_address'].") in Room ".$this_room_name."<br>");
				}
			}
			
			echo "<pre>";
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";

		} else {
			$this->logging->lwrite("find_vms_by_classroom (controller)");
			$data['rooms'] = $this->room_model->get_rooms();
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('find_vms_by_class', $data);
		}
    }

	public function push_torrents_by_classroom() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			$torrent_ids = $this->input->post('torrent_ids');
			$torrents = array();
			foreach($torrent_ids as $torrent_id) {
				$t = $this->torrent_model->get_torrent($torrent_id);
				array_push($torrents, $t[0]);
			}
			/*
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			*/
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}

			foreach($torrents as $torrent) {
				foreach($machines as $machine) {
					$this->getToken($machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere');

					if($this->torrentAdd($torrent['path'], $machine['ip_address'], $this->global_defaults_model->get_global('torrent_port')['value'], 'admin', 'web1sphere')) {
						echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						echo "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}
			
			/*
			print_r($torrent);
			echo "<br>Machines: <br>";
			print_r($machines);
			echo "</pre>";*/

		} else {
			//$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['torrents'] = $this->torrent_model->get_torrents();
			$this->load->template('push_torrents', $data);
		}
	
	}

	public function copy_file_by_machine() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$data['files'] = $this->script_model->get_uploaded_files();
			$this->load->template('copy_file_by_machine', $data);
		}
	}

	public function copy_file_from_by_machine() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('copy_file_from_by_machine', $data);
		}
	}

	public function bg_info_update() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$cmd = $this->input->post('cmd');
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			foreach($machines as $machine) {
				echo "<pre>";
				print_r($this->machine_model->run_cmd($cmd, $machine['ip_address']));
				echo "</pre>";
			}
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('bg_info_update', $data);
		}
	}

	public function bg_info_config() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {

			$room_id = $this->input->post('room_id');
			$room_label = $this->input->post('Room-label');

			$machines = $this->machine_model->get_machines_by_room($room_id);

			foreach($machines as $machine) {
				if(empty($room_label)) {
					$content = $machine['name'] . ' - Seat ' . $machine['seat']; 
				} else {
					$content = $room_label . ' - Seat ' . $machine['seat'];
				}
					
				$this->machine_model->bg_info_config($machine['ip_address'], $content);
			}
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('bg_info_config', $data);
		}
	}

	public function show_desktop() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$cmd = $this->input->post('cmd');
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			foreach($machines as $machine) {
				echo "<pre>";
				print_r($this->machine_model->run_cmd($cmd, $machine['ip_address']));
				echo "</pre>";
			}
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('show_desktop', $data);
		}
	}

	public function run_single_cmd_class() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$cmd = $this->input->post('cmd');
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			foreach($machines as $machine) {
				echo "<pre>";
				print_r($this->machine_model->run_cmd($cmd, $machine['ip_address']));
				echo "</pre>";
			}
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('run_single_cmd_class', $data);
		}
	}

	public function run_single_cmd_machine() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			//handled in service.
			
		} else {
			$data['machines'] = $this->machine_model->get_machines();
			$data['rooms'] = $this->room_model->get_rooms();
			$this->load->template('run_single_cmd_machine', $data);
		}
	}


	/**
	 * Add a torrent.
	 */
	public function upload_torrent($status = null) {
			$torrents = $this->torrent_model->get_torrents();
			$data['torrents'] = $torrents;
			$data['uploaded_torrents'] = $this->torrent_model->get_torrents_on_server();
			$data['status'] = $status;
			$this->load->template('upload_torrent', $data);
	}

	/**
	 * Manage torrents.
	 */
	public function manage_torrents($status = null) {
			$torrents = $this->torrent_model->get_torrents();
			$data['torrents'] = $torrents;
			$data['uploaded_torrents'] = $this->torrent_model->get_torrents_on_server();
			$data['status'] = $status;
			$this->load->template('manage_torrents', $data);
	}

	/**
	 * Edit a vm
	 */
	public function edit_vm() {
		$vm_id = $this->input->post("vm_id");
		$data['vms'] = $this->vm_model->get_vm($vm_id);
		$this->load->template('edit_vm', $data);
	}

	public function save_vm_edits() {
		$retval = $this->vm_model->update_vm(
			$this->input->post('vm_id'), 
			$this->input->post('vm_name'),
			$this->input->post('vm_path'), 
			$this->input->post('vm_hypervisor'),
			$this->input->post('vm_snapshot')
			);
		if($retval) {
			redirect('/labmgr/add_vm');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Edit a torrent
	 */
	public function edit_torrent() {
		$torrent_id = $this->input->post("torrent_id");
		$data['torrents'] = $this->torrent_model->get_torrent($torrent_id);
		$this->load->template('edit_torrent', $data);
	}

	public function save_torrent_edits() {
		//print_r ($_POST);
		//die();
		$retval = $this->torrent_model->update_torrent(
			$this->input->post('torrent_id'), 
			$this->input->post('torrent_name'), 
			$this->input->post('torrent_hash'),
			$this->input->post('torrent_path'),
			$this->input->post('torrent_file'),
			$this->input->post('torrent_version')
			);
		if($retval) {
			redirect('/labmgr/manage_torrents');
		} else {
			echo "DB Error";
		}
	}
	
	/**
	 * Remove a torrent from the torrent table.
	 */
	public function delete_torrent() {
		$retval = $this->torrent_model->delete_torrent(
			$this->input->post('torrent_id')
			);
		if($retval) {
			$this->manage_torrents();
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add a script.
	 * a,b,c;
	 */
	public function add_vm() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if(!empty($this->input->post('multiple'))) {
				$multiples = $this->input->post('multiple');
				$multiple_arr = explode(';', $multiples);
				foreach($multiple_arr as $line) {
					$line_arr = explode(',', $line);
					if(!empty($line_arr[0])) {
						$name = trim($line_arr[0]);
						$path = trim($line_arr[1]);
						$snapshot = 'startlab';

						if(!empty($line_arr[2])) {
							$snapshots = $line_arr[2];
							$snapshots_array = explode('///', $snapshots);
							$snapshot = trim(array_pop($snapshots_array));
						}


						$retval = $this->vm_model->add_vm(
							$name,
							$path,
							'',
							$snapshot
							); 
					}

				}

				
						

			} else {
				$retval = $this->vm_model->add_vm(
					$this->input->post('name'), 
					$this->input->post('path'),
					$this->input->post('hypervisor'),
					$this->input->post('snapshot')
					);
			}

			if($retval) {
				redirect('/labmgr/add_vm');
			} else {
				echo "DB Error";
			}

		} else {
			$data['vms'] = $this->vm_model->get_vms();
			$this->load->template('add_vm', $data);
		}
	}

	/**
	 * Delete a VM.
	 */
	public function delete_vm() {
		$retval = $this->vm_model->delete_vm(
			$this->input->post('vm_id')
			);
		if($retval) {
			redirect('/labmgr/add_vm');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add a script.
	 */
	public function add_script() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->script_model->add_script(
				$this->input->post('script_name'), 
				$this->input->post('script_desc'),
				$this->input->post('script_path'),
				$this->input->post('script_parameter'),
				$this->input->post('script_os')
				);
			if($retval) {
				redirect('/labmgr/add_script');
			} else {
				echo "DB Error";
			}

		} else {
			$data['scripts'] = $this->script_model->get_scripts();
			$this->load->template('add_script', $data);
		}
	}

	/**
	 * Edit a script
	 */
	public function edit_script() {
		$script_id = $this->input->post("script_id");
		$data['scripts'] = $this->script_model->get_script($script_id);
		$this->load->template('edit_script', $data);
	}

	public function save_script_edits() {
		$retval = $this->script_model->update_script(
			$this->input->post('script_id'), 
			$this->input->post('script_name'), 
			$this->input->post('script_desc'),
			$this->input->post('script_path'),
			$this->input->post('script_parameter'),
			$this->input->post('script_os')
			);
		if($retval) {
			redirect('/labmgr/add_script');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Delete a script.
	 */
	public function delete_script() {
		$retval = $this->script_model->delete_script(
			$this->input->post('script_id')
			);
		if($retval) {
			redirect('/labmgr/add_script');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add a room.
	 */
	public function add_room() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->room_model->add_room(
				$this->input->post('room_name'), 
				$this->input->post('room_desc')
				);
			if($retval) {
				redirect('/labmgr/add_room');
			} else {
				echo "DB Error";
			}

		} else {
			$rooms = $this->room_model->get_rooms();
			sort($rooms);
			$data['rooms'] = $rooms;
			$this->load->template('add_room', $data);
		}
	}

	/**
	 * Stop all VMs on the machines in a room or reboot all machines in a room.
	 */
	public function room_stop_reboot() {
		
		$rooms = $this->room_model->get_rooms();
		sort($rooms);
		$data['rooms'] = $rooms;
		$this->load->template('room_stop_reboot', $data);
	}
	
	/**
	 * Edit a room
	 */
	public function edit_room() {
		$room_id = $this->input->post("room_id");
		$data['rooms'] = $this->room_model->get_room($room_id);
		$this->load->template('edit_room', $data);
	}

	/**
	 * Edit a machine
	 */
	public function edit_machine() {
		$machine_id = $this->input->post("machine_id");
		//$data['torrent_client'] = $this->admin_model->get_torrent_clients();
		$data['rooms'] = $this->room_model->get_rooms();
		$data['operating_systems'] = $this->admin_model->get_operating_systems();
		$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
		$data['machines'] = $this->machine_model->get_machine($machine_id);
		$this->load->template('edit_machine', $data);
	}

	/**
	 * Save changes made to a room.
	 */
	public function save_room_edits() {
		$retval = $this->room_model->update_room(
			$this->input->post('room_id'), 
			$this->input->post('room_name'), 
			$this->input->post('room_desc')
			);
		if($retval) {
			redirect('/labmgr/add_room');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Save changes made to a machine.
	 */
	public function save_machine_edits() {

		$retval = $this->machine_model->update_machine(
			$this->input->post('machine_id'),
			$this->input->post('room_id'),
			$this->input->post('seat'),
			$this->input->post('mac_address'),
			$this->input->post('ip_address'),
			$this->input->post('os_id'),
			$this->input->post('username'),
			$this->input->post('password'),
			$this->input->post('torrent_client_id'),
			$this->input->post('transport_type') 
			);
		if($retval) {
			redirect('/labmgr/manage_machines');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Delete a room.
	 */
	public function delete_room() {
		$retval = $this->room_model->delete_room(
			$this->input->post('room_id')
			);
		if($retval) {
			redirect('/labmgr/add_room');
		} else {
			echo "DB Error";
		}
	}

	public function register_machine() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->machine_model->add_machine(
				$this->input->post('room_id'),
				$this->input->post('seat'),
				$this->input->post('mac_address'),
				$this->input->post('ip_address'),
				$this->input->post('os_id'),
				$this->input->post('username'),
				$this->input->post('password'),
				$this->input->post('torrent_client_id'),
				$this->input->post('transport_type') 
				);

			if($retval) {
				$room_name=$this->room_model->get_room($this->input->post('room_id'));
				$this->session->set_flashdata('status', 'machine-id: '.$retval.' room: '.$room_name[0]['name'].' / seat: '.$this->input->post('seat'));
				redirect('/labmgr/register_machine');
			} else {
				echo "DB Error";
			}

		} else {
			$room_id = $this->input->get('room');

			if (empty($room_id) || $room_id == -1){
				$data['next_seat'] = '?';
			} else {
				$data['next_seat'] = $this->machine_model->get_next_seat($room_id);
			}

			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			$operating_systems = $this->admin_model->get_operating_systems();
			$ip_guess = $_SERVER['REMOTE_ADDR'];

			sort($machines);
			
			$data['mac_guess'] = $this->machine_model->get_mac($ip_guess);
			$data['current_room'] = $room_id;
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
			$data['operating_systems'] = $operating_systems;
			$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
			$data['torrent_username'] = $this->global_defaults_model->get_global('torrent_username');
			$data['torrent_password'] = $this->global_defaults_model->get_global('torrent_password');
			$this->load->template('register_machine', $data);
		}
	}

	/**
	 * Add a machine.
	 */
	public function add_machine() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->machine_model->add_machine(
				$this->input->post('room_id'),
				$this->input->post('seat'),
				$this->input->post('mac_address'),
				$this->input->post('ip_address'),
				$this->input->post('operating_system'),
				$this->input->post('username'),
				$this->input->post('password'),
				$this->input->post('torrent_client_id'),
				$this->input->post('transport_type') 
				);

			if($retval) {
				redirect('/labmgr/register_machine');
			} else {
				echo "DB Error";
			}

		} else {
			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			sort($machines);
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
			$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
			$this->load->template('add_machine', $data);
		}
	}

	public function manage_machines() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			sort($machines);
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
			$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
			$data['operating_systems'] = $this->admin_model->get_operating_systems();
			$this->load->template('manage_machines', $data);

		} else {
			$room_id = $this->input->get('room');

			if (empty($room_id) || $room_id == -1){
				$data['machines'] = $this->machine_model->get_machines();
				$rooms = $this->room_model->get_rooms();
				$data['rooms'] = $rooms;
				$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
				$data['operating_systems'] = $this->admin_model->get_operating_systems();
			} else {
				$data['machines'] = $this->machine_model->get_machines_by_room($room_id);
				$rooms = $this->room_model->get_rooms();
				$data['rooms'] = $rooms;
				$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
				$data['operating_systems'] = $this->admin_model->get_operating_systems();
			}
			
			$this->load->template('manage_machines', $data);
		}
	}

	/**
	 * Delete a machine.
	 */
	public function delete_machine() {
		$retval = $this->machine_model->delete_machine(
			$this->input->post('machine_id')
			);
		if($retval) {
			redirect('/labmgr/manage_machines');
		} else {
			echo "DB Error";
		}
	}

	public function reboot_machine() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$machine_id = $this->input->post('machine_id');
			$machine = $this->machine_model->get_machine($machine_id);
			echo $this->machine_model->reboot($machine[0]['ip_address']);

		} else {
			echo "reload previous page.";
		}
	}

	public function shutdown_machine() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$machine_id = $this->input->post('machine_id');
			$machine = $this->machine_model->get_machine($machine_id);
			echo $this->machine_model->shutdown($machine[0]['ip_address']);

		} else {
			echo "reload previous page.";
		}
	}

	public function session_home() {
		$this->load->template('session_home');
	}


	public function process_uploaded_torrents() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->load->library('bencoded');
			foreach($this->input->post('torrents') as $torrent) {
				$path = TORRENT_UPLOAD_DIR.uniqid()."/";
				mkdir($path);
				copy(UPLOADS_DIR.$torrent, $path.$torrent);
				$this->bencoded->FromFile($path.$torrent);
				$hash = $this->bencoded->InfoHash();

				$filename = $torrent;
				if (strpos($filename, '.') === FALSE) {
					
				} else {
					$parts		= explode('.', $filename);
					$ext		= array_pop($parts);
					$filename	= array_shift($parts);

					foreach ($parts as $part) {
						$filename .= '.'.$part;
					}
				}

				$insert_id = $this->torrent_model->add_torrent(
				$filename,
				$hash,
				$path.$torrent,
				'',
				$this->compute_torrent_version($filename)
				);
			}

			$this->upload_torrent('Success');
		} else {
			echo "Error, no post data.";
		}
	}

	public function do_upload()
	{
		$path = TORRENT_UPLOAD_DIR.uniqid();
		mkdir($path);
		$config['upload_path'] = $path;
		$config['allowed_types'] = '*';
		$config['max_size']	= '10000';

		$this->load->library('upload', $config);
		$this->load->library('bencoded');
		

		if (!$this->upload->do_upload('torrent_file')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			die();
			$this->load->template('upload_torrent', $error);
		}
		else {
			$upload_data = $this->upload->data();
			
			$this->bencoded->FromFile($upload_data['full_path']);
			$hash = $this->bencoded->InfoHash();

			if($this->compute_torrent_version($upload_data['raw_name']) > 0) {			

				$this->torrent_model->add_torrent(
					$upload_data['raw_name'],
					$hash,
					$upload_data['full_path'],
					file_get_contents($upload_data['full_path']),
					$this->compute_torrent_version($upload_data['raw_name'])
				);

			} else {
				$this->torrent_model->add_torrent(
					$upload_data['raw_name'],
					$hash,
					$upload_data['full_path'],
					file_get_contents($upload_data['full_path']),
					0
				);
			}
			$this->upload_torrent('Success');
		}
	}

	private function compute_torrent_version($torrent_name) {
		$search_results = $this->torrent_model->search_torrent_name($torrent_name);
			if(count($search_results > 0)) {
				$counter = 0;
				foreach($search_results as $result) {
					if($result['torrent_version'] > $counter) {
						$counter = $result['torrent_version'];
					}
				}
			}
		return	$counter += 1;
	}



	public function tester() {
		
		$msg = "@robbush86 @ibm_peten can you guys read this? This is being generated by Cron.";
		$this->logging->lwrite($msg);
		//$response = print_r($this->twitterfy($msg, TRUE));
		$this->logging->lwrite($response);

	}


	public function phptail() {
		$this->logging->lfile("./application/logs/test_lfile");
		$this->logging->lwrite("test message...");
	}
}



/* End of file labmgr.php */
/* Location: ./application/controllers/labmgr.php */