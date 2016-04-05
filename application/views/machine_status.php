<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/machine_status'>Machines status</a></li>
		<hr>
		<li><a href='/labmgr/manage_machines'>Manage Machines</a></li>
		<br>
		<br>
	</ul>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>


<div class='large-10 columns'>

		<div class='row'>
		<div class='large-3 columns'>
			<label>Room</label>
				<select id='room_filter_machine_status' name="room_id">
					<option>Select Room</option>
					<option value='-1'>All Rooms</option>
					<?php foreach ($rooms as $room) { ?>
					<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
					<?php } ?>
				</select> 
				<br>
		</div>

		<div class='large-5 columns'>
			<br>
			<a href='#' id='reboot_btn_test' class='button'>Reboot</a>
			<a href='#' id='shutdown_btn' class='button'>Shutdown</a>
			<br>
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>

		</div>
	</div>

		<table id='machine_datatable'>
			<thead>
				<tr>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Host IP address">
						IP Address
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Room the host is in">
						Room
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Seat number assigned to host">
						Seat
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Is the host reachable">
						Ping
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Disk usage percentage on client machine.  Color values: white=0-49%, blue=50-79%, green=80-89%, orange=90=94%, red=>95%">
						Disk<br>Usage
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Number of torrent SEEDS / Number of TOTAL torrents.  5/5 indicates that there are 5 torrents and all are complete/seeding">
						Torrent<br>Seeds
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Format is: &lt% of torrenting completed&gt, @ &ltcurrent speed&gt, &ltGB copied&gt / &ltTotal GB to copy&gt">
						Torrent<br>Sizes (GB)
					</span></th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Total number of Lab Directories in the lab root.">
						Lab<br>Dirs
					</th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Number of VMs running on host.  - means VMware not running, 0 means VMware running with no active VMs.">
						Running<br>VMs
					</th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Connect to host over SSH">
						SSH
					</th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="View the host Watchdog log">
						Watchdog<br>Log
					</th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="View the Web torrent client interface on this host">
						Torrent
					</th>
					<th><span data-tooltip aria-haspopup="true" class="tip-top" title="Select host to Reboot or Shutdown">
						Select
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($machines)) {
					$counter = 1;	
					foreach($machines as $machine) {
						echo "<tr>";
						echo "<td><span style='display:none;' id='machine_ip_".$counter."'>".$machine['ip_address']."</span>
						<span style='display:none;' id='machine_mac_".$counter."'>".$machine['mac_address']."</span>
						<form method='POST' action='/labmgr/edit_machine'>
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
						echo "<td id='disk_usage_".$counter."'><span class='button tiny radius alert-box secondary'>...</span></td>";
						
						echo "</td>";
						echo "<td id='torrent_seeds_".$counter."'>";
							
						echo "</td>";
						
						echo "<td id='torrent_size_".$counter."'>0</td>";

						// echo "<td>". " - " ."</td>";  // Lab Dirs
						echo "<td id='lab_directories_".$counter."'>-";	// Lab Dirs
						echo "</td>";

						echo "<td id='vm_count_".$counter."'> ... ";  // VM count
						echo "</td>";

						//echo "<td><a href='#' id='".$machine['machine_id']."' class='reboot_btn button tiny radius'>Reboot</a></td>";
						/*echo "<td><form method='POST' action='/labmgr/reboot_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Reboot'></form></td>";
						
						echo "<td><form method='POST' action='/labmgr/shutdown_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='Shutdown'></form></td>";
						*/
						echo "<td><form method='POST' action='/labmgr/ssh_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius' value='SSH'></form></td>";
						echo "<td><a class='button tiny radius view_log_btn' id='".$machine['machine_id']."' href='#'>WD Log</a></td>";
						echo "<td><a target='_blank' class='button tiny radius' href='http://admin:web1sphere@".$machine['ip_address'].":27555/gui/'>WebUI</a></td>";

						echo "<td><input class='checkbox' type='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'></td>";/*"<td>
						<form method='POST' action='/labmgr/delete_machine'>
						<input type='hidden' name='machine_id' value='".$machine['machine_id']."'>
						<input type='submit' class='button tiny radius alert' value='Delete'></form>
						</td>";*/
						echo "</tr>";
						$counter++;

					}
					echo "<span id='status_total' style='display:none;'>".$counter."</span>";

				}
				?>

			
			</tbody>
		</table>


</div>

<div id="reboot_modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog"> 
	<div id='reboot_modal_content'>
	</div> 
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>