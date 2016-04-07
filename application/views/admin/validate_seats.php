<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 


<?php
echo "<pre>";
print_r($seats);
echo "</pre>";
?>
<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Validate seats:</h3>
				<p>This function checks to see if there are any duplicate or missing seats. 
					<br><br>
				</p>
			</div>
			Go through each room in the DB.  Check for 2 things:  <br>
			- duplicate seat numbers<br>
			- missing seats (gaps in the numbers between the min and the max)
			<br><br>
			As output, have a list of classrooms with a list of duplicates and a list of gaps. <br><br>
			Example:<br><br>
			Room 1: <br>
			- Duplicate seats: 4, 8<br>
			- Missing seats:  3, 5, 9
			<div class='small-4 small-centered columns'>
				<br>
				<a id='validate_seats' class='button large center' href='#'>Make it happen...</a>
			</div>
		</div>

		<?php

			foreach($seats as $room_key => $room_value) {
				echo "<h2>Room: ".$room_key."</h2>";
				echo "<p>Missing Seats: ".."</p>";

			}
		?>

	</div>
</div>