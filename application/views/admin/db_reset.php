<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Reset Database:</h3>
				<p>This function creates a backup of the current database and then clears the data.
					<br><br>CONFERENCE Reset: resets all the data necessary to support a new conference.
					So, for example, the rooms, machines, torrents and vms definitions would all be removed.
					But, other data like the labmgr users and scripts would be kept.
					<br><br>FULL DB Reset: (DANGEROUS) clear out all data.
				</p>
			</div>
			<div class='small-4 small-centered columns'>
				<br>
				<a id='db_reset_conference' class='button large center' href='#'>CONFERENCE Reset</a>
			</div>
			<div class='small-4 small-centered columns'>
				<br>
				<a id='db_reset' class='button large center' href='#'>FULL DB Reset</a>
			</div>
		</div>
	</div>
</div>