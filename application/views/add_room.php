<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/rooms_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Manage Rooms</h1>
	</div>
	<form method='POST' action='/labmgr/add_room'>

	<div class='row'>
		<div class='large-6 columns'>
			<label>Room Name</label>
			<input type='text' name='room_name'>
		</div>

		<div class='large-6 columns'>
			<label>Room Description</label>
			<textarea name='room_desc'></textarea>
		</div>
	</div>


	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>

<div class='panel'>
	<h1>Existing Rooms</h1>
</div>

	<table id='datatable'>
		<thead>
			<tr>
				<th>Room ID</th>
				<th>Room Name</th>
				<th>Room Description</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($rooms)) {
				foreach($rooms as $room) {
					
					echo "<tr>";
					echo "<td>".$room['room_id']."</td>";
					echo "<td>".$room['name']."</td>";
					echo "<td>".$room['description']."</td>";
					echo "<td>".$room['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/labmgr/edit_room'>
					<input type='hidden' name='room_id' value='".$room['room_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form></td>";


					echo "<td><form method='POST' action='/labmgr/delete_room'>
					<input type='hidden' name='room_id' value='".$room['room_id']."'>
					<input type='submit' class='button tiny radius alert' value='Delete'>
					</form>
					</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>

</div>