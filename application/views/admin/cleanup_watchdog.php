<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Cleanup Watchdog:</h3>
				<p>This function cleans up the watchdog installations on the client machines. 
					<br><br>
				</p>
			</div>
			Pulldown for ALL or specific classroom (forget about machine list... not really needed)
			2 Buttons with descriptsions
			- Cleanup dropins directory (just deletes all entries in the dropins)
			- Full cleanup (removes log file, dropins entries, hasbeenrun entries)
			<div class='small-4 small-centered columns'>
				<br>
				<a id='cleanup_watchdog' class='button large center' href='#'>Make it happen...</a>
			</div>
		</div>
	</div>
</div>