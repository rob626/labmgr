<div class='large-2 columns'>
	<ul class='side-nav'>

		<li class='active'><a href='/admin/add_conference'>Manage Conferences</a></li>

	</ul>
</div> 
<div class='large-10 columns'>
	<div class='panel'>
		<h1>Add Conference</h1>
	</div>
	<form method='POST' action='/admin/add_conference'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Conference Name</label>
			<input type='text' name='conference_name'>
		</div>
	</div>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Conference Description</label>
			<textarea rows='3' name='conference_desc'></textarea><br>
		</div>
	</div>

	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>

<div class='panel'>
	<h1>Existing Conferences</h1>
</div>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Conference ID</th>
				<th>Conference Name</th>
				<th>Conference Description</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($conferences)) {
				foreach($conferences as $conference) {
					
					echo "<tr>";
					echo "<td>".$conference['conference_id']."</td>";
					echo "<td>".$conference['name']."</td>";
					echo "<td>".$conference['description']."</td>";
					echo "<td>".$conference['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/admin/edit_conference'>
					<input type='hidden' name='conference_id' value='".$conference['conference_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>

					<form method='POST' action='/admin/delete_conference'>
					<input type='hidden' name='conference_id' value='".$conference['conference_id']."'>
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