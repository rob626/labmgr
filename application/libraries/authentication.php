<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Authentication {

 	public function __construct() {
 		$this->ci = &get_instance();
 	}

 	public function logged_in() {
 		return (bool)$this->ci->session->userdata('username');
 	}

 	public function logout() {
 		$this->ci->session->sess_destroy();
 		redirect('/');
 	}

 	public function uid() {
 		return $this->ci->session->userdata('uid');
 	}

 	public function username() {
 		return $this->ci->session->userdata('username');
 	}
 }