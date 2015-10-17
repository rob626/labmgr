<div class='large-2 columns'>
	<ul class='side-nav'>
		<li><a href='/labmgr/add_machine'>Add Machine</a></li>
		<li><a href='/labmgr/add_room'>Manage Rooms</a></li>
		<li><a href='/labmgr/manage_machines'>Manage Machines</a></li>
		<li class='active'><a href='/labmgr/upload_torrent'>Manage Torrents</a></li>
		<li><a href='/labmgr/add_vm'>Manage VMs</a></li>
		<li><a href='/labmgr/add_script'>Manage Scripts</a></li>
	</ul>
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