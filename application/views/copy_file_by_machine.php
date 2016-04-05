<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/scripts_left_nav'); ?>
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

				<select id='local_file' name='local_file'>
					<?php foreach ($files as $file) { ?>
					<option value='<?php echo $file; ?>'><?php echo $file; ?> </option>
					<?php } ?>
				</select>

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