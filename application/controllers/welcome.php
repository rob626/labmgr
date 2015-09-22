<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 $params = array(
			'host' => '192.168.15.190',
			'port' => '27555',
			'user' => 'admin',
			'pass' => 'web1sphere'
			);
		$this->load->library('utorrent', $params);

		echo "Running utorrent lib... <br>";
		echo "<pre>";
		print_r($this->utorrent->getTorrents());
		echo "</pre>";
		die();
		$this->load->template('welcome_message');
	}

	public function test() {
		define('0', 'UTORRENT_TORRENT_HASH');
		$output = array(
			0 => 'BADBC42E639D870A24E70A7AAFA5389DDDDA0079',
			1 => '201'
			);

		$types = array(
			'0' => 'UTORRENT_TORRENT_HASH',
			'1' => 'UTORRENT_TORRENT_STATUS'
			);
		$combined = array();
		foreach($output as $key => $value) {
			foreach($types as $type_key => $type_value) {
				if($key == $type_key) {
					//echo $type_value .' => '. $value . '<br>';
					$combined[$type_value] = $value;
				}
			}
		}
		print_r($combined);
	}

	public function getToken() {
		$url = 'http://192.168.15.190:27555/gui/token.html';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERPWD, 'admin' . ":" . 'web1sphere');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        $response = curl_exec($curl);


        preg_match("#<div[^>]*id='token'[^>]*>([^<]+)</div>#simU", $response, $x);
        print_r($x[1]);

        //curl_setopt($curl,CURLOPT_URL,'http://192.168.15.190:27555/gui/?token='.$x[1].'&list=1');
        //$response = curl_exec($curl);
        //print_r($response);
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */