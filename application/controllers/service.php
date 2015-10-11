<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('torrent_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
		$this->load->model('script_model');
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
}