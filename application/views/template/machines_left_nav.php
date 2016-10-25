<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Machines status',       'link' => '/labmgr/machine_status',  'spacer' => '<hr>'),
			1 => array(
				'text' => 'Manage Machines',       'link' => '/labmgr/manage_machines', 'spacer' => '<hr>'),
			2 => array(
				'text' => 'Update BG Info',       'link' => '/labmgr/bg_info_update',  'spacer' => ''),
			3 => array(
				'text' => 'BG Info Room Config',       'link' => '/labmgr/bg_info_config',  'spacer' => '')
			4 => array(
				'text' => 'Show Desktop',       'link' => '/labmgr/show_desktop',  'spacer' => ''),
			
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
