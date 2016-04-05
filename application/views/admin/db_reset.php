<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Reset Database:</h3>
				<p>This function creates a backup of the current database and then clears all the data.</p>
			</div>
			<div class='small-4 small-centered columns'>
				<br>
				<a id='db_reset' class='button large center' href='#'>Reset DB</a>
			</div>
		</div>
	</div>
</div>