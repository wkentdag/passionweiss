<table border="0" cellspacing="0" cellpadding="0" class="bottomNavigation"><tr>
	<td><img src="<? bloginfo("template_directory"); ?>/images/bottomlogo.png"></td>
	<?
	$ind = 0;
	$cnt = 0;
	$items = wp_get_nav_menu_items("bottom");

	foreach ($items as $NAV) { 
		if ($NAV->menu_item_parent == 0) {
			if ($ind != 0) { ?></ul></td><? }
			if ($ind++ >= 5) break; ?>

			<td class="bottomNavItem" valign="top">
				<? echo $NAV->post_title; ?>
				
				<ul>
		<?  } else { ?>
			<li><a href="<? echo $NAV->url; ?>"><? echo $NAV->post_title; ?></a></li>
		<? }
		
		if ($cnt++ == count($items) - 1) { ?></ul></td><? } 
	} ?>
</tr></table>
<div class="clear"></div>