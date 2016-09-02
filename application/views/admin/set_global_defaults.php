<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' action='/admin/set_global_defaults'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Set Global Defaults:</h3>
				<p>Set the defaults for the local labmgr envirnment.</p>
			</div>
		</div>

		<div class='row'>
			<div class='panel'>
				<h1>Global Defaults</h1>
			</div>

			<table id='datatable'>
				<thead>
					<tr>
						<th>Default ID</th>
						<th>Name</th>
						<th>Value</th>
						<th>Create Timestamp</th>
						<th>Last Update Timestamp</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($defaults)) {
						foreach($defaults as $default) {
							
							echo "<tr>";
							echo "<td>".$default['default_id']."</td>";
							echo "<td>".$default['name']."</td>";
							echo "<td>".$default['value']."</td>";
							echo "<td>".$default['create_timestamp']."</td>";
							echo "<td>".$default['last_update_timestamp']."</td>";
							echo "<td><form method='POST' action='/admin/edit_default'>
							<input type='hidden' name='default_id' value='".$default['default_id']."'>
							<input type='submit' class='button tiny radius' value='Edit'>
							</form></td>";


							echo "<td><form method='POST' action='/admin/delete_default'>
							<input type='hidden' name='default_id' value='".$default['default_id']."'>
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
	</form>
	</div>
</div>