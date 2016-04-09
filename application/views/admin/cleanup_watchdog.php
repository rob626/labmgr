<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Cleanup Watchdog:</h3>
				<p>This function cleans up the watchdog data on the client machines. 
					This includes the log file, the dropins, and the hassbeenrun directories.
					<br><br>
				</p>
			</div>

			<div class='large-5 columns'>
				<br>
				<a href='#' id='cleanup_watchdog_btn' class='button'>Cleanup Watchdog</a>
			</div>
		</div>

		<!-- 
		<div class='row'>
			<div class='large-6 columns'>
				<h2>Run Command (ex: ls -ltr)</h2>
				
				<label>Command</label><input name='cmd' type='text'>
			</div>
		</div>
		-->

		<div class='row'>
			<div class='large-6 columns'>
				<h2>Machines</h2>
				<label>Show by Room</label>
					<select id='room_filter' name="room_id">
						<option value='-1'>All Rooms</option>
						<?php foreach ($rooms as $room) { ?>
						<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
						<?php } ?>
					</select> 
			
				<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
				<div id='machine_list'>
					<?php
						foreach($machines as $machine) {
							echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' ('.$machine['ip_address'].")</label><br>";
						}
					?>
				</div>

			</div>
		</div>
</div>


