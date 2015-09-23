<div class='panel'>
		<h1>Upload Torrent</h1>
</div>
<?php
	echo form_open_multipart('welcome/do_upload');
	echo "<input type='file' name='torrent_file'>";
	echo "<input type='submit' value='Upload'>";
	echo "</form>";

?>

<div class='panel'>
	<h1>Existing Torrents</h1>
</div>
<div class='row'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Torrent ID</th>
				<th>Torrent Name</th>
				<th>Torrent Path</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($torrents)) {
				foreach($torrents as $torrent) {
					
					echo "<tr>";
					echo "<td>".$torrent['torrent_id']."</td>";
					echo "<td>".$torrent['name']."</td>";
					echo "<td>".$torrent['path']."</td>";
					echo "<td>".$torrent['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/welcome/edit_torrent'>
					<input type='hidden' name='torrent_id' value='".$torrent['torrent_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>

					<form method='POST' action='/welcome/delete_torrent'>
					<input type='hidden' name='torrent_id' value='".$torrent['torrent_id']."'>
					<input type='submit' class='button tiny radius alert' value='Delete'>
					</form>
					</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>