<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/add_user'>Add User</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Add User</h1>
	</div>
	<form method='POST' action='/admin/add_user'>

	<div class='row'>
		<div class='large-4 columns'>
			<label>Username</label>
			<input type='text' name='username'>
		</div>

		<div class='large-4 columns'>
			<label>Password</label>
			<input type='password' name='password'>
		</div>

		<div class='large-4 columns'>
			<label>User Role</label>
			<input type='text' name='role'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<label>First Name</label>
			<input type='text' name='first_name'>
		</div>

		<div class='large-6 columns'>
			<label>Last Name</label>
			<input type='text' name='last_name'>
		</div>
	</div>


	<div class='row'>
		<div class="large-1 columns">
	 		<input class='button' type='submit' value='Submit'>
	 	</div>
	</div>

	</form>

<div class='panel'>
	<h1>Existing Users</h1>
</div>

	<table id='datatable'>
		<thead>
			<tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Role</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Create Timestamp</th>
				<th>Last Update Timestamp</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($users)) {
				foreach($users as $user) {
					
					echo "<tr>";
					echo "<td>".$user['user_id']."</td>";
					echo "<td>".$user['username']."</td>";
					echo "<td>".$user['role']."</td>";
					echo "<td>".$user['first_name']."</td>";
					echo "<td>".$user['last_name']."</td>";
					
					echo "<td>".$user['create_timestamp']."</td>";
					echo "<td>".$user['last_update_timestamp']."</td>";
					echo "<td><form method='POST' action='/admin/edit_user'>
					<input type='hidden' name='user_id' value='".$user['user_id']."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form></td>";


					echo "<td><form method='POST' action='/admin/delete_user'>
					<input type='hidden' name='user_id' value='".$user['user_id']."'>
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