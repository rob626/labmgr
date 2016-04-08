<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'text' => 'Validate MAC / IP Mapping', 'link' => '/admin/validate_ips',        'spacer' => ''),
			1 => array(
				'text' => 'Fix Missing MAC addresses', 'link' => '/admin/fix_macs',            'spacer' => ''),
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
				'text' => 'Ticket System',             'link' => '/admin/ticket_system',       'spacer' => ''),
			8 => array(
				'text' => 'Log file',                  'link' => '/admin/view_log_file',       'spacer' => ''),
			9 => array(
				'text' => 'Watchdog dropins & full cleanups','link' => '/admin/cleanup_watchdog','spacer' => '<hr>'),
			10 => array(
				'text' => 'Reporting - twitter',       'link' => '/admin/reporting_twitter',   'spacer' => '<hr>'),
			11 => array(
				'text' => 'Add Labmgr User',           'link' => '/admin/add_user',            'spacer' => ''),
			12 => array(
				'text' => 'Set Global Defaults',       'link' => '/admin/set_global_defaults', 'spacer' => ''),
			13 => array(
				'text' => 'Labmgr Manage Configs',      'link' => '/admin/labmgr_manage_configs', 'spacer' => '')
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
