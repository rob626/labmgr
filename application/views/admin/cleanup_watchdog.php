<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Cleanup Watchdog:</h3>
				<p>This function cleans up the watchdog data on the client machines. 
					<br><br>&nbsp &nbsp- The cleanup dropins function removes the dropins and the hassbeenrun directories.
					<br>&nbsp &nbsp- The cleanup full function removes the log file, as well as the dropins and the 
					hassbeenrun directories.
				</p>
			</div>

			<div class='large-6 columns'>
				<br>
				<a id='cleanup_watchdog_dropins' class='button' href='#'>Cleanup WD Dropins</a>
				<a id='cleanup_watchdog_FULL' class='button' href='#'>Cleanup WD FULL</a>
			</div>
		</div>

		<div class='row'>
			<form method='POST' id='cleanup_watchdog_form' action=''>
			<div class='large-6 columns'>
				<h2>Machines</h2>
				<label>Show by Room</label>
					<select id='room_filter' name="room_id">
						<option value='-1'>All Rooms</option>
						<?php 
						usort($rooms, function($a, $b) {
							return strcasecmp(trim($a['name']), trim($b['name']));
						});
						foreach ($rooms as $room) { ?>
						<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
						<?php } ?>
					</select> 
			
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
							echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' - room: '. $r . ' ('.$machine['ip_address'].")</label><br>";
						}
					?>
				</div>

			</div>
			</form>
		</div>
</div>


