<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/view_watchdog_log'>View Watchdog Log</a></li>
		<li><a href='/labmgr/'>Validate MAC / IP Mapping</a></li>
		<li><a href='/labmgr/'>Set global defaults</a></li>
		<hr>
		<li><a id='db_reset' href='#'>Database Reset</a></li>
		<li><a href='/labmgr/'>Database Import from Master</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li class='active'><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li><a href='/labmgr/'>Watchdog dropins cleanup</a></li>
		<li><a href='/labmgr/'>Watchdog full cleanup</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 

<div class='large-10 columns'>
	<div class='row'>
		<?php print_r($output);if(!empty($output)) {
			echo "<div data-alert class='alert-box success radius'>
	  ".$output." Created
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

	<form method='POST' action='/admin/import_db'>
		<h2>Import Database</h2>
		<input type='submit' value='Import' class='button'>

	</form>
	</div>
</div>