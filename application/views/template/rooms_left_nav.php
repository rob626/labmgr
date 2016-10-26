<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Manage Rooms',                    'link' => '/labmgr/add_room',         'spacer' => '<hr>'),
			1 => array(
				'text' => 'Room Stop / Reboot / Move mouse', 'link' => '/labmgr/room_stop_reboot', 'spacer' => '<hr>'),
			2 => array(
				'text' => 'Update BGinfo by room',       'link' => '/labmgr/bg_info_update',  'spacer' => ''),
			3 => array(
				'text' => 'BGinfo Room Config',       'link' => '/labmgr/bg_info_config',  'spacer' => ''),
			4 => array(
				'text' => 'Show Desktop by room',       'link' => '/labmgr/show_desktop',  'spacer' => '')
		);

		foreach($menu as $menu_item) {
			if("/".uri_string() == $menu_item['link']) {
				echo "<li class='active'><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];
			} else {
				echo "<li><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];

			}
		}
	?>

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</ul>