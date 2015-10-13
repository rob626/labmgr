<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('torrent_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
		$this->load->model('script_model');
		$this->load->model('vm_model');
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
				array_push($machines, $this->room_model->get_machines_by_room($d['value'])[0]);
			}
			if($d['name'] == 'stop_vm_by_class') {
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
}