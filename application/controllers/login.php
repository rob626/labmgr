<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
	}

	function index() {
		if(!$this->input->post('username') || !$this->input->post('password')) {
			return $this->load->template('auth/login');
		}

		$result = $this->login_model->login($this->input->post('username'), $this->input->post('password'));
		if($result === TRUE) {
			redirect('/');
		} else {
			$this->load->template('auth/login');
		}	
	}

	public function logout() {
		$this->authentication->logout();
	}

	public function register_machine() {
		$this->load->model('machine_model');
		$this->load->model('room_model');
		$this->load->model('admin_model');

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
				$this->session->set_flashdata('status', $retval);
				redirect('/login/register_machine');
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
			$this->load->template('noauth_register_machine', $data);
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */