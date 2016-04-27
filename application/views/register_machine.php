<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/register_machine_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<?php if(!empty($this->session->flashdata('status'))) {
		echo "<div data-alert class='alert-box success radius'>
  Machine Registered (".$this->session->flashdata('status').")
  <a href='#' class='close'>&times;</a></div>";
	} ?>
	<div class='row'>
		<div class='panel'>
			<h1>Register Machine</h1>
		</div>
		<form method='POST' action='/labmgr/register_machine'>

			<div class='row'>
				<div class='large-6 columns'>
					<label>Room</label>
					<select id='room_filter_register_machine' name="room_id">
						<option value='-1'>Select Room</option>
						<?php 
							usort($rooms, function($a, $b) {
							    return strcasecmp(trim($a['name']), trim($b['name']));
							});
							foreach ($rooms as $room) { 

								if($current_room == $room['room_id']) {
									echo "<option selected value='" . $room['room_id']."'>" . $room['name'] ."</option>";

								} else {
									echo "<option value='" . $room['room_id']."'>" . $room['name'] ."</option>";

								}
						 } ?>
					</select> 
				</div>

				<div class='large-6 columns'>
					<label>Seat</label>
					<input type='text' name='seat' value='<?php echo $next_seat; ?>'>
				</div>
				
				<div class='large-6 columns'>
					<label>IP Address</label>
					<input type='text' name='ip_address' value='<?php echo $_SERVER['REMOTE_ADDR'] ?>'>
				</div>

				<div class='large-6 columns'>
					<label>MAC Address</label>
					<input type='text'  value='<?php echo $mac_guess; ?>' name='mac_address'>
				</div>
			</div>

			<div class='row'>
				<div class='small-4 small-centered columns'>
					<a class='button' id='overrides' href="#">Overrides</a>
				</div>
			</div>

			<div class='hidden row'>

				<div class='large-6 columns'>
					<label>Operating System</label>
					<select name="os_id">
						<?php foreach ($operating_systems as $operating_system) { ?>
						<option value='<?php echo $operating_system['os_id'] ?>'><?php echo $operating_system['name'] ?> </option>
						<?php } ?>
					</select> 
				</div>
				
				<div class='large-6 columns'>
					<label>Username</label>
					<input type='text' name='username' value='admin'>
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