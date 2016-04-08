<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='row'>
		<?php if(!empty($output)) {
			echo "<div data-alert class='alert-box success radius'>
	  ".$output." Created
	  <a href='#' class='close'>&times;</a></div>";
		} ?>

	<form method='POST' action='/admin/export_db'>
		<h2>Export Database</h2>
		<label>Filename: </label><input type='text' name='backup_filename' value='labmgr.<?php echo date("Y-m-d_H:i:s");?>.db.sql'>
		<input type='submit' value='Export' class='button'>

	</form>

	<p><br><br>To view a list of available backups, go to the Database Import/Manage page</p>

	</div>
</div>