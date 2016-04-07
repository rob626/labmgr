<ul class='side-nav'>
	<?php 
		$menu = array(

			0 => array(
				'text' => 'Push by Classroom',     'link' => '/labmgr/push_torrents_by_classroom',  'spacer' => ''),
			1 => array(
				'text' => 'Push by Machine',       'link' => '/labmgr/push_torrents_by_machine',  'spacer' => '<hr>'),
			2 => array(
				'text' => 'Delete by Classroom',   'link' => '/labmgr/delete_torrents_by_classroom',  'spacer' => ''),
			3 => array(
				'text' => 'Delete by Machine',     'link' => '/labmgr/delete_torrents_by_machine',  'spacer' => '<hr>'),
			4 => array(
				'text' => 'Upload Torrents',       'link' => '/labmgr/upload_torrent',  'spacer' => ''),
			5 => array(
				'text' => 'Manage Torrents',       'link' => '/labmgr/manage_torrents', 'spacer' => '')
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
