<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Manage Rooms',               'link' => '/labmgr/add_room',         'spacer' => '<hr>'),
			1 => array(
				'text' => 'Room Stop-all / Reboot-all', 'link' => '/labmgr/room_stop_reboot', 'spacer' => '')
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