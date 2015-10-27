<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/start_vms_by_classroom'>Start by Classroom</a></li>
		<li><a href='/labmgr/start_vms_by_machine'>Start by Machine</a></li>
		<hr>
		<li><a href='/labmgr/stop_vms_by_classroom'>Stop by Classroom</a></li>
		<li><a href='/labmgr/stop_vms_by_machine'>Stop by Machine</a></li>
		<hr>
		<li><a href='/labmgr/add_vm'>Manage VMs</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_vms_class_form' action='/labmgr/start_vms_by_classroom'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Start VMs'>
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
			<h2>Classrooms</h2>
			<?php
				foreach($rooms as $room) {
					echo "<input type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>
	</form>
</div>