<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>View log file:</h3>
				<p>The current implimentation of viewing the log file is limited to connecting
					to the labmgr server via ssh and tailing the log file.
					<br><br> The log file can be found:
					<br><br>&nbsp &nbsp tail -f ./labmgr/logs/labmgr-YYYY-MM-DD.log</p>
			</div>
\
		</div>
	</div>
</div>