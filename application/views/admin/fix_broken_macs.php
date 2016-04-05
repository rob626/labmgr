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

	<h2>Fix Missing MAC Addresses</h2>
	<?php  

		if(!empty($fixed_machines)) {
			echo "<h3>Fixed Machines:</h3>";
			echo "<pre>";
			//print_r($fixed_machines);
			$machines = $fixed_machines;	
			echo "</pre>";		
		} elseif(!empty($broken_machines)) {	
			echo "<pre>";
			//print_r($broken_machines);	
			$machines = $broken_machines;
			echo "</pre>";
		} ?>

		<table id='datatable'>
			<thead>
				<tr>
					<th>Machine ID</th>
					<th>Room</th>
					<th>Seat</th>
					<th>MAC Address</th>
					<th>IP Address</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($machines)) {
					
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
				}
				?>

			
			</tbody>
		</table>

	
	<input type='submit' value='Fix' class='button'>

	</form>
	</div>
</div>