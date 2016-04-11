<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/scripts_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<br>
	<div class="panel callout radius">
		<h3>Copying by file or directory:</h3>
		<p>To copy files or directories to the remote systems, first upload the file or directory to 
			the ./labmgr/uploads folder on the server.  
			<br><br>The file or directory is then available through Local File pulldown.
		</p>
	</div>

	<form method='POST' id='copy_file_by_machine_form' action='/labmgr/'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button center' value='Copy File or Directory'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<div class='row'>
				<h4>Local File or Directory</h4>

				<select id='local_file' name='local_file'>
					<?php foreach ($files as $file) { ?>
					<option value='<?php echo $file; ?>'><?php echo $file; ?> </option>
					<?php } ?>
				</select>

			</div>
			<div class='row'>
				<h4>Remote Path</h4>
				<label>(ex: /cygdrive/c/temp/)</label><input name='remote_path' type='text'>
			</div>
		</div>

		<div class='large-6 columns'>
			<h4>Machines</h4>
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
				foreach($machines as $machine) {
					echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>

		</div>
	</div>
	</form>
</div>