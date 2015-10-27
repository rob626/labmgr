<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/start_vms_by_classroom'>Start by Classroom</a></li>
		<li><a href='/labmgr/start_vms_by_machine'>Start by Machine</a></li>
		<hr>
		<li><a href='/labmgr/stop_vms_by_classroom'>Stop by Classroom</a></li>
		<li><a href='/labmgr/stop_vms_by_machine'>Stop by Machine</a></li>
		<hr>
		<li class='active'><a href='/labmgr/add_vm'>Manage VMs</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit vm</h1>
	</div>

	<form method='POST' action='/labmgr/save_vm_edits'>
	<table id='datatable'>
		<thead>
			<tr>
				<th>VM ID</th>
				<th>VM Name</th>
				<th>VM Path</th>
				<th>VM Hypervisor</th>
				<th>VM Snapshot</th>
			</tr>
		</thead>
		<tbody>

	<?php
		foreach($vms as $vm) {
			echo "<tr>";
					echo "<td>".$vm['vm_id']."</td>";
					echo "<td><input type='text' name='vm_name' value='".$vm['name']."'></td>";
					echo "<td><input type='text' name='vm_path' value='".$vm['path']."'></td>";
					echo "<td><input type='text' name='vm_hypervisor' value='".$vm['hypervisor']."'></td>";
					echo "<td><input type='text' name='vm_snapshot' value='".$vm['snapshot']."'></td>";
					echo "</tr>";
		}
	?>
	</tbody>
	</table>
	<input type='hidden' name='vm_id' value='<?php echo $vms[0]['vm_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
		<a href='/labmgr/add_vm' class='button'>Cancel</a>
	 </div>
	</form>
</div>