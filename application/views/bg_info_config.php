<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/rooms_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='bg_info_config_class_form' action='/labmgr/bg_info_config'>
	<div class='row'>
		<div class='small-12 small-centered columns'>
			<h1>BGinfo Config</h1>
			<div class="panel callout radius">
				<p>This function pushes out a file called bginfo-labmgr-room-seat.txt to C:\Windows\ on each machine.  This file is read by bginfo to load the individual machines room and seat information. 
				<br><br>
				The file C:\Windows\bginfo-labmgr.bgi must exist and be configured to read this file.
				<br><br>
				The file bginfo-labmgr.bat needs to be in the Start folder for all users.  This file calls bginfo and points to the bginfo-labmgr.bgi.  If the bginfo-labmgr-room-seat.txt file does not exist on the machine, that field is blank in bginfo.
				</p>
			</div>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>
		<div class='large-3 columns'>
			<label>Alternate Room Label</label>
			<input type='text' name='Room-label' value=''>
		</div>
	</div>

	<div class='row'>
		<h4>Rooms</h4>
			<label>Show by Room</label>
				<select id='room_filter_bg' name="room_id">
					<option value='-1'>All Rooms</option>
					<?php 
					usort($rooms, function($a, $b) {
						return strcasecmp(trim($a['name']), trim($b['name']));
					});
					foreach ($rooms as $room) { ?>
					<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
					<?php } ?>
				</select> 
		


			<!-- 
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<div id='machine_list'>
			<?php
				usort($machines, function($a, $b) {
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

				foreach($machines as $machine) {
					$room=$this->room_model->get_room($machine['room_id']);
					$r=$room[0]['name'];
					//echo "<label>" . $r . " - " . $machine['seat'] . "</label>";
					//echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' - room: '. $r . ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>
		-->
	</div>
	</form>
</div>