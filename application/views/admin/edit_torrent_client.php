<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_manage_configs_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Torrent Clients</h1>
	</div>

	<form method='POST' action='/admin/save_torrent_client_edits'>

		<div class='row'>
			<table id='datatable'>
				<thead>
					<tr>
						<th>torrent_client ID</th>
						<th>torrent_client Name</th>
						<th>torrent_client Description</th>
					</tr>
				</thead>
				<tbody>

					<?php
						foreach($torrent_clients as $torrent_client) {
							echo "<tr>";
									echo "<td>".$torrent_client['torrent_client_id']."</td>";
									echo "<td><input type='text' name='torrent_client_name' value='".$torrent_client['name']."'></td>";
									echo "<td><input type='text' name='torrent_client_desc' value='".$torrent_client['description']."'></td>";
									echo "</tr>";
						}
					?>
				</tbody>
			</table>

			<input type='hidden' name='torrent_client_id' value='<?php echo $torrent_clients[0]['torrent_client_id']; ?>'>
 			<div class='row'>
 				<div class="large-1 columns">
 					<input class='button' type='submit' value='Submit'>
 				</div>
 			</div>
		</div>
	</form>
</div>