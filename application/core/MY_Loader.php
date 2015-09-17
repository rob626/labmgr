<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom class to automatically load the header 
 * and footer.
 */

class MY_Loader extends CI_Loader {
	public function template($template_name, $vars = array(), $return = FALSE) {
		$content = $this->view('template/header', $vars, $return);
		$content .= $this->view($template_name, $vars, $return);
		$content .= $this->view('template/footer', $vars, $return);

		if ($return) {
			return $content;
		}
	}
}
