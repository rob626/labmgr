<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_manage_configs_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Add Operating System</h1>
	</div>
	<form method='POST' action='/admin/add_operating_system'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Operating System Name</label>
			<input type='text' name='os_name'>
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Operating System Description</label>
			<textarea rows='3' name='os_desc'></textarea><br>
		</div>
	</div>

	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>

	<div class='row'>
		<div class='panel'>
			<h1>Existing Operating Systems</h1>
		</div>
			<table id='datatable'>
				<thead>
					<tr>
						<th>Operating System ID</th>
						<th>Operating System Name</th>
						<th>Operating System Description</th>
						<th>Last Update Timestamp</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($operating_systems)) {
						foreach($operating_systems as $operating_system) {
							
							echo "<tr>";
							echo "<td>".$operating_system['os_id']."</td>";
							echo "<td>".$operating_system['name']."</td>";
							echo "<td>".$operating_system['description']."</td>";
							echo "<td>".$operating_system['last_update_timestamp']."</td>";
							echo "<td><form method='POST' action='/admin/edit_operating_system'>
							<input type='hidden' name='os_id' value='".$operating_system['os_id']."'>
							<input type='submit' class='button tiny radius' value='Edit'>
							</form>

							<form method='POST' action='/admin/delete_operating_system'>
							<input type='hidden' name='os_id' value='".$operating_system['os_id']."'>
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
</div>