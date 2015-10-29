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
					<input type='text' name='snapshot' value='clean'>
				</div>
			</div>

			<div class='row'>
				<div class='large-12 columns'>
					<label>Add Multiple (<a href='#' data-reveal-id='script-modal'>Click Here for script to generate proper format.</a>)</label>
					<textarea name='multiple' rows='3'></textarea>
					<br>
				</div>
			</div>


			<div class='row'>
				<div class='large-1 columns'>
					<input type='submit' class='button' value='Submit'>
				</div>
			</form>
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
					<th>Delete</th>
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
						<input type='submit' class='button tiny radius' value='Edit'></form></td>";
						echo "<td><form method='POST' action='/labmgr/delete_vm'>
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
</div>

<div id="script-modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	<h2 id='modalTitle'>Paste me!</h2>
	<div class='panel'>
		<h4>If you have a format like C:\Labs\A001\vm1\worksation.vmx and you want the VM name to be A001-vm1, 
			use the following code:</h4>
		echo off <br>
		dir /s/b *.vmx | findstr /v .vmx. > delete.me<br>
		for /f "tokens=*" %l in (delete.me) do for /f "tokens=1,2,3,4,5,6 delims=\/ " %a in ("%~pl%") do echo %b-%c,%l;<br>
		del delete.me<br>
		echo on<br>
		<br>
		<h4>If you have a format like C:\Labs\A001\vm1\worksation.vmx and you want the VM name to be A001, 
			use the following code:</h4>
		echo off <br>
		dir /s/b *.vmx | findstr /v .vmx. > delete.me<br>
		for /f "tokens=*" %l in (delete.me) do for /f "tokens=1,2,3,4,5,6 delims=\/ " %a in ("%~pl%") do echo %b,%l;<br>
		del delete.me<br>
		echo on<br>
		<br>
		<h4>If you have a format like C:\Labs\A001\vm1\worksation.vmx and you want the VM name to be vm1, 
			use the following code:</h4>
		echo off <br>
		dir /s/b *.vmx | findstr /v .vmx. > delete.me<br>
		for /f "tokens=*" %l in (delete.me) do for /f "tokens=1,2,3,4,5,6 delims=\/ " %a in ("%~pl%") do echo %c,%l;<br>
		del delete.me<br>
		echo on<br>
		<br>
	</div>

	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>