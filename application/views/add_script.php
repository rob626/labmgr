
	<div class='panel'>
		<h1>Add script</h1>
	</div>
	<form method='POST' action='/labmgr/add_script'>

	<div class='row'>
		<div class='large-6 columns'>
			<label>Script Name</label>
			<input type='text' name='script_name'>
		</div>

		<div class='large-6 columns'>
			<label>Script Description</label>
			<textarea name='script_desc'></textarea>
		</div>
	</div>


	<div class='row'>
		<div class='large-4 columns'>
			<label>Script Path</label>
			<input type='text' name='script_path'>
		</div>

		<div class='large-4 columns'>
			<label>Script Parameter</label>
			<input type='text' name='script_parameter'>
		</div>

		<div class='large-4 columns'>
			<label>Script OS</label>
			<input type='text' name='script_os'>
		</div>
	</div>

	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>
</div>

<div class='panel'>
	<h1>Existing Scripts</h1>
</div>
<div class='row'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Script ID</th>
				<th>Script Name</th>
				<th>Script Description</th>
				<th>Script Path</th>
				<th>Script Parameter</th>
				<th>Script OS</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($scripts)) {
				foreach($scripts as $script) {
					
					echo "<tr>";
					echo "<td>".$script['script_id']."</td>";
					echo "<td>".$script['name']."</td>";
					echo "<td>".$script['description']."</td>";
					echo "<td>".$script['path']."</td>";
					echo "<td>".$script['parameter']."</td>";
					echo "<td>".$script['os']."</td>";
					echo "<td>".$script['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/labmgr/edit_script'>
					<input type='hidden' name='script_id' value='".$script['script_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>

					<form method='POST' action='/labmgr/delete_script'>
					<input type='hidden' name='script_id' value='".$script['script_id']."'>
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