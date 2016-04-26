<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/scripts_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<br>
	<div class="panel callout radius">
		<h3>Copying by file or directory FROM:</h3>
		<p>Copy files or directories from the remote systems to 
			the  local ./labmgr/uploads folder on the server.  
			<br><br>When the file or directory is copied from the remote system, a sub-folder under
			.labmgr/uploads/ is created for each IP address, and the remote files are then copied into
			the &ltIP-address&gt sub-folder.
		</p>
	</div>

	<form method='POST' id='copy_file_from_by_machine_form' action='/labmgr/'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button center' value='Copy File or Directory FROM'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<div class='row'>
				<h4>FROM: Remote Path</h4>
				<label>(ex: /cygdrive/c/temp/)</label><input name='remote_path' type='text'>
			</div>

			<br>

			<div class='row'>
				<h4>TO: uploads folder</h4>
				<input type='text' name='uploads' value='./labmgr/uploads/<ip-address>/'>
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
	</div>
	</form>
</div>