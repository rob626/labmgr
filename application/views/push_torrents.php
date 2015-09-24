<form method='POST' action='/welcome/push_torrents_by_classroom'>
<div class='row'>
	<div class='small-4 small-centered columns'>
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
		<h2>Class Rooms</h2>
		<?php
			foreach($rooms as $room) {
				echo "<input type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
			}
		?>

	</div>
</div>

</form>