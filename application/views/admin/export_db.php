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

	<h2>Current Exports</h2>
	<?php  
		echo "<ol>";
		foreach($current_backups as $backup) {
			echo "<li><a href='/database/backups/".$backup."'>".$backup."</a></li>";
		}
		echo "</ol>";

	?>

	<form method='POST' action='/admin/export_db'>
		<h2>Export Database</h2>
		<label>Filename (optional):</label><input type='text' name='backup_filename' placeholder='labmgr.<current date>.db.sql'>
		<input type='submit' value='Export' class='button'>

	</form>
	</div>
</div>