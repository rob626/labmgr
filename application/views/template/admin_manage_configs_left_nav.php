<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Admin Home',            'link' => '/admin/',                      'spacer' => '<hr>'),
			1 => array(
				'text' => 'Add Torrent Client',    'link' => '/admin/add_torrent_client',    'spacer' => ''),
			2 => array(
				'text' => 'Add Operating System',  'link' => '/admin/add_operating_system',  'spacer' => ''),
			3 => array(
				'text' => 'Place Holder',          'link' => '/admin/reporting_twitter',     'spacer' => '')
			);

		foreach($menu as $menu_item) {
			if("/".uri_string() == $menu_item['link']) {
				echo "<li class='active'><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];
			} else {
				echo "<li><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>".$menu_item['spacer'];

			}
		}
	?>
<!--
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
-->
</ul>
