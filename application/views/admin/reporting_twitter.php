<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Reporting - twitter:</h3>
				<p>This function Allows you to enabke/disable status reporting to twitter.
					<br><br>Use crontab -e to update the crontab for websrvr (update the path to point at the labmgr root directory):
					<br><br>&nbsp &nbsp*/10 * * * * cd /home/robert/labmgr/; php index.php login tester >> ˜/twitter.log
				</p>
			</div>
			Include 2 inputs - twitter address and interval.<br><br>
			Also include an explination of the twitter data format.

			<div class='panel'>
				Current Status: <?php if($enabled) { echo "<span class='success label'>Enabled</span>"; } else { echo "<span class='alert label'>Disabled</span>"; } ?>
			</div>

			<div class='small-4 small-centered columns'>
				<br>
				<a id='validate_ips' class='button large center' href='#'>Make it happen...</a>
			</div>
		</div>
	</div>
</div>