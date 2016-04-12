<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/vms_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_vms_form' action='/labmgr/start_vms_by_machine'>
	<div class='row'>
		<div class='small-2 columns'>
		</div>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Make it so...'>
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
			<h2>Machines</h2>
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
	
	<div class='row'>
		<div class='large-6 columns'>
			<br><br>
			<input type='submit' class='button large center' value='Make it so...'>
		</div>
	</div>
	
	</form>
</div>
