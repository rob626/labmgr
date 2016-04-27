<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/rooms_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<div class='panel'>
		<h1>Stop all VMs / Reboot all machines - for a room</h1>
	</div>

	<div class='small-8 columns'>
		<div class='row'>
			<table id='datatable'>
				<thead>
					<tr>
						<th>Room</th>
						<th>Stop-all</th>
						<th>Reboot</th>
						<th>Move Mouse</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($rooms)) {
						usort($rooms, function($a, $b) {
						    return strcasecmp(trim($a['name']), trim($b['name']));
						});
						foreach($rooms as $room) {
							
							echo "<tr>";
							echo "<td>".$room['name']."</td>";
							/* echo "<td><form method='POST' id='start_vms_class_form' action='/labmgr/stop_vms_by_classroom'>
							<input type='hidden' name='stop_vm_by_machine' value='1'>
							<input type='hidden' name='stop_all' value='stop_all'>
							<input type='hidden' name='room_ids[]' value='".$room['room_id']."'>
							<input type='submit' class='button tiny radius' value='Stop-all'>
							</form></td>";

							echo "<td><form method='POST' id='reboot_classroom_form' action='reboot_classroom_'>
							<input type='hidden' name='room_ids[]' value='".$room['room_id']."'>
							<input type='submit' class='button tiny radius alert' value='Reboot-all'>
							</form></td>";

							echo "<td><form method='POST' id='mouse_move_classroom_form' action='mouse_move_classroom'>
							<input type='hidden' name='room_ids[]' value='".$room['room_id']."'>
							<input type='submit' class='button tiny radius info' value='Mouse-move'>
							</form></td>"; */
							echo "<td><a class='button tiny radius stop_all_classroom_btn' id='".$room['room_id']."' href='#'>Stop-all</a></td>";
							echo "<td><a class='button tiny radius alert reboot_classroom_btn' id='".$room['room_id']."' href='#'>Reboot-all</a></td>";
							echo "<td><a class='button tiny radius info mouse_move_classroom_btn' id='".$room['room_id']."' href='#'>Mouse-move</a></td>";

							echo "</tr>";
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>	
</div>