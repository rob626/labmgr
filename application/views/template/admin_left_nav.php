<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Set Global Defaults',       'link' => '/admin/set_global_defaults', 'spacer' => '<hr>'),
			1 => array(
				'text' => 'Validate MAC / IP Mapping', 'link' => '/admin/validate_ips',        'spacer' => ''),
			2 => array(
				'text' => 'Validate Seats',            'link' => '/admin/validate_seats',      'spacer' => ''),
			3 => array(
				'text' => 'Validate VMX',              'link' => '/admin/validate_vmx',        'spacer' => '<hr>'),
			4 => array(
				'text' => 'Database Reset',            'link' => '/admin/db_reset',            'spacer' => ''),
			5 => array(
				'text' => 'Database Export',           'link' => '/admin/export_db',           'spacer' => ''),
			6 => array(
				'text' => 'Database Import',           'link' => '/admin/import_db',           'spacer' => '<hr>'),
			7 => array(
				'text' => 'Watchdog dropins & full cleanups','link' => '/admin/cleanup_watchdog','spacer' => '<hr>'),
			8 => array(
				'text' => 'Reporting - twitter',       'link' => '/admin/reporting_twitter',   'spacer' => '')
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
