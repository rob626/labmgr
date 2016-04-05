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
	<?php  
		echo "<ol>";
		foreach($current_backups as $backup) {
			echo "<input type='radio' name='backup_filename' value='".$backup."'><label>".$backup."</label><br>";

		}
		echo "</ol>";

	?>

	
		<h2>Import Database</h2>
		<input type='submit' value='Import' class='button'>

	</form>
	</div>
</div>