<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/view_watchdog_log'>View Watchdog Log</a></li>
		<li><a href='/labmgr/'>Validate MAC / IP Mapping</a></li>
		<li><a href='/labmgr/'>Set global defaults</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/labmgr/'>Database Import from Master</a></li>
		<li><a href='/labmgr/'>Database Export</a></li>
		<li><a href='/labmgr/'>Database Import</a></li>
		<hr>
		<li><a href='/labmgr/'>Watchdog dropins cleanup</a></li>
		<li><a href='/labmgr/'>Watchdog full cleanup</a></li>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<div class="panel callout radius">
				<h3>Reset Database:</h3>
				<p>This function creates a backup of the current database and then clears all the data.</p>
			</div>
			<div class='small-4 small-centered columns'>
				<br>
				<a id='db_reset' class='button large center' href='#'>Reset DB</a>
			</div>
		</div>
	</div>
</div>