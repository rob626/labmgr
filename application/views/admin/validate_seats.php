<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<!--
<?php
echo "<pre>";
print_r($seats);
echo "</pre>";
?>
-->


<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Validate seats:</h3>
				<p>This function checks to see if there are any duplicate or missing seats. 
				</p>
			</div>
		</div>
		<br>
		<?php

			foreach($seats as $room_key => $room_value) {
				echo "<h3>Room: ".$room_key."</h3>";

				echo "<p>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Missing Seats: ";
				foreach($room_value['missing_seats'] as $missing_seat) echo	$missing_seat." ";
				echo "<br>";

				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Duplicate Seats: ";
				foreach($room_value['duplicates'] as $duplicate_seat) echo	$duplicate_seat." ";
				echo "</p>";
			}
		?>

	</div>
</div>