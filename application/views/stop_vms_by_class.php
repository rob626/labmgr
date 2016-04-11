<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/vms_left_nav'); ?>
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
			usort($vms, function($a, $b) {
					    return strcasecmp(trim($a['name']), trim($b['name']));
					});
				echo "<input type='radio' name='stop_all' value='stop_all'><label>Stop All</label><br>";
				foreach($vms as $vm) {
					echo "<input type='radio' name='vm_id' value='".$vm['vm_id']."'><label>".$vm['name']."</label><br>";
				}
			?>
		</div>

		<div class='large-6 columns'>
			<h2>Classrooms</h2>
			<?php
				usort($rooms, function($a, $b) {
					return strcasecmp(trim($a['name']), trim($b['name']));
				});
				foreach($rooms as $room) {
					echo "<input type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<br>
			<input type='submit' class='button large center' value='Stop VMs'>
		</div>	
	</div>

	</form>
</div>