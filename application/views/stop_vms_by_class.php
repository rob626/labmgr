<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/start_vms_by_classroom'>Start by Classroom</a></li>
		<li><a href='/labmgr/start_vms_by_machine'>Start by Machine</a></li>
		<hr>
		<li class='active'><a href='/labmgr/stop_vms_by_classroom'>Stop by Classroom</a></li>
		<li><a href='/labmgr/stop_vms_by_machine'>Stop by Machine</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_vms_class_form' action='/labmgr/stop_vms_by_classroom'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='hidden' name='stop_vm_by_machine' value='1'>
			<input type='submit' class='button large center' value='Stop VMs'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>VMs</h2>

			<?php
				echo "<input type='radio' name='stop_all' value='stop_all'><label>Stop All</label><br>";
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