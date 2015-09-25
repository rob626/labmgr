<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/push_torrents_by_classroom'>Push by Classroom</a></li>
		<li class='active'><a href='/labmgr/push_torrents_by_machine'>Push by Machine</a></li>
		<hr>
		<li><a href='/labmgr/delete_torrents_by_classroom'>Delete by Classroom</a></li>
		<li><a href='/labmgr/delete_torrents_by_machine'>Delete by Machine</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<form method='POST' action='/labmgr/push_torrents_by_machine'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Push Torrents'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>Torrents</h2>
			<?php
				foreach($torrents as $torrent) {
					echo "<input type='radio' name='torrent_id' value='".$torrent['torrent_id']."'><label>".$torrent['name']."</label><br>";
				}
			?>
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
					echo "<input type='checkbox' class='machine-checkboxes' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>

		</div>
	</div>
	</form>
</div>