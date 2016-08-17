<? get_header(); ?>
	<?
	$paged = get_query_var('paged') != "" ? get_query_var('paged') : 1;
	global $wp_query;
	if (array_key_exists('cat', $wp_query->query_vars)) { if ($wp_query->query_vars['cat'] != "") $wp_query->query_vars['cat'] .= ","; }
	$wp_query->query_vars['cat'] .= "-" . $GLOBALS['passionpresents_category'] . ",-" . $GLOBALS['deepthoughts_category'];

	query_posts($wp_query->query_vars);

	if (have_posts()) { 
		while (have_posts()) { 
			the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			$Posts[count($Posts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$pos->post_name, 'title'=>get_the_title(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID'), get_the_author()), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
		}
	}
	$writer = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	$img = $writer->get("photo");
	?>	
	<div class="content">
		<div class="clear" style="height: 80px;">&nbsp;</div>
		<!-- left_col -->
		<div class="leftCol">
			<!--content-->
			<div class="author_box">
				<div class="author_details">
					<!--<div class="author_image"></div>-->
					<div class="author_name"><? echo $writer->display_name; ?></div>
					<div class="author_bio"><img src="<? echo $img; ?>" style="float: right; max-width: 300px; padding-left: 20px; padding-bottom: 20px;"><? echo $writer->get("bio"); ?></div>
				</div>
				<div class="clear" style="padding-top: 40px; border-bottom: 1px solid #666;">&nbsp;</div>
			</div>
			
			<? $ind = 0;
			foreach ($Posts as $POST) { ?>
				
				<div class="postSummary" <? if ($ind == 0) { ?>style="margin-top: 0px !important;"<? } ?>>
					<div class="postSummaryHeader">
						<table border="0" width="100%"><tr>
							<td class="postSummaryTitle"><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?></a></td>
							<td class="postSummaryDate"><? echo $POST['post_date']; ?></td>
						</tr></table>
					</div><!-- /post_summary_header -->
					<div class="postSummaryContent">
						<? if ($POST['thumbnail'] != "") { ?><div class="postSummaryImage"><a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>" class="postThumbnail"></a></div><? } ?>
						<div class="postSummaryExcerpt"><? echo $POST['excerpt']; ?></div>
						
						<div class="postSummaryContentFooter">
							<div class="postSummaryAuthor">By <a href="<? echo $POST['author_url']; ?>"><? echo $POST['author']; ?></a></div>
							<div class="postSummarySocial">
								
							</div>
						</div>
						<div class="clear"></div>
					</div><!-- /post_summary_content -->
					<div class="postSummaryFooter">
						<div class="postSummaryComments"><? if (intval($POST['comment_count']) == 1) echo $POST['comment_count'] . " Comment | "; else if (intval($POST['comment_count']) > 1) echo $POST['comment_count'] . " Comments | "; ?><a href="<? echo $POST['comments_link']; ?>">Leave A Comment</a></div>
						<div class="postSummaryMeta">
							POSTED IN <? echo $POST['tags']; ?> 
						</div>
					</div><!-- /post_summary_footer -->
				</div><!-- /post_summary -->
				<div class="clear"></div>
			<? $ind++;
			} ?>
			<div id="pagination">
				<div id="paginationPrevious"><? previous_posts_link('&laquo; Newer Posts'); ?></div>
				<div id="paginationNext"><? next_posts_link('Older Posts &raquo;'); ?></div>
			</div>
		</div><!-- /left_col -->

		<!-- right_col -->
		<div class="rightCol">
			<div id="topSocial">
				<a href="http://www.twitter.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/twitter.png" style="float: left; margin-left: 0px;"></a>
				<a href="http://www.facebook.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/facebook.png" style="float: left;"></a>
				<a href="http://www.instagram.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/instagram.png" style="float: left;"></a>
				<a href="http://plus.google.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/gplus.png" style="float: left;"></a>
				<a href="http://plus.google.com/youtube"><img src="<? bloginfo("template_directory"); ?>/images/youtube.png" style="float: left;"></a>
				<a href="http://pinterest.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/pinterest.png" style="float: left;"></a>
			</div>
			<? get_sidebar('secondary'); ?>
		</div><!-- /rightCol -->
		<div class="clear"></div>
	<!--end sidebar-->
<? get_footer(); ?>