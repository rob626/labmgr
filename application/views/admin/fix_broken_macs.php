<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<form method='POST' action='/admin/fix_macs'>
<div class='large-10 columns'>
	<div class='row'>
		<?php if(!empty($output)) {
			echo "<div data-alert class='alert-box success radius'>
	  ".$output."
	  <a href='#' class='close'>&times;</a></div>";
		} ?>

	<div class='panel'>

		<h2>Fix Missing MAC Addresses</h2>
	
	</div>

	<br>
	<div class="panel callout radius">
		<h4>Fixing missing MAC addresses:</h4>
		<p>To fix missing MAC addresses, the database is queried for missing MAC addresses.  Each of those
			systems is pinged and the resulting MAC address is captured and added to the database.  Initial
			attempt is to look for the MAC address in the local ARP table.  If there is no entry in the ARP
			table, an attempt it made to run a script remotely on the machine to retrieve the MAC address 
			and return it to the server.
			<br><br>The primary reason the MAC address update fails.
			<br>&nbsp &nbsp- The machine is offline
			<br><br>When the Fix button is pressed, the resulting page lists only the machines that were fixed.
		</p>
	</div>
	<br><br>

<?php  
	if($fixing_machines == 0) {
		echo "<h3>About to fix missing MAC addresses:</h3>";
		echo "The following machines appear to have missing MAC addresses.  Click the button below ";
		echo "to attempt to find the correct information.";
		echo "<br><br>";
		$machines = $broken_machines;

		echo "<br><input type='submit' value='Fix missing MAC addresses' class='button'><br><br>";
	} else {
		echo "<h3>Fixed Machines:</h3>";
		$machines = $fixed_machines;
	}
	//print_r($machines);

	if(!empty($machines)) {

		echo "<table id='datatable'>";
		echo "	<thead>";
		echo "		<tr>";
		echo "			<th>Machine ID</th>";
		echo "			<th>Room</th>";
		echo "			<th>Seat</th>";
		echo "			<th>MAC Address</th>";
		echo "			<th>IP Address</th>";
		echo "		</tr>";
		echo "	</thead>";
		echo "<tbody>";
		
		foreach($machines as $machine) {
			echo "<tr>";
			echo "<td>".$machine['machine_id']."</td>";
			foreach($rooms as $room_key => $room_value) {
				if($room_value['room_id'] == $machine['room_id']) {
					echo "<td>". $room_value['name'] ."</td>";
				}
			}
			
			echo "<td>". $machine['seat'] ."</td>";
			echo "<td>". $machine['mac_address'] ."</td>";
			echo "<td>". $machine['ip_address'] ."</td>";

			echo "</tr>";
		}

		echo "	</tbody>";
		echo "</table>";
	} else {
		echo "No machines require fixing";
		echo "<br><br>";
	}

	if($fixing_machines==0) {
		echo "<br><input type='submit' value='Fix missing MAC addresses' class='button'><br><br>";
	} else {
		if(!empty($broken_machines)) {
			echo "<h3>Machines not fixed:</h3>";

			echo "The following machines were not fixed.  Most likely the machine(s) are currently ";
			echo "unreachable.";

			echo "<table id='datatable'>";
			echo "	<thead>";
			echo "		<tr>";
			echo "			<th>Machine ID</th>";
			echo "			<th>Room</th>";
			echo "			<th>Seat</th>";
			echo "			<th>MAC Address</th>";
			echo "			<th>IP Address</th>";
			echo "		</tr>";
			echo "	</thead>";
			echo "<tbody>";

			foreach($broken_machines as $machine) {
				echo "<tr>";
				echo "<td>".$machine['machine_id']."</td>";
				foreach($rooms as $room_key => $room_value) {
					if($room_value['room_id'] == $machine['room_id']) {
						echo "<td>". $room_value['name'] ."</td>";
					}
				}
				
				echo "<td>". $machine['seat'] ."</td>";
				echo "<td>". $machine['mac_address'] ."</td>";
				echo "<td>". $machine['ip_address'] ."</td>";

				echo "</tr>";
			}

			echo "	</tbody>";
			echo "</table>";
		}
	}
 ?>

	</form>
	</div>
</div>