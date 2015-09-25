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
}