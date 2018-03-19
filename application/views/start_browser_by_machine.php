<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/url_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='start_browser_form' action=''>


	<div class='row'>
		<div class='large-6 columns'>
			<h2>Open Browser by Machines</h2>
			
			<input type='radio' name='browser_id' value='chrome'>Chrome
			<input type='radio' name='browser_id' value='firefox'>Firefox
			<input type='radio' name='browser_id' value='iexplore'>IE
			<input type='radio' name='browser_id' value='cleanbrowser' checked>Start up URL
			<input type='radio' name='cleanupbrowser' value='cleanupbrowser'>KILL ALL BROWSERS

			<label>URL Suffix<input type='text' name='url_suffix' value="<?php echo $default_url_suffix ?>"></label>
			
			<label>Use URL Suffix?</label>
				<input type='radio' name='use_suffix' value='yes' checked> Yes
				<input type='radio' name='use_suffix' value='no'> No
			
			<br>
			<input type='submit' class='button large center' value='Make it so...'>

			<table id='datatable3'>
				<thead>
					<tr>
						<th>Select</th>
						<th>Name</th>
						<th>URL</th>
					</tr>
				</thead>
				<tbody>

				<?php
					usort($urls, function($a, $b) {
					    return strcasecmp(trim($a['name']), trim($b['name']));
					});
					foreach($urls as $url) {
						echo "<tr>";
						echo "<td><input type='radio' name='url_id' value='".$url['url_id']."'></td>";
						echo "<td>";
						echo $url['name'];
						echo "</td>";
						echo "<td>".$url['path']."</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
		</div>

		<div class='large-6 columns'>
			<h2>Machines</h2>
			<label>Show by Room</label>
				<select id='room_filter' name="room_id">
					<option value='-1'>All Rooms</option>
					<?php 
					usort($rooms, function($a, $b) {
						return strcasecmp(trim($a['name']), trim($b['name']));
					});
					foreach ($rooms as $room) { ?>
					<option value='<?php echo $room['room_id'] ?>'><?php echo $room['name'] ?> </option>
					<?php } ?>
				</select> 
		
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<div id='machine_list'>
			<?php
				usort($machines, function($a, $b) {
					$room_a=$this->room_model->get_room($a['room_id']);
					$room_a_name=$room_a[0]['name'];
					$room_b=$this->room_model->get_room($b['room_id']);
					$room_b_name=$room_b[0]['name'];

				    $name = strcmp(trim($room_a_name), trim($room_b_name));
				    if($name === 0) {
				        return $a['seat'] - $b['seat'];
				    }
				    return $name;
				});

				foreach($machines as $machine) {
					$room=$this->room_model->get_room($machine['room_id']);
					$r=$room[0]['name'];
					echo "<input type='checkbox' class='checkbox' name='machine_ids[]' value='".$machine['machine_id']."'><label>Seat: ".$machine['seat']. ' - room: '. $r . ' ('.$machine['ip_address'].")</label><br>";
				}
			?>
			</div>

		</div>

	</div>
	
	<div class='row'>
		<div class='large-6 columns'>
			<br><br>
			<input type='submit' class='button large center' value='Make it so...'>
		</div>
	</div>
	
	</form>
</div>
