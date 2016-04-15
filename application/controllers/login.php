<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('utorrent_model');
		$this->load->model('machine_model');
		$this->load->model('twitter_model');
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

	public function register_machine() {
		$this->load->model('machine_model');
		$this->load->model('room_model');
		$this->load->model('admin_model');

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$retval = $this->machine_model->add_machine(
				$this->input->post('room_id'),
				$this->input->post('seat'),
				$this->input->post('mac_address'),
				$this->input->post('ip_address'),
				$this->input->post('os_id'),
				$this->input->post('username'),
				$this->input->post('password'),
				$this->input->post('torrent_client_id'),
				$this->input->post('transport_type') 
				);

			if($retval) {
				$room_name=$this->room_model->get_room($this->input->post('room_id'));
				$this->session->set_flashdata('status', 'machine-id: '.$retval.' room: '.$room_name[0]['name'].' / seat: '.$this->input->post('seat'));
				redirect('/login/register_machine');
			} else {
				echo "DB Error";
			}

		} else {
			$room_id = $this->input->get('room');

			if (empty($room_id) || $room_id == -1){
				$data['next_seat'] = '?';
			} else {
				$data['next_seat'] = $this->machine_model->get_next_seat($room_id);
			}

			$machines = $this->machine_model->get_machines();
			$rooms = $this->room_model->get_rooms();
			$operating_systems = $this->admin_model->get_operating_systems();
			$ip_guess = $_SERVER['REMOTE_ADDR'];
			$browser = get_browser(null, true);
			$os_guess = $browser['platform'];
			echo $os_guess;

			sort($machines);
			
			$data['mac_guess'] = $this->machine_model->get_mac($ip_guess);
			$data['os_guess'] = $os_guess;
			$data['current_room'] = $room_id;
			$data['machines'] = $machines;
			$data['rooms'] = $rooms;
			$data['operating_systems'] = $operating_systems;
			$data['torrent_clients'] = $this->admin_model->get_torrent_clients();
			$this->load->template('noauth_register_machine', $data);
		}
	}


	public function tester() {
		$machines = $this->machine_model->get_machine(73);
		foreach($machines as $key => $machine) {
			$this->utorrent_model->getToken($machine['ip_address'], '27555', $machine['username'], $machine['password']);
			$torrent_data = $this->utorrent_model->makeRequest($machine['ip_address'], '27555', $machine['username'], $machine['password'], '?list=1');
			print_r($torrent_data);
		}
	}

	/**
	 * Create the message that will be published to Twitter.
	 * This function will get all machines from the DB and gather
	 * all status information about it including torrents.
	 */
	public function twitter_message() {
		$machines = $this->machine_model->get_machines();
		$machines = $this->machine_model->ping_test_arr($machines);

		foreach($machines as $key => $machine) {
				$this->utorrent_model->getToken($machine['ip_address'], '27555', $machine['username'], $machine['password']);
				$torrent_data = $this->utorrent_model->makeRequest($machine['ip_address'], '27555', $machine['username'], $machine['password'], '?list=1');
				$machine['torrents'] = $torrent_data['torrents'];
				$data[$key] = $machine;
			}

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		/*
		IL16/SL Ping: 578/598  (93%)  Tors: 578-1200/3000 (42%) @5/23 Data: 578-340000/980000 (37%) 
		low disk: 66/55/22/33/44

		Explained:
		<conference>/<server>
		Ping <successful-pings> / <total-machines>  (<percentage-of-machines>%) 
		Tors: <machines-counted-for-torrents-seeds> - <total-seeding-torrents> / <total-torrents> (<percentage-of-torrents-complete>%) @<ave-speed>/<total-spped>
		Data: <machines-counted-for-torrents-data> -  <total-torrent-data-moved-GB> / <total-torrent-data-TO-BE-moved-GB>  (<percentage-of-data-complete>%)  
		Low disk: <machine-count-under-50%> / <machine-count-over-50%> / <machine-count-over-80%> / <machine-count-over-90%> / <machine-count-over-95%>
		*/

		$machine_count=0;
		$online_machine_count=0;
		$downloading_torrents_machine_count=0;
		$torrent_count=0;
		$seed_count=0;
		$torrent_ave_speed=0;
		$torrent_speed=0;
		$data_transfered=0;
		$data_to_be_transfered=0;
		$data_remaining=0;
		$disk_status_0=0;
		$disk_status_50=0;
		$disk_status_80=0;
		$disk_status_90=0;
		$disk_status_95=0;
		$disk_status_100=0;

		foreach($data as $machine) {
			$machine_count++;
			if($machine['status'] == 'ONLINE') $online_machine_count++;

            if (!empty($machine['disk_usage'])) {
            	if($machine['disk_usage'] == 100) {
                    $disk_status_100++;
                } elseif($machine['disk_usage'] > 95) {
                    $disk_status_95++;
                } elseif($machine['disk_usage'] > 90) {
                    $disk_status_90++;
                } elseif($machine['disk_usage'] > 80) {
                    $disk_status_80++;
                } elseif($machine['disk_usage'] > 50) {
                    $disk_status_50++;
                }  else {
                    $disk_status_0++;
                }
            }
            
            $twitter_log_entry = sprintf("twitter: %d (%d in %d) %s %d - %d",
            	$machine_count, $machine['seat'], $machine['room_id'], $machine['status'], $machine['disk_usage'], $downloading_torrents_machine_count);
            $this->logging->lwrite($twitter_log_entry);

            $this_machine_downloading=0;

            if (!empty($machine['torrents'])) {
	            foreach($machine['torrents'] as $torrent) {
		            if (!empty($torrent[21])) {
		            	$torrent_count++;
		            	if($torrent[21] == 'Seeding 100.0 %') {
		            		$seed_count++;
		            	} else {
		            		if ($this_machine_downloading==0) $downloading_torrents_machine_count++;
		            		$this_machine_downloading=1;
		            	}
						$data_to_be_transfered+=$torrent[3];
						$data_remaining+=$torrent[18];
						$torrent_speed+=$torrent[9];

						$twitter_log_entry = sprintf("  torrent: %s %d / %d  @%d",
							$torrent[2], ($torrent[3] - $torrent[18]) /1024/1024/1024, $torrent[3]/1024/1024/1024, $torrent[9]/1024/1024);
	            		$this->logging->lwrite($twitter_log_entry);
		            }
		        }
	    	}
		}

		$data_transfered=$data_to_be_transfered-$data_remaining;
		if (!$downloading_torrents_machine_count==0) {
			$torrent_ave_speed=$torrent_speed / $downloading_torrents_machine_count;
		} else {
			$torrent_ave_speed=0;
		}

		$conference = $this->authentication->conference();
		$server = $this->authentication->server();
		
		$message = sprintf("%s - %s/%s Ping: %d/%d (%.1f%%) Tors: %d %d/%d (%.1f%%) @%d/%d Data: %d %d/%d (%.1f%%) Low Disk: %d/%d/%d/%d/%d/%d",
			date("Y-m-d H:i"),
			$conference,
			$server,
			$online_machine_count, 
			$machine_count, 
			$online_machine_count/$machine_count * 100,
			$downloading_torrents_machine_count,
			$seed_count,
			$torrent_count,
			$seed_count/$torrent_count * 100,
			$torrent_ave_speed/1024/1024,
			$torrent_speed/1024/1024,
			$downloading_torrents_machine_count,
			$data_transfered/1024/1024/1024,
			$data_to_be_transfered/1024/1024/1024,
			$data_transfered/$data_to_be_transfered * 100,
			$disk_status_0,
			$disk_status_50,
			$disk_status_80,
			$disk_status_90,
			$disk_status_95,
			$disk_status_100
			);
		
		$this->logging->lwrite("Twitter message (".strlen($message)."): " .$message);
		print_r($this->twitter_model->twitterfy($message), true);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */