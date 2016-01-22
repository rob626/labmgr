<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/run_single_cmd_class'>Run Single Command by Class</a></li>
		<li><a href='/labmgr/run_single_cmd_machine'>Run Single Command by Machine</a></li>
		<hr>
		<li><a href='/labmgr/add_script'>Manage Scripts</a></li>
		<hr>
		<li><a href='/labmgr/'>Copy file by Class</a></li>
		<li class='active'><a href='/labmgr/copy_file_by_machine'>Copy file by Machine</a></li>
		<li><a href='/labmgr/'>Copy directory by Class</a></li>		
		<li><a href='/labmgr/'>Copy directory by Machine</a></li>	
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<div class='large-10 columns'>
	<form method='POST' id='copy_file_by_machine_form' action='/labmgr/'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<div class='row'>
				<h2>Local File</h2>
				<input name='cmd' type='text'>
			</div>
			<div class='row'>
				<h2>Remote Path</h2>
				<input name='remote_path' type='text'>
			</div>
		</div>

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
	</form>
</div>