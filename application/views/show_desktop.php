<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/machines_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='show_desktop_class_form' action='/'>
	<div class='row'>
		<div class='small-12 small-centered columns'>
			<h1>Clear all windows and Show Desktop</h1>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>

		<div class='large-12 columns'>
			<h4>Classrooms</h4>
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<?php
				usort($rooms, function($a, $b) {
					return strcasecmp(trim($a['name']), trim($b['name']));
				});
				foreach($rooms as $room) {
					echo "<input class='checkbox' type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>
	</form>
</div>