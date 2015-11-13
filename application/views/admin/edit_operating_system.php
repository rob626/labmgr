<div class='panel'>
	<h1>Edit Operating Systems</h1>
</div>

<dl class="sub-nav">
	<dd>
		<a href="/admin">Admin Home</a>
	</dd> 
</dl>
<form method='POST' action='/admin/save_operating_system_edits'>
<table id='datatable'>
	<thead>
		<tr>
			<th>Operating System ID</th>
			<th>Operating System Name</th>
			<th>Operating System Description</th>
		</tr>
	</thead>
	<tbody>

<?php
	foreach($operating_systems as $operating_system) {
		echo "<tr>";
				echo "<td>".$operating_system['os_id']."</td>";
				echo "<td><input type='text' name='os_name' value='".$operating_system['name']."'></td>";
				echo "<td><input type='text' name='os_desc' value='".$operating_system['description']."'></td>";
				echo "</tr>";
	}
?>
</tbody>
</table>
<input type='hidden' name='os_id' value='<?php echo $operating_systems[0]['os_id']; ?>'>
 <div class='row'>
 	<div class="large-1 columns">
 		<input class='button' type='submit' value='Submit'>
 	</div>
 </div>
</form>