<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/machine_status'>Machines status</a></li>
		<hr>
		<li><a href='/labmgr/manage_machines'>Manage Machines</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<div class='large-10 columns'>
<div class='panel'>
	<h1>Edit Machine</h1>
</div>

<form method='POST' action='/labmgr/save_machine_edits'>
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
			echo "<td>";
			echo "<select name='room_id'>
					<option>Select Room</option>";
					foreach ($rooms as $room) {
						if($room['room_id'] == $machine['room_id']) {
							echo "<option selected value='".$room['room_id']."'>".$room['name']."</option>";
						} else {
							echo "<option value='".$room['room_id']."'>".$room['name']."</option>";
						}
						
					} 
				 
			echo "</select></td>";
			echo "<td><input type='text' name='seat' value='".$machine['seat']."'></td>";
			echo "<td><input type='text' name='mac_address' value='".$machine['mac_address']."'></td>";
			echo "<td><input type='text' name='ip_address' value='".$machine['ip_address']."'></td>";
			echo "<td><select name='os_id'>
					<option>Select OS</option>";
					foreach ($operating_systems as $operating_system) {
						if($operating_system['os_id'] == $machine['os_id']) {
							echo "<option selected value='".$operating_system['os_id']."'>".$operating_system['name']."</option>";
						} else {
							echo "<option value='".$operating_system['os_id']."'>".$operating_system['name']."</option>";
						}
						
					} 
					echo "</td>";


			echo "<td><input type='text' name='username' value='".$machine['username']."'></td>";
			echo "<td><input type='text' name='password' value='".$machine['password']."'></td>";
			echo "<td><select name='torrent_client_id'>
					<option>Select OS</option>";
					foreach ($torrent_clients as $torrent_client) {
						if($torrent_client['torrent_client_id'] == $machine['torrent_client_id']) {
							echo "<option selected value='".$torrent_client['torrent_client_id']."'>".$torrent_client['name']."</option>";
						} else {
							echo "<option value='".$torrent_client['torrent_client_id']."'>".$torrent_client['name']."</option>";
						}
						
					} 
					echo "</td>";

			echo "<td><input type='text' name='transport_type' value='".$machine['transport_type']."'></td>";
		echo "</tr>";
	}
?>
</tbody>
</table>
<input type='hidden' name='machine_id' value='<?php echo $machines[0]['machine_id']; ?>'>
 <input class='button' type='submit' value='Submit'>

</form>
</div>