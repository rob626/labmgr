<div class='large-2 columns side-nav-color'>
	<ul class='side-nav'>
		<li class='active'><a href='/labmgr/run_single_cmd_class'>Run Single Command by Class</a></li>
		<li><a href='/labmgr/run_single_cmd_machine'>Run Single Command by Machine</a></li>
		<hr>
		<li><a href='/labmgr/add_script'>Manage Scripts</a></li>
	</ul>
</div>


<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action=''>
	<div class='row'>
		<div class='small-4 small-centered columns'>
			<br>
			<input type='submit' class='button large center' value='Run'>
		</div>
	</div>

	<div class='row'>
		<div class='large-6 columns'>
			<h2>Run Command (ex: ls -ltr)</h2>
			
			<label>Command</label><input name='cmd' type='text'>
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