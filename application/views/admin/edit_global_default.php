<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Global Default</h1>
	</div>

	<form method='POST' action='/admin/save_global_default_edits'>
	<table id='datatable'>
		<thead>a
			<tr>
				<th>global default ID</th>
				<th>global default Name</th>
				<th>global default Value</th>
			</tr>
		</thead>
		<tbody>

	<?php
		foreach($defaults as $default) {
			echo "<tr>";
					echo "<td>".$default['default_id']."</td>";
					echo "<td><input type='text' name='name' value='".$default['name']."'></td>";
					echo "<td><input type='text' name='value' value='".$default['value']."'></td>";
			echo "</tr>";
		}
	?>
	</tbody>
	</table>
	<input type='hidden' name='global_default_id' value='<?php echo $defaults[0]['global_default_id']; ?>'>
	<input class='button' type='submit' value='Submit'>
	<a href='/labmgr/set_global_default' class='button'>Cancel</a>
	 </div>
	</form>
</div>