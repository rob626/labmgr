<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/add_room'>Manage Rooms</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Room</h1>
	</div>

	<form method='POST' action='/labmgr/save_room_edits'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Room ID</th>
				<th>Room Name</th>
				<th>Room Description</th>
			</tr>
		</thead>
		<tbody>

	<?php
		foreach($rooms as $room) {
			echo "<tr>";
					echo "<td>".$room['room_id']."</td>";
					echo "<td><input type='text' name='room_name' value='".$room['name']."'></td>";
					echo "<td><input type='text' name='room_desc' value='".$room['description']."'></td>";
					echo "</tr>";
		}
	?>
	</tbody>
	</table>
	<input type='hidden' name='room_id' value='<?php echo $rooms[0]['room_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
	<a href='/labmgr/add_room' class='button'>Cancel</a>
	 </div>
	</form>
</div>