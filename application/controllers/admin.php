<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
		$this->load->model('user_model');
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

	public function validate_ips() 
	{
		$this->load->template('/admin/validate_ips');
	}

	public function validate_seats() 
	{
		$this->load->template('/admin/validate_seats');
	}

	public function cleanup_watchdog() 
	{
		$this->load->template('/admin/cleanup_watchdog');
	}

	public function reporting_twitter() 
	{
		$this->load->template('/admin/reporting_twitter');
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

}