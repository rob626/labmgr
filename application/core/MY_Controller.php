<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->output->enable_profiler(TRUE);
		if(!$this->authentication->logged_in()) {
            
            $this->session->set_userdata('prev_url', $_SERVER['REQUEST_URI']);
            
			redirect('/login');
		}
	}

	public function require_login() {
		if(!$this->authentication->logged_in()) {
            
			$this->session->set_userdata('prev_url', $_SERVER['REQUEST_URI']);
            
			redirect('/login');
		}
	}
}