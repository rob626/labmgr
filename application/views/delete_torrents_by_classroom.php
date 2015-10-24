<div class='large-2 columns'>
	<ul class='side-nav'>
		<li><a href='/labmgr/push_torrents_by_classroom'>Push by Classroom</a></li>
		<li><a href='/labmgr/push_torrents_by_machine'>Push by Machine</a></li>
		<hr>
		<li class='active'><a href='/labmgr/delete_torrents_by_classroom'>Delete by Classroom</a></li>
		<li><a href='/labmgr/delete_torrents_by_machine'>Delete by Machine</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<form method='POST' action='/labmgr/delete_torrents_by_classroom'>
	<div class='row'>
		<div class='small-3 columns'>
		</div>

		<div class='small-3 columns'>
		</div>

		<div class='small-3 columns'>
			<br>
			<input type='submit' class='button large center' value='Delete Torrents'><br>
			
		</div>



		<div class='small-3 columns'>
			<br>
			<label><input type='radio' checked name='delete_option' value='delete_torrent'>Delete Torrent</label>
			<label><input type='radio' name='delete_option' value='delete_torrent_data'>Delete Torrent & Data</label>
			<label><input type='radio' name='delete_option' value='delete_data'>	Delete Data</label>
		</div>

		
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>Torrents</h2>
			<?php
				foreach($torrents as $torrent) {
					//echo "<input type='radio' name='torrent_id' value='".$torrent['torrent_id']."'><label>".$torrent['name']."</label><br>";
					echo "<input type='checkbox' name='torrent_ids[]' value='".$torrent['torrent_id']."'><label>".$torrent['name']."</label><br>";
				}
			?>
		</div>

		<div class='large-6 columns'>
			<h2>Classrooms</h2>
			<?php
				foreach($rooms as $room) {
					echo "<input type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>
	</form>
</div>