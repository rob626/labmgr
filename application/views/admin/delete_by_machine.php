<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/start_vms_by_classroom'>Start by Classroom</a></li>
		<li class='active'><a href='/labmgr/delete_lab_dir'>Delete Lab Folder by Machine</a></li>
		<hr>
		<li><a href='/labmgr/stop_vms_by_classroom'>Stop by Classroom</a></li>
		<li><a href='/labmgr/stop_vms_by_machine'>Stop by Machine</a></li>
		<hr>
		<li><a href='/labmgr/add_vm'>Manage VMs</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<div class='large-10 columns'>
	<form method='POST' id='delete_dirs_form' action=''>
	<div class='row'>

		<div class='small-6 small columns'>
			<br>
			<input type='submit' class='button large center' value='Delete Folder(s)'>
			
		</div>
		<div class='small-6 columns'>
			
		</div>

	</div>

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

		<div class='large-6 columns'>
			<h2>Folders</h2>
			<h4>Enter folder name or choose from list</h4>
			<label>Manually Enter Folder Name:</label><input type='text' name='dir' placeholder=''> 
			<hr>
			<h2>Folder List <a href='#' id='folder_list_btn' class='button'>Generate List</a></h2>
			
			<div id='folder_list'>
			</div>

		</div>
	</div>
	</form>
</div>