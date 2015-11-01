<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/set_global_defaults'>Set global defaults</a></li>
		<li><a href='/admin/validate_ips'>Validate MAC / IP Mapping</a></li>
		<li><a href='/admin/validate_seats'>Validate Seats</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li class='active'><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li><a href='/admin/cleanup_watchdog'>Watchdog dropins & full cleanups</a></li>
		<hr>
		<li><a href='/admin/reporting_twitter'>Reporting - twitter</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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