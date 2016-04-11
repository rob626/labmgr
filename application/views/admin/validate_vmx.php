<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 


<div class='large-10 columns'>
	<form method='POST' id='validate_vmx_form' action='/labmgr/'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<label>Root (C:/Labs)</label>
			<input type='text' name='root' value='C:/Labs'>
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
				foreach($machines as $machine) {
					$room=$this->room_model->get_room($machine['room_id']);
					echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' - room: '. $room[0]['name'] . ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>

		</div>
	</div>
	</form>
</div>