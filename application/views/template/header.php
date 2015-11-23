<!DOCTYPE html>
<meta charset="UTF-8"> 
 <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> 
<html lang='en'>
<head>
	<!-- javascript -->
	<script src='/js/jquery-1.10.2.min.js'></script>
	<script src='/js/jquery-ui.js'></script>
	<script src='/js/foundation.min.js'></script>
	<script src='/js/jquery-ui-timepicker-addon.js'></script>
	<script src='/js/ckeditor/ckeditor.js'></script>
	<script src='/js/jquery.dataTables.min.js'></script>
	<script src='/js/jquery.ui.widget.js'></script>
	<script src='/js/jquery.iframe-transport.js'></script>
	<script src='/js/jquery.fileupload.js'></script>
	<script src='/js/modernizr.js'></script>
	<script src='/js/app.js'></script>

	<!-- stylesheets -->
	<link rel='stylesheet' href='/css/jquery-ui.css' />
	<link rel='stylesheet' href='/css/jquery-ui-timepicker-addon.css' />
	<link rel='stylesheet' href='/css/foundation.min.css' />
	<link rel='stylesheet' href='/css/normalize.css' />
	<link rel='stylesheet' href='/css/dataTables.jqueryui.css' />
	<link rel='stylesheet' href='/css/jquery.fileupload.css' />
	<link rel='stylesheet' href='/css/app.css' />
	
	<title>IBM - Lab Manager</title>


</head>

<nav class='top-bar' data-topbar role='navigation'>
	<ul class='title-area'>
		<li class='name'>
			<h1><a href='/labmgr'>LabMgr</a></h1>
		</li>
	</ul>
	<section class='top-bar-section'>
		<?php if($this->authentication->logged_in()) {

		 ?>
		<ul class='left'>
			<li><a href='/labmgr/register_machine'>Register Machine</a></li>				
			<li><a href='/labmgr/add_room'>Rooms</a></li>
			<li><a href='/labmgr/machine_status'>Machines</a></li>
			<li><a href='/labmgr/start_session_by_classroom'>Sessions</a></li>			
			<li><a href='/labmgr/push_torrents_by_classroom'>Torrents</a></li>
			<li><a href='/labmgr/start_vms_by_classroom'>VMs</a></li>
			<li><a href='/labmgr/run_single_cmd_class'>Scripts</a></li>
			<li><a href='/admin'>Admin</a></li>
		</ul>

		<ul class='right'>
			<li class='active'><a href='#'>Server Name / ID</a></li>
		</ul>
		<?php } else { ?>
			<ul class='left'>
				<li><a href='/login'>Please Login</a></li>
			</ul>
		<?php } ?>
	</section>
</nav>

