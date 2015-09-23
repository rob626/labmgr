
	<dl class="sub-nav">
		<dd>
			<a href="/admin">Admin Home</a>
		</dd> 
	</dl>

	<div class='panel'>
		<h1>Add Room</h1>
	</div>
	<form method='POST' action='/welcome/add_room'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Room Name</label>
			<input type='text' name='room_name'>
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
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
</div>

<div class='panel'>
	<h1>Existing Rooms</h1>
</div>
<div class='row'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Room ID</th>
				<th>Room Name</th>
				<th>Room Description</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
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
					echo "<td><form method='POST' action='/welcome/edit_room'>
					<input type='hidden' name='room_id' value='".$room['room_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>

					<form method='POST' action='/welcome/delete_room'>
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