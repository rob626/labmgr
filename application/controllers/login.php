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
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */