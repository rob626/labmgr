<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/set_global_defaults'>Set global defaults</a></li>
		<li><a href='/admin/validate_ips'>Validate MAC / IP Mapping</a></li>
		<li><a href='/admin/validate_seats'>Validate Seats</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li class='active'><a href='/admin/cleanup_watchdog'>Watchdog dropins & full cleanups</a></li>
		<hr>
		<li><a href='/admin/reporting_twitter'>Reporting - twitter</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Cleanup Watchdog:</h3>
				<p>This function cleans up the watchdog installations on the client machines. 
					<br><br>
				</p>
			</div>
			Pulldown for ALL or specific classroom (forget about machine list... not really needed)
			2 Buttons with descriptsions
			- Cleanup dropins directory (just deletes all entries in the dropins)
			- Full cleanup (removes log file, dropins entries, hasbeenrun entries)
			<div class='small-4 small-centered columns'>
				<br>
				<a id='cleanup_watchdog' class='button large center' href='#'>Make it happen...</a>
			</div>
		</div>
	</div>
</div>