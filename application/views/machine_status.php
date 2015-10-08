<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li><a href='/labmgr/machine_status'>View Machines (ping)</a></li>
		<li><a href='/labmgr/'>View Machines (torrent)</a></li>
		<li><a href='/labmgr/'>View Machines (vm data)</a></li>
		<li><a href='/labmgr/'>Validate MAC / IP Mapping</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<div class='row'>
		<div class='large-3 columns'>
			<label>Room</label>
				<select id='room_filter' name="room_id">
					<option value='-1'>All Rooms</option>
					<?php foreach ($rooms as $room) { ?>
					<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
					<?php } ?>
				</select> 
		</div>

		<table id='datatable'>
			<thead>
				<tr>
					<th>IP Address</th>
					<th>Room</th>
					<th>Seat</th>
					<th>Ping</th>
					<th>Reboot</th>
					<th>Shutdown</th>
					<th>SSH</th>
					<th>Torrent</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($machines)) {
					$counter = 1;
					foreach($machines as $machine) {
						echo "<tr>";
						echo "<td><span style='display:none;' id='machine_ip_".$counter."'>".$machine['ip_address']."</span><form method='POST' action='/labmgr/edit_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='".$machine['ip_address']."'></form></td>";

						foreach($rooms as $room_key => $room_value) {
							if($room_value['room_id'] == $machine['room_id']) {
								echo "<td>". $room_value['name'] ."</td>";
							} else {
								//echo "<td></td>";
							}
						}
						echo "<td>". $machine['seat'] ."</td>";

						echo "<td id='status_".$counter."'><span class='button tiny radius alert-box secondary'>...</span></td>";
						
						echo "<td><a href='#' id='".$machine['machine_id']."' class='reboot_btn button tiny radius'>Reboot</a></td>";
						/*echo "<td><form method='POST' action='/labmgr/reboot_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Reboot'></form></td>";
						*/
						echo "<td><form method='POST' action='/labmgr/shutdown_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Shutdown'></form></td>";

						echo "<td><form method='POST' action='/labmgr/ssh_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='SSH'></form></td>";

						echo "<td><a target='_blank' class='button tiny radius' href='http://".$machine['ip_address'].":27555/gui/'>Web View</a></td>";

						echo "<td>
						<form method='POST' action='/labmgr/delete_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius alert' value='Delete'></form>
						</td>";
						echo "</tr>";
						$counter++;

					}
					echo "<span id='status_total' style='display:none;'>".$counter."</span>";

				}
				?>

			
			</tbody>
		</table>

	</div>
</div>

<div id="reboot_modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog"> 
	<div id='reboot_modal_content'>
	</div> 
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>