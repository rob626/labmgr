<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_manage_configs_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Edit Backup</h1>
	</div>

	<form method='POST' action='/admin/save_edit_backup'>

		<div class='row'>
			
			<label>Backup File:</label>
			<input type='text' name='new_backup_file' value="<?php echo $backup_file; ?>">
			<input type='hidden' name='old_backup_file' value="<?php echo $backup_file; ?>">
			<div class='row'>
			 	<div class="large-1 columns">
			 		<input class='button' type='submit' value='Submit'>
			 	</div>
		 	</div>
	 	</div>
	</form>
</div>