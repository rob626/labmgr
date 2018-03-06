<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Start Browser by Machine',      'link' => '/labmgr/start_browser_by_machine',    'spacer' => ''),
			1 => array(
				'text' => 'Stop Browser by Machine',      'link' => '/labmgr/stop_browser_by_machine',    'spacer' => '<hr>'),
			2 => array(
				'text' => 'Manage URLs',           'link' => '/labmgr/add_url',                 'spacer' => '<hr>')
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
