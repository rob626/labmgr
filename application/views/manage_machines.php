<div class='large-2 columns'>
	<ul class='side-nav'>
		<li><a href='/labmgr/add_machine'>Add Machine</a></li>
		<li><a href='/labmgr/add_room'>Manage Rooms</a></li>
		<li class='active'><a href='/labmgr/manage_machines'>Manage Machines</a></li>
		<li><a href='/labmgr/upload_torrent'>Manage Torrents</a></li>
		<li><a href='/labmgr/add_vm'>Manage VMs</a></li>
		<li><a href='/labmgr/add_script'>Manage Scripts</a></li>
	</ul>
</div> 

<div class='large-10 columns'>

<div class='row'>
<div class='panel'>
	<h1>Existing Machines</h1>
</div>

		<table id='datatable'>
			<thead>
				<tr>
					<th>Machine ID</th>
					<th>Room</th>
					<th>Seat</th>
					<th>MAC Address</th>
					<th>IP Address</th>
					<th>OS</th>
					<th>Torrent<br>Username</th>
					<th>Torrent<br>Password</th>
					<th>Torrent Client</th>
					<th>Transport Type</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($machines)) {
					
					foreach($machines as $machine) {
						echo "<tr>";
						echo "<td>".$machine['machine_id']."</td>";
						foreach($rooms as $room_key => $room_value) {
							if($room_value['room_id'] == $machine['room_id']) {
								echo "<td>". $room_value['name'] ."</td>";
							} else {
								//echo "<td></td>";
							}
						}
						echo "<td>". $machine['seat'] ."</td>";
						echo "<td>". $machine['mac_address'] ."</td>";
						echo "<td>". $machine['ip_address'] ."</td>";
						echo "<td>".$machine['operating_system']."</td>";
						echo "<td>".$machine['username']."</td>";
						echo "<td>".$machine['password']."</td>";
						/*foreach($torrent_clients as $torrent_client_key => $torrent_client_value) {
							if($torrent_client_value['torrent_client_id'] == $machine['torrent_client_id']) {
								echo "<td>". $torrent_client_value['name'] ."</td>";
							} else {
								echo "<td>-</td>";
							}
						}*/
						echo "<td>-</td>";
						echo "<td>".$machine['transport_type']."</td>";

						echo "<td><form method='POST' action='/labmgr/edit_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Edit'></form></td>";
						echo "<td>
						<form method='POST' action='/labmgr/delete_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius alert' value='Delete'></form>
						</td>";
						echo "</tr>";
						

					}
				}
				?>

			
			</tbody>
		</table>
</div>
</div>