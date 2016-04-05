<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Run Single Command by Class',   'link' => '/labmgr/run_single_cmd_class',   'spacer' => ''),
			1 => array(
				'text' => 'Run Single Command by Machine', 'link' => '/labmgr/run_single_cmd_machine', 'spacer' => '<hr>'),
			2 => array(
				'text' => 'Manage Scripts',                'link' => '/labmgr/add_script',             'spacer' => '<hr>'),
			3 => array(
				'text' => 'Copy file by Class',            'link' => '/labmgr/copy_file_by_class',     'spacer' => ''),
			4 => array(
				'text' => 'Copy file by Machine',          'link' => '/labmgr/copy_file_by_machine',   'spacer' => ''),
			5 => array(
				'text' => 'Copy directory by Class',       'link' => '/labmgr/copy_dir_by_class',      'spacer' => ''),
			6 => array(
				'text' => 'Copy directory by Machine',     'link' => '/labmgr/copy_dir_by_machine',    'spacer' => '')
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
