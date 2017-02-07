<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Start by Classroom',   'link' => '/labmgr/start_vms_by_classroom', 'spacer' => ''),
			1 => array(
				'text' => 'Start by Machine',     'link' => '/labmgr/start_vms_by_machine',   'spacer' => '<hr>'),
			2 => array(
				'text' => 'Stop by Classroom',    'link' => '/labmgr/stop_vms_by_classroom',  'spacer' => ''),
			3 => array(
				'text' => 'Stop by Machine',      'link' => '/labmgr/stop_vms_by_machine',    'spacer' => '<hr>'),
			4 => array(
				'text' => 'Manage VMs',           'link' => '/labmgr/add_vm',                 'spacer' => ''),
			5 => array(
				'text' => 'Manage URLs',           'link' => '/labmgr/add_url',                 'spacer' => '<hr>'),
			6 => array(
				'text' => 'Find Running VMs by Classroom', 'link' => '/labmgr/find_vms_by_classroom',     'spacer' => '')
			);

		foreach($menu as $menu_item) {
			if("/".uri_string() == $menu_item['link']) {
				echo "<li class='active'><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];
			} else {
				echo "<li><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];

			}
		}
	?>


</ul>

