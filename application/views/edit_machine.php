<div class='panel'>
	<h1>Edit Room</h1>
</div>

<form method='POST' action='/welcome/save_machine_edits'>
<table id='datatable'>
	<thead>
		<tr>
			<th>Machine ID</th>
			<th>Room</th>
			<th>Seat</th>
			<th>MAC Address</th>
			<th>IP Address</th>
			<th>OS</th>
			<th>Username</th>
			<th>Password</th>
			<th>Torrent Client</th>
			<th>Transport Type</th>
		</tr>
	</thead>
	<tbody>

<?php
	foreach($machines as $machine) {
		echo "<tr>";
			echo "<td>".$machine['machine_id']."</td>";
			echo "<td><input type='text' name='room_id' value='".$machine['room_id']."'></td>";
			echo "<td><input type='text' name='seat' value='".$machine['seat']."'></td>";
			echo "<td><input type='text' name='mac_address' value='".$machine['mac_address']."'></td>";
			echo "<td><input type='text' name='ip_address' value='".$machine['ip_address']."'></td>";
			echo "<td><input type='text' name='operating_system' value='".$machine['operating_system']."'></td>";
			echo "<td><input type='text' name='username' value='".$machine['username']."'></td>";
			echo "<td><input type='text' name='password' value='".$machine['password']."'></td>";
			echo "<td><input type='text' name='torrent_client' value='".$machine['torrent_client']."'></td>";
			echo "<td><input type='text' name='transport_type' value='".$machine['transport_type']."'></td>";
		echo "</tr>";
	}
?>
</tbody>
</table>
<input type='hidden' name='machine_id' value='<?php echo $machines[0]['machine_id']; ?>'>
 <div class='row'>
 	<div class="large-1 columns">
 		<input class='button' type='submit' value='Submit'>
 	</div>
 </div>
</form>