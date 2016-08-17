<?
/**
Template Name: Archive
*/

get_header();

$paged = get_query_var('paged') != "" ? get_query_var('paged') : 1;
$qry = new WP_Query(array("posts_per_page"=>"10", "cat"=>"-" . $GLOBALS['topbillin_category'] . ",-" . $GLOBALS['passionpresents_category'] . ",-" . $GLOBALS['deepthoughts_category'] . ",-" . $GLOBALS['albumofthemonth_category'], "paged"=>$paged));

if ($qry->have_posts()) { 
	while ($qry->have_posts()) { 
		$qry->the_post();
		global $post;
		$thumbnail = "";
		if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
		$Posts[count($Posts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$pos->post_name, 'title'=>get_the_title(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID'), get_the_author()), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
	}
}

$tbArgs = array('posts_per_page'=>'6', 'cat'=>$GLOBALS['topbillin_category']);
$topbillin = new WP_Query($tbArgs);
if ($topbillin->have_posts()) { 
	while ($topbillin->have_posts()) { $topbillin->the_post();
		global $post;
		$thumbnail = "";
		if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
		$tbPosts[count($tbPosts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$pos->post_name, 'title'=>get_the_title(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID'), get_the_author()), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
	}
}
?>

<script>
	
	function topbillingLeftScroll() { 
		if (parseInt(jQuery('#topbillinInner').css('left')) < 0)
			jQuery('#topbillinInner').animate({ 'left': (parseInt(jQuery('#topbillinInner').css('left')) + jQuery('#topbillin').outerWidth(true)) + "px" });
	}
	
	function topbillingRightScroll() {
		if (Math.abs(parseInt(jQuery('#topbillinInner').css('left'))) < jQuery('#topbillinInner').outerWidth(true) - jQuery('#topbillin').outerWidth(true))
			jQuery('#topbillinInner').animate({ 'left': (parseInt(jQuery('#topbillinInner').css('left')) - jQuery('#topbillin').outerWidth(true)) + "px" });
	}
	
	
	
	jQuery(document).ready(function () {
	
		jQuery('#topbillinLeftEnd').click(function () { 
			topbillingLeftScroll();
		});
		
		jQuery('#topbillinRightEnd').click(function () { 
			topbillingRightScroll();
		});
		
		var cnt = 0;
		jQuery('.topbillinPost').each(function() { cnt++; });
		jQuery('#topbillinInner').css('width', (cnt * jQuery('.topbillinPost').outerWidth(true)));
	});
</script>

<!-- top billin -->
<div class="content">
	<div id="topbillinContainer">
		<div id="topbillinLeftEnd"></div>
		<div id="topbillin">
			<div id="topbillinInner">
				<? foreach ( $tbPosts as $POST ) { 
					$img = get_post_thumbnail_id($POST['ID']);
					$attachment = wp_get_attachment($img);
					?>
					<div class="topbillinPost" id="topbillingPost_<? echo $POST['ID']; ?>">
						<div class="topbillinPostImage"><a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>"></a></div>
						<div class="topbillinPostExcerpt">
							<h5><a href="<? echo $POST['permalink']; ?>"><? echo truncate($POST['title'], 65); ?></a></h5>
							<? echo $attachment['excerpt']; ?>
						</div>
					</div>
				<? } ?>
			</div><!-- /topbillinInner -->
		</div><!-- /topbillin -->
		<div id="topbillinRightEnd"></div>
	</div><!-- /top billin -->

	<!-- left_col -->
	<div class="leftCol">
		<? 
		$ind = 0;
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
			<div id="paginationPrevious"><? if (!($paged == 0 || $paged == 1)) { ?><a href="/archive/page/<? echo ($paged - 1); ?>">&laquo; Newer Posts</a><? } ?></div>
			<div id="paginationNext"><a href="/archive/page/<? echo ($paged + 1); ?>">Older Posts &raquo;</a></div>
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
</div>
<? get_footer(); ?>