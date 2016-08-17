<table border="0" cellspacing="0" cellpadding="0" width="100%" style="table-layout: fixed;"><tr>
	<?
	$items = wp_get_nav_menu_items("top");
	foreach ($items as $NAV) { ?>
		<td class="navigationItem"><a href="<? echo $NAV->url; ?>"><? if ($NAV->post_title == "") echo $NAV->title; else echo $NAV->post_title; ?></a></td>
	<? } ?>
</tr></table>