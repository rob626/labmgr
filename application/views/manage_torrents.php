<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/torrents_left_nav'); ?>
</div>

<div class='panel'>
	<h1>Existing Torrents</h1>
</div>

<div class='large-10 columns'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Torrent<br>ID</th>
				<th>Torrent<br>Name</th>
				<th>Torrent<br>Version</th>
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
					echo "<td>".$torrent['torrent_version']."</td>";
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