
<dl class="sub-nav">
	<dd>
		<a href="/admin">Admin Home</a>
</dl>
	<div class="row">
		<div class='panel'>
			<h1>Add Machine</h1>
		</div>
		<form method='POST' action='/welcome/add_machine'>

			<div class='row'>
				<div class='large-4 columns'>
					<label>Room</label>
					<select name="room_id">
						<option value='-1'>Select Room</option>
						<?php foreach ($rooms as $room) { ?>
						<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
						<?php } ?>
					</select> 
				</div>

				<div class='large-4 columns'>
					<label>Seat</label>
					<input type='text' name='seat'>
				</div>
				
				<div class='large-4 columns'>
					<label>MAC Address</label>
					<input type='text' name='mac_address'>
				</div>
			</div>

			<div class='row'>
				<div class='large-4 columns'>
					<label>IP Address</label>
					<input type='text' name='ip_address'>
				</div>

				<div class='large-4 columns'>
					<label>OS</label>
					<input type='text' name='operating_system'>
				</div>
				
				<div class='large-4 columns'>
					<label>Username</label>
					<input type='text' name='username'>
				</div>
			</div>

			<div class='row'>
				<div class='large-4 columns'>
					<label>Password</label>
					<input type='text' name='password'>
				</div>

				<div class='large-4 columns'>
					<label>Torrent Client</label>
					<input type='text' name='torrent_client'>
				</div>

				<div class='large-4 columns'>
					<label>Transport Type</label>
					<input type='text' name='transport_type'>
				</div>
			</div>

			<div class='row'>
				<div class='large-1 columns'>
					<input type='submit' class='button' value='Submit'>
				</div>
			</form>
			</div>
		</div>
	</div>


<div class='panel'>
	<h1>Existing Machines</h1>
</div>
	<div class='large-12 columns'>

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
					<th>Edit</th>
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
								echo "<td></td>";
							}
						}
						echo "<td>". $machine['seat'] ."</td>";
						echo "<td>". $machine['mac_address'] ."</td>";
						echo "<td>". $machine['ip_address'] ."</td>";
						echo "<td>".$machine['operating_system']."</td>";
						echo "<td>".$machine['username']."</td>";
						echo "<td>".$machine['password']."</td>";
						echo "<td>".$machine['torrent_client']."</td>";
						echo "<td>".$machine['transport_type']."</td>";

						echo "<td><form method='POST' action='/welcome/edit_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Edit'></form>
						<form method='POST' action='/welcome/delete_machine'>
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
