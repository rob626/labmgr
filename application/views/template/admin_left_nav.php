<ul class='side-nav'>
	<?php 
		$menu = array(
			0 => array(
				'link' => 'admin/set_global_defaults',
				'text' => 'Set Global Defaults'
				),
			1 => array(
				'link' => 'admin/validate_ips',
				'text' => 'Validate MAC / IP Mapping'
				)
			);


		foreach($menu as $menu_item) {
			if(uri_string() == $menu_item['link']) {
				echo "<li class='active'><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>";
			} else {
				echo "<li><a href='".$menu_item['link']."'>".$menu_item['text']."</a></li>";

			}
		}
	?>

		<li><a href='/admin/validate_seats'>Validate Seats</a></li>
		<hr>
		<li><a href='/admin/db_reset'>Database Reset</a></li>
		<li><a href='/admin/export_db'>Database Export</a></li>
		<li><a href='/admin/import_db'>Database Import</a></li>
		<hr>
		<li><a href='/admin/cleanup_watchdog'>Watchdog dropins & full cleanups</a></li>
		<hr>
		<li><a href='/admin/reporting_twitter'>Reporting - twitter</a></li>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</ul>