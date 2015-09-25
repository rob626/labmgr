<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labmgr extends CI_Controller {

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
		$machine['ip_address'] = '192.168.15.110';
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

    public function push_torrents_by_machine() {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
			}
			
			foreach($machines as $machine) {
				$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

				if($this->torrentAdd($torrent['path'], $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
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
			
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			$machines = array();
			$machine_ids = $this->input->post('machine_ids');
			foreach($machine_ids as $id) {
				$machines = array_merge($machines, $this->machine_model->get_machine($id));
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
			$data['machines'] = $this->machine_model->get_machines();
			//$data['rooms'] = $this->room_model->get_rooms();
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
			
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
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

	public function push_torrents_by_classroom() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//echo "<pre>";
			//print_r($_POST);
			
			$torrent = $this->torrent_model->get_torrent($this->input->post('torrent_id'));
			$torrent = $torrent[0];
			$machines = array();
			$rooms = $this->input->post('room_ids');
			foreach($rooms as $room) {
				$machines = array_merge($machines, $this->machine_model->get_machines_by_room($room));
			}
			
			foreach($machines as $machine) {
				$this->getToken($machine['ip_address'], '27555', 'admin', 'web1sphere');

				if($this->torrentAdd($torrent['path'], $machine['ip_address'], '27555', 'admin', 'web1sphere')) {
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
			$this->load->template('push_torrents', $data);
		}
	
	}

	private function send($ip, $file) {
		$params = array(
				'host' => $ip,
				'port' => '27555',
				'user' => 'admin',
				'pass' => 'web1sphere'
				);
			$this->load->library('utorrent', $params);
			return $this->utorrent->torrentAdd($file);
	}

	/**
	 * Add a torrent.
	 */
	public function upload_torrent() {
			$torrents = $this->torrent_model->get_torrents();
			$data['torrents'] = $torrents;
			$this->load->template('upload_torrent', $data);
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
			$this->input->post('operating_system'),
			$this->input->post('username'),
			$this->input->post('password'),
			$this->input->post('torrent_client'),
			$this->input->post('transport_type') 
			);
		if($retval) {
			redirect('/labmgr/add_machine');
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
				redirect('/labmgr/add_machine');
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

	/**
	 * Delete a machine.
	 */
	public function delete_machine() {
		$retval = $this->machine_model->delete_machine(
			$this->input->post('machine_id')
			);
		if($retval) {
			redirect('/labmgr/add_machine');
		} else {
			echo "DB Error";
		}
	}

	public function do_upload()
	{
		$config['upload_path'] = './uploads/';
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

			$this->torrent_model->add_torrent(
				$upload_data['file_name'],
				$hash,
				$upload_data['full_path']
				);
			$this->upload_torrent();
		}
	}
}

/* End of file labmgr.php */
/* Location: ./application/controllers/labmgr.php */