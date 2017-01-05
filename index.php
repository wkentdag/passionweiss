<? get_header(); ?>
<?php
global $exclude_posts;

$paged = get_query_var('paged') != "" ? get_query_var('paged') : 1;

query_posts('paged=' . $paged . "&cat=" . $GLOBALS['top5_category'] . "&posts_per_page=5");
if (have_posts()) { 
	while (have_posts()) { 
		the_post();
		global $post;
		$thumbnail = "";
		if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
		$Posts[count($Posts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID')), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
		$exclude_posts[] = $post->ID;
	}
}

$goodreads = get_bookmarks(array("category"=>$GLOBALS['sidepieces_category'], "limit"=>"10", "orderby"=>"link_id", "order"=>"desc"));

$spArgs = array('post_status'=>'publish', "posts_per_page"=>"6", "cat"=>$GLOBALS['staffpicks_category']);
$staffpicks = new WP_Query($spArgs);
if ($staffpicks->have_posts()) { 
	while ($staffpicks->have_posts()) { $staffpicks->the_post();
		global $post;
		$thumbnail = "";
		if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
		$spPosts[count($spPosts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'content'=>get_the_content(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID')), 'author_image'=>get_the_author_meta("image"), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
		$exclude_posts[] = $post->ID;
	}
} ?>

<script>
	lazyLoadParts = 2;
</script>

<div class="content" style="border-top: 1px solid #262626; margin-top: 50px;">
	<!-- leftCol -->
	<div class="leftCol">
		<table border="0" cellspacing="0" cellpadding="0"><tr>
			<td colspan="2">
				<div class="top5">
					<div class="top5_left"></div>
					<div class="top5_inner">
						<? 
						$ind = 1;
						foreach ($Posts as $POST) { 
							$cat = get_the_category($POST['ID']);
							if (is_array($cat)) $cat = $cat[0];
							?>
							<div class="top5_item">
								<div class="top5_image"><a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>" border="0"></a></div>
								<div class="top5_details_bg"></div>
								<div class="top5_details">
									<!--<div class="top5_category"><a href="<-? echo get_category_link($cat->term_id); ?>"><-? echo $cat->name; ?></a></div>-->
									<div class="top5_title"><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?></a></div>
									<div class="top5_author">by <a href="<? echo $POST['author_url'];?>"><? echo $POST['author']; ?></a></div>
								</div>
							</div>
							<?
							$ind++;
						} ?>
						<div class="clear"></div>
					</div>
					<div class="top5_right"></div>
					<div class="clear"></div>
				</div>
			</td>
		</tr><tr>
			<td valign="top">
				<div class="goodreads">
					<img src="<? bloginfo("template_directory"); ?>/images/sidepieces.jpg">
					<ul>
						<? foreach ($goodreads as $READ) { ?>
							<li><a href="<? echo $READ->link_url; ?>"><? echo $READ->link_name; ?></a></li>
						<? } ?>
					</ul>
				</div>
			</td>
			<td valign="top" id="main_cell">
				<?
				$ind = 0;
				global $exclude_posts;
				$pfArgs = array('posts_per_page'=>'3', 'cat'=>$GLOBALS['passionfeatures_category']);
				$passionFeatures = new WP_Query($pfArgs);
				if ($passionFeatures->have_posts()) { 
					while ($passionFeatures->have_posts()) { $passionFeatures->the_post();
						global $post;
						$thumbnail = "";
						if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
						$pfPosts[count($pfPosts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'content'=>get_the_content(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID')), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
						$exclude_posts[] = get_the_ID();
					}
				}
				if ($ind == 0 && is_array($pfPosts)) { ?>
					<div id="passionfeaturesContainer">
						<!--<div id="passionfeaturesHeader"><img src="<-? bloginfo('template_directory'); ?>/images/passionfeatures.jpg"></div>-->
						<div id="passionfeatures">
							<? foreach ($pfPosts as $PFPOST) { ?>
								<div class="passionfeaturesPost">
									<div class="passionfeaturesImage"><a href="<? echo $PFPOST['permalink']; ?>"><img src="<? echo $PFPOST['thumbnail']; ?>" class="postThumbnail"></a></div>
									<div class="passionfeaturesTitle"><a href="<? echo $PFPOST['permalink']; ?>"><? echo truncate($PFPOST['title'], 100); ?></a></div>
									<div class="passionfeaturesAuthor">By <? echo $PFPOST['author']; ?></div>
								</div>
							<? } ?>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				<?
				}
				$ind++;
				
				
				$album_qry = new WP_Query(array("posts_per_page"=>"1", "cat"=>$GLOBALS['albumofthemonth_category']));
				if ($album_qry->have_posts()) { $album_qry->the_post();
					global $post;
					$thumbnail = "";
					if ($img_src = find_img_src($post)) { $thumbnail = $img_src; } ?>
					<div id="albumofthemonth_wrapper">
						<div id="albumofthemonth" onclick="window.location.href='<? the_permalink(); ?>';">
							<div class="album_left">
								<img src="<? bloginfo("template_directory"); ?>/images/albumofthemonth.jpg" style="margin-top: 10px; margin-left: 15px;">
							</div>
							<div class="album_right">
								<?
								$title = get_post_meta(get_the_id(), "album_title", true);
								$artist = get_post_meta(get_the_id(), "album_artist", true);
								?>
								<div class="album_img_container"><? if ($thumbnail != "") { ?><img src="<? echo $thumbnail; ?>" class="album_img"><? } ?></div>
								<div class="album_text_container">
									<span class="album_title"><? echo $title; ?></span><br>
									<span class="album_artist"><? echo $artist; ?></span>
								</div>
							</div>
						</div>
					</div>
				<? } ?>
			</td>
		</tr></table>
		<div class="clear"></div>
	</div><!-- /left_col -->

	<!-- right_col -->
	<div class="rightCol">
		<div id="topSocial">
			<a href="http://www.twitter.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/twitter.png" style="float: left; margin-left: 0px;"></a>
			<a href="http://www.facebook.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/facebook.png" style="float: left;"></a>
			<a href="http://www.instagram.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/instagram.png" style="float: left;"></a>
			<a href="http://soundcloud.com/passionweiss"><img src="<? bloginfo("template_directory"); ?>/images/soundcloud.png" style="float: left;"></a>
			<a href="https://www.youtube.com/channel/UCbd7VXWPG13AbTiL8BSV5jg"><img src="<? bloginfo("template_directory"); ?>/images/youtube.png" style="float: left;"></a>
			<!--<a href="#"><img src="<? bloginfo("template_directory"); ?>/images/paypal.png" style="float: left;"></a>-->
		</div>
		<ul class="sidebar">
      <li id="text-4" class="widget widget_text">
        <div class="textwidget">
          <div style="width: 100%; height: 250px;">
            <a href="http://shotsfiredpodcast.com">
              <img src="/wp-content/themes/weiss/images/shotsfired.jpg">
            </a>
          </div>
        </div>
      </li>
      <li id="text-3" class="widget widget_text">
        <div class="textwidget">
          <a href='https://www.youtube.com/watch?v=nXGgw3m0AXE' target="_blank">
            <img src="http://www.passionweiss.com/wp-content/uploads/2017/01/tenheaded.png">
          </a>
        </div>
      </li>
    </ul>
	</div><!-- /rightCol -->
	<div class="clear" style="height: 60px;"></div>
	
	<div class="staffpicks">
		<? foreach ($spPosts as $POST) { 
			$tag = get_the_tags($POST['ID']);
			if (is_array($tag)) { foreach ($tag as $TAG) { $tag = $TAG; break; } }
			?>
			<div class="staffpicks_item">
				<div class="staffpicks_left">
					<!--<div class="staffpicks_tag_container"><div class="staffpicks_tag"><a href="<-? echo get_tag_link($tag->term_id); ?>"><-? echo $tag->name; ?></a></div></div>-->
					<div class="staffpicks_image"><a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>" border="0"></a></div>
				</div>
				<div class="staffpicks_right">
					<div class="staffpicks_author">
						<div class="staffpicks_author_image"><a href="<? echo $POST['author_url']; ?>"><img src="<? echo $POST['author_image']; ?>" border="0"></a></div>
						<div class="staffpicks_author_details">
							<!--<div class="staffpicks_author_tag">TRENDING</div>-->
							<div class="staffpicks_author_name"><a href="<? echo $POST['author_url']; ?>"><? echo $POST['author']; ?></a></div>
							<div class="staffpicks_author_title"><? echo $POST['author_title']; ?></div>
						</div>
					</div>
					<div class="staffpicks_title"><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?> <img src="<? bloginfo("template_directory"); ?>/images/readarrow.jpg" border="0" class="staffpicks_read"></a></div>
				</div>
			</div>
		<? } ?>
	</div>
	<div class="clear"></div>
	
	<div id="loadInto_1"></div>
</div>
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52af938927810ddc"></script>-->
<? get_footer(); ?>

