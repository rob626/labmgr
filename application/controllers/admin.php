<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('machine_model');
		$this->load->model('admin_model');
	}

	public function index()
	{
		$this->load->template('/admin/home');
	}

	public function view_watchdog_log() {
		echo "placeholder for the view to the watchdog log.";
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



}