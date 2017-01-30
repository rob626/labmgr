<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/machines_left_nav'); ?>
</div>

<div class='large-10 columns'>

<div class='row'>
<div class='panel'>
	<h1>Existing Machines</h1>
</div>

		<table id='datatable'>
			<thead>
				<tr>
					<th>Select</th>
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
				<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
				<a href='#' id='delete_machines_btn' class='button'>Delete Selected</a>
				<div class='large-3 columns'>
					<label>Room</label>
						<select id='room_filter_machine_status' name="room_id">
							<option>Select Room</option>
							<option value='-1'>All Rooms</option>
							<?php 
							usort($rooms, function($a, $b) {
							    return strcasecmp(trim($a['name']), trim($b['name']));
							});
							foreach ($rooms as $room) { ?>
							<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
							<?php } ?>
						</select> 
						<br>
				</div>
				<?php
				if(!empty($machines)) {
					
					foreach($machines as $machine) {
						echo "<tr>";
						echo "<td><input class='checkbox' type='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'></td>";
						echo "<td>".$machine['machine_id']."</td>";
						foreach($rooms as $room_key => $room_value) {
							if($room_value['room_id'] == $machine['room_id']) {
								echo "<td>". $room_value['name'] ."</td>";
							} else {
								//echo "<td>-</td>";
							}
						}
						echo "<td>". $machine['seat'] ."</td>";
						echo "<td>". $machine['mac_address'] ."</td>";
						echo "<td>". $machine['ip_address'] ."</td>";

						foreach($operating_systems as $operating_system_key => $operating_system_value) {
							if($operating_system_value['os_id'] == $machine['os_id']) {
								echo "<td>". $operating_system_value['name'] ."</td>";
							} else {
								//echo "<td>-</td>";
							}
						}
						echo "<td>".$machine['username']."</td>";
						echo "<td>".$machine['password']."</td>";
						foreach($torrent_clients as $torrent_client_key => $torrent_client_value) {
							if($torrent_client_value['torrent_client_id'] == $machine['torrent_client_id']) {
								echo "<td>". $torrent_client_value['name'] ."</td>";
							} else {
								//echo "<td>-</td>";
							}
						}
						
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