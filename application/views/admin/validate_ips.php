<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='validate_ips_form' action='/admin/validate_ips'>
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
				<div class='row'>
					<div class='small-3 columns'>
						<input type='text' name='from_1'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='from_2'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='from_3'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='from_4'>
					</div>
				</div>
				
				<div class='row'>
					<p>To:</p>
				</div>

				<div class='row'>
					<div class='small-3 columns'>
						<input type='text' name='to_1'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='to_2'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='to_3'>
					</div>
					<div class='small-3 columns'>
						<input type='text' name='to_4'>
					</div>
				</div>
				<input type='submit' class='button large center' value='Make it happen...'>
				
			</div>
		</div>
	</form>
	<div class='row'>
		<div id='validation_results'>
			<h2>Results</h2>
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<form  id='validation_result_form' action='/admin/update_ips'>
				<table id='validation_results_table'>
					<thead>
						<tr>
							<th>Select</th>
							<th>Room</th>
							<th>Seat</th>
							<th>MAC</th>
							<th>Old IP</th>
							<th>New IP</th>
						</tr>
					</thead>
					<tbody>
						<tr></tr>
					</tbody>
				</table>
				<input type='submit' class='button large' value='Update IP(s)'>
			</form>
		</div>
		</div>
	</div>
