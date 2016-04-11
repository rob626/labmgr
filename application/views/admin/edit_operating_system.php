<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_manage_configs_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Torrent Clients</h1>
	</div>

	<form method='POST' action='/admin/edit_operating_system'>

		<div class='row'>
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
	 	</div>
	</form>
</div>