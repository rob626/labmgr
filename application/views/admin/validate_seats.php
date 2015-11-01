<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/set_global_defaults'>Set global defaults</a></li>
		<li><a href='/admin/validate_ips'>Validate MAC / IP Mapping</a></li>
		<li class='active'><a href='/admin/validate_seats'>Validate Seats</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li><a href='/admin/cleanup_watchdog'>Watchdog dropins & full cleanups</a></li>
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
				<h3>Validate seats:</h3>
				<p>This function checks to see if there are any duplicate or missing seats. 
					<br><br>
				</p>
			</div>
			Go through each room in the DB.  Check for 2 things:  <br>
			- duplicate seat numbers<br>
			- missing seats (gaps in the numbers between the min and the max)
			<br><br>
			As output, have a list of classrooms with a list of duplicates and a list of gaps. <br><br>
			Example:<br><br>
			Room 1: <br>
			- Duplicate seats: 4, 8<br>
			- Missing seats:  3, 5, 9
			<div class='small-4 small-centered columns'>
				<br>
				<a id='validate_seats' class='button large center' href='#'>Make it happen...</a>
			</div>
		</div>
	</div>
</div>