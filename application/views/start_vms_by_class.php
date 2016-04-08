<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/vms_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_vms_class_form' action='/labmgr/start_vms_by_classroom'>
	<div class='row'>
		<div class='small-2 columns'>
		</div>
		<div class='small-4 columns'>
			<br>
			<input type='submit' class='button large center' value='Start VMs'>
			<br>
			<input type='radio' name='start_vm_option' value='start_vm'><label>Start</label>
			<input type='radio' name='start_vm_option' value='revert_vm'><label>Revert</label>
			<input type='radio' checked name='start_vm_option' value='revert_start_vm'><label>Revert & Start</label>
			
		</div>
		<div class='small-4  columns'>
			<label>Snapshot</label><input type='text' name='snapshot' placeholder='<default>'> 
		</div>
		<div class='small-2 columns'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>VMs</h2>
			<?php
				usort($vms, function($a, $b) {
					    return strcasecmp(trim($a['name']), trim($b['name']));
					});
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
	<div class='row'>
		<div class='large-6 columns'>
			<br>
			<input type='submit' class='button large center' value='Start VMs'>
		</div>
	</div>

	</form>
</div>