<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
		$this->load->model('user_model');
		$this->load->model('conference_model');
		$this->load->model('server_model');
		$this->load->model('twitter_model');
	}

	public function index()
	{
		$this->load->template('/admin/home');
	}

	public function db_reset()
	{
		$this->load->template('/admin/db_reset');
	}


	public function set_global_defaults() 
	{
		$this->load->template('/admin/set_global_defaults');
	}

	public function fix_macs() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data['rooms'] = $this->room_model->get_rooms();
			$data['fixed_machines'] = $this->machine_model->fix_broken_macs();
			$this->load->template('/admin/fix_broken_macs', $data);
		} else {
			$data['rooms'] = $this->room_model->get_rooms();
			$data['broken_machines'] = $this->machine_model->get_broken_macs();
			$this->load->template('/admin/fix_broken_macs', $data);
		}
	}

	public function validate_ips() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			echo "Running... <br>";
			$from = $this->input->post('from_1') .'.'.$this->input->post('from_2') .'.'.$this->input->post('from_3') .'.'.$this->input->post('from_4');
			$to = $this->input->post('to_1') .'.'.$this->input->post('to_2') .'.'.$this->input->post('to_3') .'.'.$this->input->post('to_4');

			$from_long = ip2long($from);
			$to_long = ip2long($to);


			for($i = $from_long; $i <= $to_long; $i++) {
				$data = $this->admin_model->validate_mac(long2ip($i));
				echo "<pre>";
				print_r($data);
				echo "</pre>";
			}

		} else {
			$this->load->template('/admin/validate_ips');
		}	
	}

	public function update_ips() {
		print_r($_POST);
	}

	public function validate_seats() 
	{
		$data['rooms'] = $this->room_model->get_rooms();
		$seats = array();
		foreach($data['rooms'] as $room) {
			$seats[$room['name']] = $this->machine_model->validate_seats($room['room_id']);
		}
		$data['seats'] = $seats;
		$this->load->template('/admin/validate_seats', $data);
	}

	public function cleanup_watchdog() 
	{
		$this->load->template('/admin/cleanup_watchdog');
	}

	public function reporting_twitter() 
	{
		$data['enabled'] = $this->twitter_model->twitter_enabled();
		$this->load->template('/admin/reporting_twitter', $data);
	}

	public function validate_vmx() {
		$data['machines'] = $this->machine_model->get_machines();
		$data['rooms'] = $this->room_model->get_rooms();
		$this->load->template('/admin/validate_vmx', $data);
	}

	/**
	 * Manage conferences.
	 */
	public function add_conference() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->conference_model->add_conference(
				$this->input->post('conference_name'), 
				$this->input->post('conference_desc')
				);
			redirect('/admin/');
		} else {
			$data['conferences'] = $this->conference_model->get_conferences();
			$this->load->template('/admin/add_conference', $data);
		}
	}

	/**
	 * Delete a conference.
	 */
	public function delete_conference() {
		$retval = $this->conference_model->delete_conference(
			$this->input->post('conference_id')
			);
		if($retval) {
			redirect('/admin/add_conference');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Manage servers.
	 */
	public function add_server() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->server_model->add_server(
				$this->input->post('server_name'), 
				$this->input->post('server_desc')
				);
			redirect('/admin/');
		} else {
			$data['servers'] = $this->server_model->get_servers();
			$this->load->template('/admin/add_server', $data);
		}
	}

	/**
	 * Delete a server.
	 */
	public function delete_server() {
		$retval = $this->server_model->delete_server(
			$this->input->post('server_id')
			);
		if($retval) {
			redirect('/admin/add_server');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add a torrent_client.
	 */
	public function add_user() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->user_model->add_user(
				$this->input->post('username'), 
				$this->input->post('password'),
				$this->input->post('role'),
				$this->input->post('first_name'),
				$this->input->post('last_name')
				);
			if($retval) {
				redirect('/admin/add_user');
			} else {
				echo "Error";
			}

		} else {
			$users = $this->user_model->get_users();
			
			$data['users'] = $users;

			$this->load->template('/admin/add_user', $data);
		}
	}

	/**
	 * Delete a user.
	 */
	public function delete_user() {
		$retval = $this->user_model->delete_user(
			$this->input->post('user_id')
			);
		if($retval) {
			redirect('/admin/add_user');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add a torrent_client.
	 */
	public function add_torrent_client() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->admin_model->add_torrent_client(
				$this->input->post('torrent_client_name'), 
				$this->input->post('torrent_client_desc')
				);
			if($retval) {
				redirect('/admin/add_torrent_client');
			} else {
				echo "DB Error";
			}

		} else {
			$torrent_clients = $this->admin_model->get_torrent_clients();
			sort($torrent_clients);
			$data['torrent_clients'] = $torrent_clients;

			$this->load->template('/admin/add_torrent_client', $data);
		}
	}

	/**
	 * Edit a torrent_client
	 */
	public function edit_torrent_client() {
		$torrent_client_id = $this->input->post("torrent_client_id");
		$data['torrent_clients'] = $this->admin_model->get_torrent_client($torrent_client_id);
		$this->load->template('/admin/edit_torrent_client', $data);
	}

	/**
	 * Save changes made to a torrent_client.
	 */
	public function save_torrent_client_edits() {
		$retval = $this->admin_model->update_torrent_client(
			$this->input->post('torrent_client_id'), 
			$this->input->post('torrent_client_name'), 
			$this->input->post('torrent_client_desc')
			);
		if($retval) {
			redirect('/admin/add_torrent_client');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Add an operating system.
	 */
	public function add_operating_system() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->admin_model->add_operating_system(
				$this->input->post('os_name'), 
				$this->input->post('os_desc')
				);
			if($retval) {
				redirect('/admin/add_operating_system');
			} else {
				echo "DB Error";
			}

		} else {
			$operating_systems = $this->admin_model->get_operating_systems();
			sort($operating_systems);
			$data['operating_systems'] = $operating_systems;

			$this->load->template('/admin/add_operating_system', $data);
		}
	}

	/**
	 * Edit a operating_system
	 */
	public function edit_operating_system() {
		$operating_system_id = $this->input->post("operating_system_id");
		$data['operating_systems'] = $this->admin_model->get_operating_system($operating_system_id);
		$this->load->template('/admin/edit_operating_system', $data);
	}

	/**
	 * Save changes made to a operating_system.
	 */
	public function save_operating_system_edits() {
		$retval = $this->admin_model->update_operating_system(
			$this->input->post('os_id'), 
			$this->input->post('os_name'), 
			$this->input->post('os_desc')
			);
		if($retval) {
			redirect('/admin/add_operating_system');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Delete a room.
	 */
	public function delete_operating_system() {
		$retval = $this->admin_model->delete_operating_system(
			$this->input->post('os_id')
			);
		if($retval) {
			redirect('/admin/add_operating_system');
		} else {
			echo "DB Error";
		}
	}

	/**
	 * Export the current db to a backup file
	 */
	public function export_db() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$data = $this->admin_model->export_db($this->input->post('backup_filename'));
			$this->load->template('admin/export_db', $data);
		} else {
			$data['current_backups'] = $this->admin_model->get_db_backups();
			$this->load->template('admin/export_db', $data);
		}

	}

	/**
	 * Import a database from a backup file.
	 */
	public function import_db() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$data = $this->admin_model->import_db($this->input->post('backup_filename'));
			$this->load->template('admin/import_db', $data);
		} else {
			$data['current_backups'] = $this->admin_model->get_db_backups();
			$this->load->template('admin/import_db', $data);
		}

	}

	/**
	 * Deletes lab directory 
	 */
	public function delete_lab_dir() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				/*echo "<pre>";
				print_r($_POST);
				die(); */


				/*
				print_r($torrent);
				echo "<br>Machines: <br>";
				print_r($machines);
				echo "</pre>";*/

			} else {
				$data['machines'] = $this->machine_model->get_machines();
				$data['rooms'] = $this->room_model->get_rooms();

				$this->load->template('admin/delete_by_machine', $data);
			}	
		}

	public function labmgr_manage_configs() 
		{
			$this->load->template('/admin/labmgr_manage_configs');
		}

	public function view_log_file() 
	{
		$this->load->template('/admin/view_log_file');
	}

	public function ticket_system() 
	{
		$this->load->template('/admin/ticket_system');
	}

}