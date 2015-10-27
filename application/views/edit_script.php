<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/run_single_cmd_class'>Run Single Command by Class</a></li>
		<li><a href='/labmgr/run_single_cmd_machine'>Run Single Command by Machine</a></li>
		<hr>
		<li class='active'><a href='/labmgr/add_script'>Manage Scripts</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Script</h1>
	</div>

	<form method='POST' action='/labmgr/save_script_edits'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Script ID</th>
				<th>Script Name</th>
				<th>Script Description</th>
				<th>Script Path</th>
				<th>Script Parameter</th>
				<th>Script OS</th>
			</tr>
		</thead>
		<tbody>

	<?php
		foreach($scripts as $script) {
			echo "<tr>";
					echo "<td>".$script['script_id']."</td>";
					echo "<td><input type='text' name='script_name' value='".$script['name']."'></td>";
					echo "<td><input type='text' name='script_desc' value='".$script['description']."'></td>";
					echo "<td><input type='text' name='script_path' value='".$script['path']."'></td>";
					echo "<td><input type='text' name='script_parameter' value='".$script['parameter']."'></td>";
					echo "<td><input type='text' name='script_os' value='".$script['os']."'></td>";
					echo "</tr>";
		}
	?>
	</tbody>
	</table>
	<input type='hidden' name='script_id' value='<?php echo $scripts[0]['script_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
	<a href='/labmgr/add_script' class='button'>Cancel</a>
	 </div>
	</form>
</div>