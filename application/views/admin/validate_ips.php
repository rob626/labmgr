<div class='large-2 columns  side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/admin/set_global_defaults'>Set global defaults</a></li>
		<li class='active'><a href='/admin/validate_ips'>Validate MAC / IP Mapping</a></li>
		<li><a href='/admin/validate_seats'>Validate Seats</a></li>
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
	<form method='POST' id='validate_mac_form' action='/labmgr/validate_mac'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Validate IPs:</h3>
				<p>This function looks at the MAC addresses in the database and checks to see if they are still mapped
					to the IP addresses in the DB. 
					<br><br>
					By using this operation, you can see if any IP addresses have changed since the machines were registered.
				</p>
			</div>
			Enter a subnet mask (default to 255.255.255.0) and ping every IP address.  That will load the MAC address into 
			the arp table.  After each ping, check to see if that MAC address is in the DB (since the ARP table has a limit, so
			pinging all at once and then checking might not work).  If the MAC is in the DB, see if the IP address is the same.
			<br><br>
			As output, only display those that do NOT match.  Next to one in the list, have a check box.  At the buttom, have a 
			button that says "Update selected IP addresses"
			<div class='small-4 small-centered columns'>
				<br>
				<input type='submit' class='button large center' value='Make it happen...'>
				
			</div>
		</div>
	</form>
	</div>
</div>