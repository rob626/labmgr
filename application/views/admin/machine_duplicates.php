<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Machine Duplicates</h3>
				<p>This function searches the database for instances of duplicate IP addresses
					and duplicate MAC addresses.<br><br>
					Typically, there should be no duplicates.  If there are, it is a good idea to use 
					the <b>Machines &gt Manage Machines</b> page to remove the duplicate entry(s) which is 
					not correct.
				</p>
			</div>
		</div>


		<div class='row'>
		<?php

			/*echo "<pre>";
			print_r($duplicate_ips);
			print_r($duplicate_macs);
			echo "</pre>";*/

			echo "<br><h3><u>Duplicate IP addresses:</u></h3><br>";
			foreach($duplicate_ips as $dup_ip) {
				echo "<b>&nbsp;&nbsp;Duplicate IP address: ".$dup_ip['ip_address']."</b><br>";
				usort($dup_ip['machines'], function($a, $b) {
					$room_a=$this->room_model->get_room($a['room_id']);
					$room_a_name=$room_a[0]['name'];
					$room_b=$this->room_model->get_room($b['room_id']);
					$room_b_name=$room_b[0]['name'];

				    $name = strcmp(trim($room_a_name), trim($room_b_name));
				    if($name === 0) {
				        return $a['seat'] - $b['seat'];
				    }
				    return $name;
				});
				foreach($dup_ip['machines'] as $m) {
					$room_name = $this->room_model->get_room($m['room_id'])[0]['name'];
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Room: ".$room_name
						." - Seat: ".$m['seat']
						." - MAC: ".$m['mac_address']
						."<br>";
				}
				echo "<br>";
			}

			echo "<br><h3><u>Duplicate MAC addresses:</h3></u><br>";
			foreach($duplicate_macs as $dup_mac) {
				echo "<b>&nbsp;&nbsp;Duplicate MAC address: ".$dup_mac['mac_address']."</b><br>";
				usort($dup_mac['machines'], function($a, $b) {
					$room_a=$this->room_model->get_room($a['room_id']);
					$room_a_name=$room_a[0]['name'];
					$room_b=$this->room_model->get_room($b['room_id']);
					$room_b_name=$room_b[0]['name'];

				    $name = strcmp(trim($room_a_name), trim($room_b_name));
				    if($name === 0) {
				        return $a['seat'] - $b['seat'];
				    }
				    return $name;
				});
				foreach($dup_mac['machines'] as $m) {
					$room_name = $this->room_model->get_room($m['room_id'])[0]['name'];
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Room: ".$room_name
						." - Seat: ".$m['seat']
						." - IP: ".$m['ip_address']
						."<br>";
				}
				echo "<br>";
			}
		?>
		</div>
	</div>
</div>