<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	protected $token;
    protected $guid;
    private static $base = "http://%s:%s/gui/%s";

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('torrent_model');
		$this->load->model('machine_model');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 $params = array(
			'host' => '192.168.15.190',
			'port' => '27555',
			'user' => 'admin',
			'pass' => 'web1sphere'
			);
		$this->load->library('utorrent', $params);

		echo "Running utorrent lib... <br>";
		echo "<pre>";
		print_r($this->utorrent->getTorrents());
		//print_r($this->utorrent->torrentRemove('BADBC42E639D870A24E70A7AAFA5389DDDDA0079'));
		echo "</pre>";
		die();
		$this->load->template('welcome_message'); 
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

	public function test_ut_lib() {
		
	
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
	 * Add a room.
	 */
	public function add_room() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->room_model->add_room(
				$this->input->post('room_name'), 
				$this->input->post('room_desc')
				);
			if($retval) {
				redirect('/welcome/add_room');
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
			redirect('/welcome/add_room');
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
			redirect('/welcome/add_machine');
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
			redirect('/welcome/add_room');
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
				$this->input->post('torrent_client'),
				$this->input->post('transport_type') 
				);

			if($retval) {
				redirect('/welcome/add_machine');
			} else {
				echo "DB Error";
			}

		} else {
			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			sort($machines);
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
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
			redirect('/welcome/add_machine');
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

		if (!$this->upload->do_upload('torrent_file')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			die();
			$this->load->template('upload_torrent', $error);
		}
		else {
			$upload_data = $this->upload->data();
			$this->torrent_model->add_torrent(
				$upload_data['file_name'],
				$upload_data['full_path']
				);
			$this->upload_torrent();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */