<div class='large-2 columns'>
	<ul class='side-nav'>

		<li class='active'><a href='/admin/add_server'>Manage Servers</a></li>

	</ul>
</div> 
<div class='large-10 columns'>
	<div class='panel'>
		<h1>Add server</h1>
	</div>
	<form method='POST' action='/admin/add_server'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>server Name</label>
			<input type='text' name='server_name'>
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>server Description</label>
			<textarea rows='3' name='server_desc'></textarea><br>
		</div>
	</div>

	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>

<div class='panel'>
	<h1>Existing servers</h1>
</div>
	<table id='datatable'>
		<thead>
			<tr>
				<th>server ID</th>
				<th>server Name</th>
				<th>server Description</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($servers)) {
				foreach($servers as $server) {
					
					echo "<tr>";
					echo "<td>".$server['server_id']."</td>";
					echo "<td>".$server['name']."</td>";
					echo "<td>".$server['description']."</td>";
					echo "<td>".$server['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/admin/edit_server'>
					<input type='hidden' name='server_id' value='".$server['server_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>

					<form method='POST' action='/admin/delete_server'>
					<input type='hidden' name='server_id' value='".$server['server_id']."'>
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