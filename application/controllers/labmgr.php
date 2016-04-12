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
			'port' => '27555',
			'user' => 'admin',
			'pass' => 'web1sphere'
			);
		$this->load->library('utorrent', $params); */
		$machine['ip_address'] = '172.20.128.72';
		echo "Running utorrent lib... <br>";
		echo "<pre>";
		$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
		print_r($this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', '?list=1'));

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

		$this->getToken('192.168.15.103', '27555', 'admin', 'web1sphere');
				$torrent_data = $this->makeRequest('192.168.15.103', '27555', 'admin', 'web1sphere', '?list=1');


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

	public function sendTorrent() {
		$params = array(
			'host' => '192.168.15.190',
			'port' => '27555',
			'user' => 'admin',
			'pass' => 'web1sphere'
			);
		$this->load->library('utorrent', $params);

		$filename = '/home/robert/Desktop/Ubuntu_64-bit.5.torrent';
		print_r($this->utorrent->torrentAdd($filename));
	}

	public function get_token() {
		$url = 'http://192.168.15.190:27555/gui/token.html';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERPWD, 'admin' . ":" . 'web1sphere');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($curl);


        preg_match("#<div[^>]*id='token'[^>]*>([^<]+)</div>#simU", $response, $x);
        print_r($x[1]);

        //curl_setopt($curl,CURLOPT_URL,'http://192.168.15.190:27555/gui/?token='.$x[1].'&list=1');
        //$response = curl_exec($curl);
        //print_r($response);
	}	

	public function remove_all_torrents() {
		$machines = $this->machine_model->get_machines();
		$hash = '3798819A90FE09CA7B0F515A76E3CFDF7EB0D9CA';
		$data = true;
		foreach($machines as $machine) {
			$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
			 $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $hash), false);
		}
	}

	public function send_torrents_to_machines() {
		$machines = $this->machine_model->get_machines();
		$filename = '/home/robert/Desktop/Ubuntu_64-bit.5.torrent';

		
		foreach($machines as $machine) {

			$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

			if($this->torrentAdd($filename, $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
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
				$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
				$torrent_data = $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', '?list=1');
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
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

					if($this->torrentAdd($torrent['path'], $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
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
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

					$retval = $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
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
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
					$retval = $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
					if($retval) {
						echo "Successfully sent to: " . $machine['ip_address'] . "<br>";
					} else {
						echo "Failed to send to: " . $machine['ip_address'] . "<br>";
					}
				}
			}
			foreach($machines as $machine) {
				$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');
				$retval = $this->makeRequest($machine['ip_address'], '27555', 'admin', 'web1sphere', "?action=".($data ? "removedata" : "remove").$this->paramImplode("&hash=", $torrent['hash']), false);
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
					$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

					if($this->torrentAdd($torrent['path'], $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
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
			$this->upload_torrent();
		} else {
			echo "DB Error";
		}
	}

		/**
	 * Add a script.
	 */
	public function add_vm() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			if(!empty($this->input->post('multiple'))) {
				$multiples = $this->input->post('multiple');
				$multiple_arr = explode(';', $multiples);
				foreach($multiple_arr as $line) {
					$line_arr = explode(',', $line);
					if(!empty($line_arr[0])) {
						$name = $line_arr[0];
						$path = $line_arr[1];
						$retval = $this->vm_model->add_vm(
							$name,
							$path,
							'',
							'startlab'
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
			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			sort($machines);
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
			$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
			$data['operating_systems'] = $this->admin_model->get_operating_systems();
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
				
				$this->bencoded->FromFile(TORRENT_UPLOAD_DIR.$torrent);
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
				TORRENT_UPLOAD_DIR.$torrent,
				'',
				$this->compute_torrent_version($file_name)
				);
			}

			$this->upload_torrent('Success');
		} else {
			echo "Error, no post data.";
		}
	}

	public function do_upload()
	{
		$path = UPLOAD_DIR.uniqid();
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

	public function test_upload() {
		$data = $this->torrent_model->get_torrent(33)[0];
		header("Content Type: application/octet-stream");
		echo $data['torrent_file'];

	}

	/**
	 * Post things to twitter.
	 * Account: labmgrstatus
	 */
	public function twitterfy($message) {
		if(strlen($message) > 140) {
			return "Message greater than 140 characters";
		}
		$this->load->library('twitteroauth');
		$connection = $this->twitteroauth->create('rcsoDfKF2RVOCSn7ciSk3ZeEn','GDBfRBG7BJkkEA77Uj0Csy0PpECvE8DHlyYHNBACA4yRcnblmm','4150443137-GfSIIyrMgo4NtSLNYFv8HrR7xxs00VDIBjaOGhR','0zhD4SkuQtNeyWCmgVfKBWKTyf4UoQgWY1YRPVJ75JWSu');

		$data = array(
			'status' => $message
			);
		$result = $connection->post('statuses/update', $data);

		return $result;
	}

	public function tester() {
		$msg = "can you guys read this?";
		print_r($this->twitterfy($msg));

	}

	/**
	 * Create the message that will be published to Twitter.
	 * This function will get all machines from the DB and gather
	 * all status information about it including torrents.
	 */
	public function twitter_message() {
		$machines = $this->machine_model->get_machines();
		$machines = $this->machine_model->ping_test_arr($machines);

		foreach($machines as $key => $machine) {
				$this->getToken($machine['ip_address'], '27555', $machine['username'], $machine['password']);
				$torrent_data = $this->makeRequest($machine['ip_address'], '27555', $machine['username'], $machine['password'], '?list=1');
				$machine['torrents'] = $torrent_data['torrents'];
				$data[$key] = $machine;
			}

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		/*
		IL16/SL Ping: 578/598  (93%)  Tors: 578-1200/3000 (42%) @5/23 Data: 578-340000/980000 (37%) 
		low disk: 66/55/22/33/44

		Explained:
		<conference>/<server>
		Ping <successful-pings> / <total-machines>  (<percentage-of-machines>%) 
		Tors: <machines-counted-for-torrents-seeds> - <total-seeding-torrents> / <total-torrents> (<percentage-of-torrents-complete>%) @<ave-speed>/<total-spped>
		Data: <machines-counted-for-torrents-data> -  <total-torrent-data-moved-GB> / <total-torrent-data-TO-BE-moved-GB>  (<percentage-of-data-complete>%)  
		Low disk: <machine-count-under-50%> / <machine-count-over-50%> / <machine-count-over-80%> / <machine-count-over-90%> / <machine-count-over-95%>
		*/

		$machine_count=0;
		$online_machine_count=0;
		$downloading_torrents_machine_count=0;
		$torrent_count=0;
		$seed_count=0;
		$torrent_ave_speed=0;
		$torrent_speed=0;
		$data_transfered=0;
		$data_to_be_transfered=0;
		$disk_status_0=0;
		$disk_status_50=0;
		$disk_status_80=0;
		$disk_status_90=0;
		$disk_status_95=0;
		$disk_status_100=0;

		foreach($data as $machine) {
			$machine_count++;
			if($machine['status'] == 'ONLINE') $online_machine_count++;

            if (!empty($machine['disk_usage'])) {
            	if($machine['disk_usage'] == 100) {
                    $disk_status_100++;
                } elseif($machine['disk_usage'] > 95) {
                    $disk_status_95++;
                } elseif($machine['disk_usage'] > 90) {
                    $disk_status_90++;
                } elseif($machine['disk_usage'] > 80) {
                    $disk_status_80++;
                } elseif($machine['disk_usage'] > 50) {
                    $disk_status_50++;
                }  else {
                    $disk_status_0++;
                }
            }
            
            $twitter_log_entry = sprintf("twitter: %d (%d in %d) %s %d - %d",
            	$machine_count, $machine['seat'], $machine['room_id'], $machine['status'], $machine['disk_usage'], $downloading_torrents_machine_count);
            $this->logging->lwrite($twitter_log_entry);

            $this_machine_downloading=0;
            foreach($machine['torrents'] as $torrent) {
	            if (!empty($torrent[21])) {
	            	$torrent_count++;
	            	if($torrent[21] == 'Seeding 100.0 %') {
	            		$seed_count++;
	            	} else {
	            		if ($this_machine_downloading==0) $downloading_torrents_machine_count++;
	            		$this_machine_downloading=1;
	            	}
					$data_to_be_transfered+=$torrent[3];
					$data_remaining+=$torrent[18];
					$torrent_speed+=$torrent[9];

					$twitter_log_entry = sprintf("  torrent: %s %d / %d  @%d",
						$torrent[2], ($torrent[3] - $torrent[18]) /1024/1024/1024, $torrent[3]/1024/1024/1024, $torrent[9]/1024/1024);
            		$this->logging->lwrite($twitter_log_entry);
	            }
	        }
		}

		$data_transfered=$data_to_be_transfered-$data_remaining;
		$torrent_ave_speed=$torrent_speed / $downloading_torrents_machine_count;

		$conference = $this->authentication->conference();
		$server = $this->authentication->server();
		
		$message = sprintf("%s - %s/%s Ping: %d/%d (%.1f%%) Tors: %d %d/%d (%.1f%%) @%d/%d Data: %d %d/%d (%.1f%%) Low Disk: %d/%d/%d/%d/%d/%d",
			date("Y-m-d H:i"),
			$conference,
			$server,
			$online_machine_count, 
			$machine_count, 
			$online_machine_count/$machine_count * 100,
			$downloading_torrents_machine_count,
			$seed_count,
			$torrent_count,
			$seed_count/$torrent_count * 100,
			$torrent_ave_speed/1024/1024,
			$torrent_speed/1024/1024,
			$downloading_torrents_machine_count,
			$data_transfered/1024/1024/1024,
			$data_to_be_transfered/1024/1024/1024,
			$data_transfered/$data_to_be_transfered * 100,
			$disk_status_0,
			$disk_status_50,
			$disk_status_80,
			$disk_status_90,
			$disk_status_95,
			$disk_status_100
			);
		
		$this->logging->lwrite("Twitter message (".strlen($message)."): " .$message);
		echo $this->twitterfy($message);
	}

	public function phptail() {
		$this->logging->lfile("./application/logs/test_lfile");
		$this->logging->lwrite("test message...");
	}
}



/* End of file labmgr.php */
/* Location: ./application/controllers/labmgr.php */