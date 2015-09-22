<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
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
		//print_r($this->utorrent->getTorrents());
		print_r($this->utorrent->torrentRemove('BADBC42E639D870A24E70A7AAFA5389DDDDA0079'));
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

		$filename = '/home/robert/Desktop/Ubuntu_64-bit.torrent';
		print_r($this->utorrent->torrentAdd($filename));
	}

	public function getToken() {
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */