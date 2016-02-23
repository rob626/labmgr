<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/set_global_defaults'>Set global defaults</a></li>
		<li><a href='/admin/validate_ips'>Validate MAC / IP Mapping</a></li>
		<li><a href='/admin/validate_seats'>Validate Seats</a></li>
		<li class='active'><a href='/admin/validate_vmx'>Validate VMX</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li><a href='/admin/cleanup_watchdog'>Watchdog dropins & full cleanups</a></li>
		<hr>
		<li><a href='/admin/reporting_twitter'>Reporting - twitter</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 


<div class='large-10 columns'>
	<form method='POST' id='validate_vmx_form' action='/labmgr/'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<label>Root (C:/labs)</label>
			<input type='text' name='root'>
		</div>

		<div class='large-6 columns'>
			<h2>Machines</h2>
			<label>Show by Room</label>
				<select id='room_filter' name="room_id">
					<option value='-1'>All Rooms</option>
					<?php foreach ($rooms as $room) { ?>
					<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
					<?php } ?>
				</select> 
		
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<div id='machine_list'>
			<?php
				foreach($machines as $machine) {
					echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>

		</div>
	</div>
	</form>
</div>