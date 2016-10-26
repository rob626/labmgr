<div class='large-2 columns side-nav-color'>
	<?php $this->load->view('template/rooms_left_nav'); ?>
</div>


<div class='large-10 columns'>
	<form method='POST' id='bg_info_update_class_form' action='/'>
	<div class='row'>
		<div class='small-12 small-centered columns'>
			<h1>Update BGinfo</h1>
			<input type='hidden' name='cmd' value='cp /cygdrive/c/ProgramData/Microsoft/Windows/Start\ Menu/Programs/Startup/bginfo-labmgr.bat /cygdrive/c/labmgr-wd/dropins/';>
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