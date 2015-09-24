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
 <div class='row'>
 	<div class="large-1 columns">
 		<input class='button' type='submit' value='Submit'>
 	</div>
 </div>
</form>