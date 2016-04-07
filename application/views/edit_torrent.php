<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/torrents_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<div class='panel'>
		<h1>Manage Torrents</h1>
	</div>

	<form method='POST' action='/labmgr/save_torrent_edits'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Torrent ID</th>
				<th>Torrent Name</th>
				<th>Torrent Hash</th>
				<th>Torrent Path</th>
			</tr>
		</thead>
		<tbody>

	<?php
		foreach($torrents as $torrent) {
			echo "<tr>";
					echo "<td>".$torrent['torrent_id']."</td>";
					echo "<td><input type='text' name='torrent_name' value='".$torrent['name']."'></td>";
					echo "<td><input type='text' name='torrent_hash' value='".$torrent['hash']."'></td>";
					echo "<td><input type='text' name='torrent_path' value='".$torrent['path']."'></td>";
					echo "</tr>";
		}
	?>
	</tbody>
	</table>
	<input type='hidden' name='torrent_id' value='<?php echo $torrents[0]['torrent_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
	<a href='/labmgr/upload_torrent' class='button'>Cancel</a>
	 </div>
	</form>
</div>