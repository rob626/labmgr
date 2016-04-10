<div class='large-2 columns  side-nav-color'>
	<?php $this->load->view('template/admin_left_nav'); ?>
</div> 

<div class='large-10 columns'>
	<form method='POST' id='run_single_cmd_class_form' action='/labmgr/run_single_cmd_class'>
		<div class='row'>
			<br>
			<div class="panel callout radius">
				<h3>Ticket system:</h3>
				<p>This is a place holder to include a ticket system.  This system will allow
					the labmgr administrators to create and manage tickets for a conference delivery.
					<br><br>For example, if an update is needed for a lab session, a ticket could be
					created to track this requirement and then assigned to someone.  The administrators
					could then track what is outstanding and what has been completed.
					<br><br>Features to include: create ticket (title, description, state [new, complete, 
					archived], priotrity, catagoty/area [Torrent-push, Update, network, feature-request, 
					other]), assign person, mark as done, delete, archive, etc.
				</p>
			</div>
		</div>
	</div>
</div>