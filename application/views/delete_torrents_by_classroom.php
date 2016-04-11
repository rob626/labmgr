<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/torrents_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='push_delete_torrents_class_form' action='/labmgr/delete_torrents_by_classroom'>
	<div class='row'>
		<div class='small-6 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Delete Torrents'><br>
			<input type='radio' checked name='delete_option' value='delete_torrent'><label>Delete Torrent</label>
			<input type='radio' name='delete_option' value='delete_torrent_data'><label>Delete Torrent & Data</label>
			<input type='radio' name='delete_option' value='delete_data'><label>Delete Data</label>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>Torrents</h2>
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			
			<?php
				usort($torrents, function($a, $b) {
					    return strcasecmp(trim($a['name']), trim($b['name']));
				});
				foreach($torrents as $torrent) {
					//echo "<input type='radio' name='torrent_id' value='".$torrent['torrent_id']."'><label>".$torrent['name']."</label><br>";
					echo "<input type='checkbox' class='checkbox' name='torrent_ids[]' value='".$torrent['torrent_id']."'><label>".$torrent['name']." - v".$torrent['torrent_version']."</label><br>";
				}
			?>
		</div>

		<div class='large-6 columns'>
			<h2>Classrooms</h2>
			<?php
				usort($rooms, function($a, $b) {
				    return strcasecmp(trim($a['name']), trim($b['name']));
				});
				foreach($rooms as $room) {
					echo "<input type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<br>
			<input type='submit' class='button large center' value='Delete Torrents'>
		</div>
	</div>
	
	</form>
</div>