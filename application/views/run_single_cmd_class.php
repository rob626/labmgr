<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/scripts_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Run...'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>Run Command</h2>
			
			<label>Command (ex: ls -ltr /cygdrive/c/temp/)</label><input name='cmd' type='text'>
		</div>

		<div class='large-6 columns'>
			<h2>Classrooms</h2>
			<a href='#' id='select_all'>Select All</a>&nbsp &nbsp  <a href='#' id='unselect_all'>Unselect All</a><br>
			<?php
				foreach($rooms as $room) {
					echo "<input class='checkbox' type='checkbox' name='room_ids[]' value='".$room['room_id']."'><label>".$room['name']."</label><br>";
				}
			?>

		</div>
	</div>
	</form>
</div>