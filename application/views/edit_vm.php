<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/vms_left_nav'); ?>
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