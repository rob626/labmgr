
	<div class="row">
		<div class='panel'>
			<h1>Add VM</h1>
		</div>
		<form method='POST' action='/labmgr/add_vm'>

			<div class='row'>
				<div class='large-3 columns'>
					<label>Name</label>
					<input type='text' name='name'>
				</div>

				<div class='large-3 columns'>
					<label>Path</label>
					<input type='text' name='path'>
				</div>
				
				<div class='large-3 columns'>
					<label>Hypervisor</label>
					<input type='text' name='hypervisor'>
				</div>

				<div class='large-3 columns'>
					<label>Snapshot</label>
					<input type='text' name='snapshot'>
				</div>
			</div>


			<div class='row'>
				<div class='large-1 columns'>
					<input type='submit' class='button' value='Submit'>
				</div>
			</form>
			</div>
		</div>
	</div>


<div class='panel'>
	<h1>Existing VMs</h1>
</div>
	<div class='large-12 columns'>

		<table id='datatable'>
			<thead>
				<tr>
					<th>vm ID</th>
					<th>Name</th>
					<th>Path</th>
					<th>Hypervisor</th>
					<th>Snapshot</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($vms)) {
					
					foreach($vms as $vm) {
						echo "<tr>";
						echo "<td>".$vm['vm_id']."</td>";
						echo "<td>". $vm['name'] ."</td>";
						echo "<td>". $vm['path'] ."</td>";
						echo "<td>". $vm['hypervisor'] ."</td>";
						echo "<td>".$vm['snapshot']."</td>";

						echo "<td><form method='POST' action='/labmgr/edit_vm'>
						<input type='hidden' name='vm_id' value='".$vm['vm_id']."'>
						<input type='submit' class='button tiny radius' value='Edit'></form>
						<form method='POST' action='/labmgr/delete_vm'>
						<input type='hidden' name='vm_id' value='".$vm['vm_id']."'>
						<input type='submit' class='button tiny radius alert' value='Delete'></form>
						</td>";
						echo "</tr>";
						

					}
				}
				?>

			
			</tbody>
		</table>
		</div>
