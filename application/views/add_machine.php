<div class='large-2 columns'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/add_machine'>Add Machine</a></li>
		<li><a href='/labmgr/add_room'>Manage Rooms</a></li>
		<li><a href='/labmgr/manage_machines'>Manage Machines</a></li>
		<li><a href='/labmgr/upload_torrent'>Manage Torrents</a></li>
		<li><a href='/labmgr/add_vm'>Manage VMs</a></li>
		<li><a href='/labmgr/add_script'>Manage Scripts</a></li>
	</ul>
</div> 

<div class='large-10 columns'>
	<div class='row'>
		<div class='panel'>
			<h1>Add Machine</h1>
		</div>
		<form method='POST' action='/labmgr/add_machine'>

			<div class='row'>
				<div class='large-6 columns'>
					<label>Room</label>
					<select name="room_id">
						<?php foreach ($rooms as $room) { ?>
						<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
						<?php } ?>
					</select> 
				</div>

				<div class='large-6 columns'>
					<label>Seat</label>
					<input type='text' name='seat'>
				</div>
				
				<div class='large-6 columns'>
					<label>MAC Address</label>
					<input type='text' name='mac_address'>
				</div>

				<div class='large-6 columns'>
					<label>IP Address</label>
					<input type='text' name='ip_address' value='<?php echo $_SERVER['REMOTE_ADDR'] ?>'>
				</div>
			</div>

			<div class='row'>
				<div class='small-4 small-centered columns'>
					<a class='button' id='overrides' href="#">Overrides</a>
				</div>
			</div>

			<div class='hidden row'>
				<div class='large-6 columns'>
					<label>OS</label>
					<input type='text' name='operating_system' value='Windows 7'>
				</div>
				
				<div class='large-6 columns'>
					<label>Username</label>
					<input type='text' name='username' value='Admin'>
				</div>

			
				<div class='large-6 columns'>
					<label>Password</label>
					<input type='text' name='password' value='web1sphere'>
				</div>
				
				<div class='large-6 columns'>
					<label>Torrent Client</label>
					<select name="torrent_client_id">
						<?php foreach ($torrent_clients as $torrent_client) { ?>
						<option value='<?php echo $torrent_client['torrent_client_id'] ?>'><?php echo $torrent_client['name'] ?> </option>
						<?php } ?>
					</select> 
				</div>

				<div class='large-6 columns'>
					<label>Transport Type</label>
					<input type='text' name='transport_type' value='SSH'>
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