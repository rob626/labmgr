<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_manage_configs_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Add Torrent Client</h1>
	</div>

	<form method='POST' action='/admin/add_torrent_client'>

		<div class='row'>
			<div class='large-4 columns'>
				<label>Torrent Client Name</label>
				<input type='text' name='torrent_client_name'>
			</div>
		</div>

		<div class='row'>
			<div class='large-4 columns'>
				<label>Torrent Client Description</label>
				<textarea rows='3' name='torrent_client_desc'></textarea><br>
			</div>
		</div>

		<div class='row'>
			<div class="large-1 columns">
		 		<input class='button' type='submit' value='Submit'>
		 	</div>
		</div>

	</form>

	<div class='panel'>
		<h1>Existing Torrent Clients</h1>
	</div>

	<div class='row'>
		<table id='datatable'>
			<thead>
				<tr>
					<th>Torrent Client ID</th>
					<th>Torrent Client Name</th>
					<th>Torrent Client Description</th>
					<th>Last Update Timestamp</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($torrent_clients)) {
					foreach($torrent_clients as $torrent_client) {
						
						echo "<tr>";
						echo "<td>".$torrent_client['torrent_client_id']."</td>";
						echo "<td>".$torrent_client['name']."</td>";
						echo "<td>".$torrent_client['description']."</td>";
						echo "<td>".$torrent_client['last_update_timestamp']."</td>";
						echo "<td><form method='POST' action='/admin/edit_torrent_client'>
						<input type='hidden' name='torrent_client_id' value='".$torrent_client['torrent_client_id']."'>
						<input type='submit' class='button tiny radius' value='Edit'>
						</form>

						<form method='POST' action='/admin/delete_torrent_client'>
						<input type='hidden' name='torrent_client_id' value='".$torrent_client['torrent_client_id']."'>
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
</div>