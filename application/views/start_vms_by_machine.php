<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/start_vms_by_classroom'>Start by Classroom</a></li>
		<li class='active'><a href='/labmgr/start_vms_by_machine'>Start by Machine</a></li>
		<hr>
		<li><a href='/labmgr/stop_vms_by_classroom'>Stop by Classroom</a></li>
		<li><a href='/labmgr/stop_vms_by_machine'>Stop by Machine</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_vms_form' action='/labmgr/start_vms_by_machine'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Make it so...'>
			<br>
			<input type='radio' name='start_vm_option' value='start_vm'><label>Start</label>
			<input type='radio' name='start_vm_option' value='revert_vm'><label>Revert</label>
			<input type='radio' checked name='start_vm_option' value='revert_start_vm'><label>Revert & Start</label>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>VMs</h2>
			<?php
				foreach($vms as $vm) {
					echo "<input type='radio' name='vm_id' value='".$vm['vm_id']."'><label>".$vm['name']."</label><br>";
				}
			?>
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