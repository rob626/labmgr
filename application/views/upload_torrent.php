<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/push_torrents_by_classroom'>Push by Classroom</a></li>
		<li><a href='/labmgr/push_torrents_by_machine'>Push by Machine</a></li>
		<hr>
		<li><a href='/labmgr/delete_torrents_by_classroom'>Delete by Classroom</a></li>
		<li><a href='/labmgr/delete_torrents_by_machine'>Delete by Machine</a></li>
		<hr>
		<li class='active'><a href='/labmgr/upload_torrent'>Manage Torrents</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div class='large-10 columns'>
	<?php if(!empty($status)) {
		echo "<div data-alert class='alert-box success radius'>
  Upload Successful
  <a href='#' class='close'>&times;</a></div>";
	} ?>
	
<div class='panel'>
		<h1>Upload Torrent</h1>
</div>

<?php
	echo form_open_multipart('labmgr/do_upload');
	echo "<input type='file' name='torrent_file'>";
	//echo "<label>Hash: </label><input name='hash' type='text'>";
	echo "<input type='submit' class='button' value='Upload'>";
	echo "</form>";

?>
<br>

<div class='panel'>
	<h1>Torrents Uploaded to Server</h1>
</div>
<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
<?php
	echo form_open_multipart('labmgr/process_uploaded_torrents');
	foreach($uploaded_torrents as $torrent) {
		echo "<input type='checkbox' class='checkbox' name='torrents[]' value='".$torrent."'><label>".$torrent."</label><br>";
	}
	echo "<input type='submit' class='button' value='Submit'>";
	echo "</form>";
?>


<div class='panel'>
	<h1>Existing Torrents</h1>
</div>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Torrent<br>ID</th>
				<th>Torrent<br>Name</th>
				<th>Torrent<br>Hash</th>
				<th>Torrent<br>Path</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($torrents)) {
				foreach($torrents as $torrent) {
					
					echo "<tr>";
					echo "<td>".$torrent['torrent_id']."</td>";
					echo "<td>".$torrent['name']."</td>";
					echo "<td>".substr($torrent['hash'],0,4)."...</td>";
					echo "<td>".$torrent['path']."</td>";
					echo "<td><form method='POST' action='/labmgr/edit_torrent'>
					<input type='hidden' name='torrent_id' value='".$torrent['torrent_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form></td>";

					echo "<td><form method='POST' action='/labmgr/delete_torrent'>
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