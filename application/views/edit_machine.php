<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/machines_left_nav'); ?>
</div>


<div class='large-10 columns'>
<div class='panel'>
	<h1>Edit Machine</h1>
</div>

<form method='POST' action='/labmgr/save_machine_edits'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Room</label>
			<?php echo "<select name='room_id'>
					<option>Select Room</option>";
					foreach ($rooms as $room) {
						if($room['room_id'] == $machines[0]['room_id']) {
							echo "<option selected value='".$room['room_id']."'>".$room['name']."</option>";
						} else {
							echo "<option value='".$room['room_id']."'>".$room['name']."</option>";
						}
						
					} 
				 
			echo "</select>"; ?>
		</div>

		<div class='large-4 columns'>
			<label>Seat</label>
			<?php echo "<input type='text' name='seat' value='".$machines[0]['seat']."'>"; ?>
		</div>

		<div class='large-4 columns'>
			<label>MAC Address</label>
			<?php echo "<input type='text' name='mac_address' value='".$machines[0]['mac_address']."'>"; ?>
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>IP Address</label>
			<?php echo "<input type='text' name='ip_address' value='".$machines[0]['ip_address']."'>"; ?>
		</div>

		<div class='large-4 columns'>
			<label>Operating System</label>
			<?php echo "<td><select name='os_id'>
					<option>Select OS</option>";
					foreach ($operating_systems as $operating_system) {
						if($operating_system['os_id'] == $machines[0]['os_id']) {
							echo "<option selected value='".$operating_system['os_id']."'>".$operating_system['name']."</option>";
						} else {
							echo "<option value='".$operating_system['os_id']."'>".$operating_system['name']."</option>";
						}
						
					} 
					echo "</select></td>";
					?>
		</div>

		<div class='large-4 columns'>
			<label>Username</label>
			<?php echo "<input type='text' name='username' value='".$machines[0]['username']."'>"; ?>
		</div>
	</div>

	<div class='row'> 
		<div class='large-4 columns'>
			<label>Password</label>
			<?php echo "<input type='text' name='password' value='".$machines[0]['password']."'>"; ?>
		</div>

		<div class='large-4 columns'>
			<label>Torrent Client</label>
			<?php 
			echo "<td><select name='torrent_client_id'>
					<option>Select OS</option>";
					foreach ($torrent_clients as $torrent_client) {
						if($torrent_client['torrent_client_id'] == $machines[0]['torrent_client_id']) {
							echo "<option selected value='".$torrent_client['torrent_client_id']."'>".$torrent_client['name']."</option>";
						} else {
							echo "<option value='".$torrent_client['torrent_client_id']."'>".$torrent_client['name']."</option>";
						}
						
					} 
					echo "</select></td>";
			?>
		</div>

		<div class='large-4 columns'>
			<label>Transport Type</label>
			<?php echo "<input type='text' name='transport_type' value='".$machines[0]['transport_type']."'>"; ?>
		</div>
	</div>
<div class='row'>
	<input type='hidden' name='machine_id' value='<?php echo $machines[0]['machine_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
</div>

</form>
</div>