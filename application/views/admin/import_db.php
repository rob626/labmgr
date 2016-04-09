<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<form method='POST' action='/admin/import_db'>
<div class='large-10 columns'>
	<div class='row'>
		<?php if(!empty($output)) {
			echo "<div data-alert class='alert-box success radius'>
	  ".$output."
	  <a href='#' class='close'>&times;</a></div>";
		} ?>

	<h2>Current Exports</h2>
	<table id='datatable'>
		<thead>
			<tr>
				<th>Select</th>
				<th>Backup File</th>
				<th></th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($current_backups)) {
				foreach($current_backups as $backup) {
					
					echo "<tr>";
					echo "<td><input type='radio' name='backup_filename' value='".$backup."'></td>";
					echo "<td>".$backup."</td>";

					echo "<td><form></form></td>";

					echo "<td><form method='POST' action='/admin/edit_backup'>
					<input type='hidden' name='backup' value='".$backup."'>
					<input type='submit' class='button tiny radius' value='Edit'>
					</form>
					</td>";

					echo "<td><form method='POST' action='/admin/delete_backup'>
					<input type='hidden' name='backup' value='".$backup."'>
					<input type='submit' class='button tiny radius alert' value='Delete'>
					</form>
					</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
	<?php  /*
		echo "<ol>";
		foreach($current_backups as $backup) {
			echo "<input type='radio' name='backup_filename' value='".$backup."'><label>".$backup."</label><br>";

		}
		echo "</ol>";
*/
	?>

	
		<h2>Import Database</h2>
		<input type='submit' value='Import selected DB backup' class='button'>

	</form>
	</div>
</div>