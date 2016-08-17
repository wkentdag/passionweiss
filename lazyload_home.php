<?
add_action('wp_ajax_lazyload', 'lazyload_page');
add_action('wp_ajax_nopriv_lazyload', 'lazyload_page');

function lazyload_page() {
	if (key_exists('page', $_REQUEST) && key_exists('part', $_REQUEST)) {
		if ($_REQUEST['page'] == 'feature') lazyload_feature();
		else if ($_REQUEST['page'] == 'post') { if ($_REQUEST['part'] == 2) lazyload_post_2(); else lazyload_post(); }
		else if ($_REQUEST['page'] == 'home' && $_REQUEST['part'] == 2) lazyload_home_2();
		else lazyload_home_1();
	} else { lazyload_home_1(); }
	
	exit;
}

function lazyload_home_1() {
	?><!-- part:1 --><?
	
	start_left_col(); 
	
	//get_passion_features();
	
	get_deep_thoughts();
	
	get_random_old_posts();
	
	end_left_col();
	
	start_right_col();

	get_sidebar('bottom');
	
	end_right_col();
	
	get_passion_presents();
	
	get_inner_sanctum();
}

function lazyload_home_2() {
	?><!-- part:2 --><?
	get_inner_sanctum();
	
	get_passion_presents();
}

function start_left_col() {
?>
	<div class="leftCol">
<?
}

function end_left_col() {
?>
	</div><!-- leftCol -->
<?
}

function start_right_col() {
?>
	<div class="rightCol">
<?
}

function end_right_col() {
?>
	</div><!-- rightCol -->
<?
}

function lazyload_feature() {
	?><!-- part:1 --><?
	get_past_features();
	
	get_middle_leaderboard();
	
	get_passion_presents();
	
	get_inner_sanctum();
}

function lazyload_post() {
	?><!-- part:1 --><?
	
	get_deep_thoughts();

	get_recommended_for_you();
	
	get_news();
}

function lazyload_post_2() {
	?><!-- part:2 --><?
	get_middle_leaderboard();
	
	get_passion_presents();	
	
	get_inner_sanctum();
}

function get_middle_leaderboard() {
	/*?><a href="http://twitter.com/indioprather"><img src="https://pbs.twimg.com/media/Bw-2qJdIIAAmIUV.jpg:large"></a><?*/
}

function get_recommended_for_you() {
	global $exclude_posts;
	
	$ryArgs = array('post_status'=>'publish', 'posts_per_page'=>'2', 'orderby'=>'rand', 'cat'=>'-' . $GLOBALS['special_category']);
	$recommended = new WP_Query($ryArgs);
	if ($recommended->have_posts()) { 
		while ($recommended->have_posts()) { $recommended->the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			$customFlds = get_post_custom($post->ID);
			$link_url = $customFlds['website'];
			$ryPosts[] = array('ID'=>get_the_ID(), 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'excerpt'=>get_the_excerpt(), 'post_date'=>get_the_time(get_option('date_format')), 'cat'=>get_the_category(), 'website'=>$link_url, "thumbnail"=>$thumbnail, "tags"=>get_the_tags(), "comment_count"=>get_comments_number('', '1 Comment', '% Comments'));
			$exclude_posts[] = get_the_ID();
		}
	}
	if (is_array($ryPosts)) { ?>
		<div class="recommended_container">
			<div class="recommended_header"><img src="<? echo get_bloginfo('template_url') . '/images/recommendedforyou.jpg'; ?>"></div>
			<? foreach ($ryPosts as $POST) { ?>
				<div class="recommended_item">
					<div class="recommended_image"><img src="<? echo $POST['thumbnail']; ?>"></div>
					<div class="recommended_right">
						<div class="recommended_title"><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?></a></div>
						<div class="recommended_sub_title">
							<? if (strpos($POST['tags'], ",") != -1) { 
								$tagsA = explode($POST['tags'], ',');
								$tagOut = "";
								for ($i = 0; $i < 3 && $i < count($tagsA); $i++) {
									if ($tagOut != "") $tagOut .= ", ";
									$tagOut .= $tagsA[$i];
								}
							} $tagOut = $POST['tags'];
							
							echo $tagOut;
							if (intval($POST['comments_count']) > 0) {
								if ($tagOut != "") echo "-";
								echo $POST['comments_count'];
							} ?>
						</div>
						<div class="recommended_content"><? echo truncate($POST['excerpt'], 250); ?></div>
						<div class="recommended_social">
							<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style" addthis:url="<? the_permalink(); ?>" addthis:title="<? echo addslashes(get_the_title()); ?>" addthis:description="<? echo str_replace("\"", "'", addslashes(wp_kses(get_the_excerpt(), ""))); ?>">
								<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
								<a class="addthis_button_tweet"></a>
							</div>
						</div>
					</div>
				</div>
			<? } ?>
		</div><!-- /recommended_container -->
		<div class="clear"></div>
		<?
	}
}

function get_news() {
}

function get_inner_sanctum() {
	$lArgs = array('orderby'=>'name', 'limit'=>'-1', 'category'=>$GLOBALS['innersanctum_category']);
	$links = get_bookmarks($lArgs);

	if (is_array($links)) { ?>
		<script>
			var lPosts = new Array(0);
			<? foreach ($links as $POST) { ?>
				lPosts[lPosts.length] = {'id': '<? echo $POST->link_id; ?>', 'title': '<? echo str_replace("\"", "\'", str_replace("'", "\'", $POST->link_name)); ?>', 'website': '<? echo $POST->link_url; ?>' };
			<? } ?>
			
		</script>
		<div id="innersanctum_container">
			<div id="innersanctum">
				<div id="innersanctumLeft">
					<div id="innersanctumText"></div>
					<div id="innersanctumNav">
						<div id="innersanctumNavLeft"><a href="javascript: innersanctum_previous();"><img src="<? echo get_template_directory_uri(); ?>/images/innersanctum_left.jpg"></a></div>
						<div id="innersanctumNavRight"><a href="javascript: innersanctum_next();"><img src="<? echo get_template_directory_uri(); ?>/images/innersanctum_right.jpg"></a></div>
					</div>
				</div>
				<div id="innersanctumRight">
					<? $lInd = 0;
					foreach ($links as $POST) { if ($lInd++ > 21) break; ?>
						<a href="<? echo $POST->link_url; ?>"><? echo $POST->link_name; ?></a><br>
					<? } ?>
				</div>
			</div><!-- /innersanctum -->
			
			<div id="innersanctum_ad"><a href="http://www.google.com" target="_blank"><img src="<? bloginfo('template_url') ?>/images/lilboosie-smoking.gif"></a></div>
		</div>
		<div class="clear"></div>
	<?
	}
}

function get_deep_thoughts() {
	$dtArgs = array('post_status'=>'publish', 'posts_per_page'=>'6', 'cat'=>$GLOBALS['deepthoughts_category']);
	$deepthoughts = new WP_Query($dtArgs);
	if ($deepthoughts->have_posts()) { 
		while ($deepthoughts->have_posts()) { $deepthoughts->the_post();
			global $post;
			$dtPosts[count($dtPosts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$pos->post_name, 'title'=>get_the_title(), 'content'=>get_the_content(), 'post_date'=>get_the_date(), 'cat'=>get_the_category());
		}
	}
	if (is_array($dtPosts)) {
	?>
		<div id="deepthoughts">
			<div id="deepthoughtsLeft"><img src="<? echo get_template_directory_uri(); ?>/images/deepthoughts.jpg" width="219" height="40"></div>
			<div id="deepthoughtsRight">
				<div class="deepthoughtsPost">
					<? echo substr($dtPosts[0]['content'], 0, 150); ?>
					<a href="<? echo $dtPosts[0]['permalink']; ?>"><img src="<? echo get_template_directory_uri(); ?>/images/raquo.jpg" style="display: inline-block;"></a>
				</div>
				<div id="deepthoughtsMore"><a href="<? echo $dtPosts[0]['permalink']; ?>"><img src="<? echo get_template_directory_uri(); ?>/images/deepthoughtsmore.jpg"></a></div>
			</div>
		</div><!-- /deepthoughts -->
		<div class="clear"></div>
	<? } 
}

function get_random_old_posts() {
	global $exclude_posts;
	
	$weeks = intval($GLOBALS['random_old_posts_weeks_old']);
	$before = new DateTime('now');
	$secondsInAWeek = 604800;
	$weeksInSeconds = $weeks * $secondsInAWeek;
	$weeksago = $before->format('U') - $weeksInSeconds;
	$after = new DateTime(date("F j, Y", $weeksago));
	
	
	$args = array('post_status'=>'publish', "posts_per_page"=>"3", "orderby"=>"rand", 'date_query' => array(  array(  'after' => $after->format("F j, Y") ) ));

	$qry = new WP_Query($args);
	if ($qry->have_posts()) { 
		?><div class="upfromthechambers"><img src="<? bloginfo("template_url"); ?>/images/upfromthechambers.png"></div><?
		while ($qry->have_posts()) { $qry->the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			?>
			<div class="postSummary">
				<div class="postSummaryHeader">
					<div class="postSummaryTitle"><a href="<? the_permalink(); ?>"><? echo truncate(get_the_title(), 150); ?></a></div>
					<div class="postSummaryDate"><? echo the_date(); ?></div>
					<div class="clear"></div>
				</div><!-- /post_summary_header -->
				<div class="postSummaryContent">
					<? if ($thumbnail != "") { ?><div class="postSummaryImage"><a href="<? the_permalink(); ?>"><img src="<? echo $thumbnail; ?>" class="postThumbnail"></a></div><? } ?>
					<div class="postSummaryExcerpt"><? the_excerpt(); ?></div>
					
					<div class="postSummaryContentFooter">
						<div class="postSummaryAuthor"><a href="<? echo get_author_posts_url(get_the_author_id()); ?>"><? the_author(); ?></a></div>
						<div class="postSummarySocial">
							<!--<div class="addthis_toolbox addthis_default_style" addthis:url="<-? the_permalink(); ?>" addthis:title="<-? echo addslashes(get_the_title()); ?>" addthis:description="<-? echo str_replace("\"", "'", addslashes(wp_kses(get_the_excerpt(), ""))); ?>">
								<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
								<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
								<a class="addthis_button_tweet"></a>
							</div>-->
						</div>
					</div>
					<div class="clear"></div>
				</div><!-- /post_summary_content -->
				<div class="postSummaryFooter">
					<div class="postSummaryComments"><? $comments = get_comments_number(); if (intval($comments) == 1) echo $comments . " Comment"; else if (intval($comments) > 1) echo $comments . "Comments"; ?></div>
					<div class="postSummaryMeta">
						POSTED IN <? the_tags(); ?> | <a href="<? comments_link(); ?>">LEAVE A COMMENT</a>
					</div>
				</div><!-- /post_summary_footer -->
			</div><!-- /post_summary -->
			<?
			$exclude_posts[] = get_the_ID();
		}
	}
}

function get_past_features() {
	global $exclude_posts;
	
	$pfArgs = array('post_status'=>'publish', 'posts_per_page'=>'2', 'orderby'=>'rand');
	$past_features = new WP_Query($pfArgs);
	if ($past_features->have_posts()) { 
		while ($past_features->have_posts()) { $past_features->the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			$customFlds = get_post_custom($post->ID);
			$pfPosts[count($pfPosts)] = array('ID'=>get_the_ID(), 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'excerpt'=>strip_tags(get_the_excerpt()), 'post_date'=>get_the_time(get_option('date_format')), 'cat'=>get_the_category(), 'website'=>$link_url, "thumbnail"=>$thumbnail);
			$exclude_posts[] = get_the_ID();
		}
	}
	
	if (is_array($pfPosts)) { ?>
		<div id="pastFeatures">
			<? foreach ($pfPosts as $POST) { ?>
				<div class="pastFeaturesItem">
					<div class="pastFeaturesImage"><img src="<? echo $POST['thumbnail']; ?>"></div>
					<div class="pastFeaturesRight">
						<div class="pastFeaturesTag">Past FEATURES</div>
						<div class="pastFeaturesTitle"><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?></a></div>
						<div class="pastFeaturesDate"><? echo $POST['post_date']; ?></div>
						<div class="pastFeaturesContent"><? echo $POST['excerpt']; ?></div>
						<div class="pastFeaturesReadMore"><a href="<? echo $POST['permalink']; ?>">Read More &raquo;</a></div>
					</div>
				</div>
			<? } ?>
		</div><!-- /pastFeatures -->
		<?
	}
}

function get_passion_presents() {
	$ppArgs = array('post_status'=>'publish', 'posts_per_page'=>'-1', 'cat'=>$GLOBALS['passionpresents_category']);
	$passion_presents = new WP_Query($ppArgs);
	if ($passion_presents->have_posts()) { 
		while ($passion_presents->have_posts()) {
			$passion_presents->the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			$ppPosts[count($ppPosts)] = array('ID'=>get_the_ID(), 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'excerpt'=>strip_tags(truncate(get_the_content(), 500)), 'comments_number'=>get_comments_number(), 'post_date'=>get_the_time(get_option('date_format')), "thumbnail"=>$thumbnail);
		}
	}
	
	
	if (is_array($ppPosts)) { ?>
		<div class="clear"></div>
		<div id="passionPresentsContainer">
			<div id="passionPresentsHeader">
				<div id="passionPresentsLogo"><img src="<? echo get_template_directory_uri(); ?>/images/passionpresentslogo.jpg"></div>
				<div id="passionPresentsNav"><? foreach ($ppPosts as $POST) { ?><div class="passionPresentsNavDot"><a href="javascript: ppLoad(<? echo $POST['ID']; ?>);"><img src="<? echo get_template_directory_uri(); ?>/images/graydot.jpg"></a></div><? } ?></div>
			</div>
			<div id="passionPresents">
				<? $IND = 1; foreach ($ppPosts as $POST) { ?>
					<div class="passionPresentsItemCont" id="passionPresents_<? echo $POST['ID']; ?>" style="z-index: <? echo $IND++; ?>">
						<div class="passionPresentsItem">
							<a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>"></a>
						</div>
						<div class="passionPresentsDetails">
							<h1><a href="<? echo $POST['permalink']; ?>"><? echo $POST['title']; ?></a></h1>
							
							<p><? echo $POST['excerpt']; ?></p>
							
							<div class="passionPresentsDetailsMore"><a href="<? echo $POST['permalink']; ?>">MORE INFO</a></div>
						</div>
						<div class="passionPresentsFooter">
							<div class="passionPresentsShare"></div>
						
							<div class="passionPresentsLinks"><? if ($POST['comments_number'] > 0) { echo $POST['comments_number']; ?> Comments | <? } ?><a href="<? echo $POST['permalink']; ?>#comments">Leave A Comment</a></div>
						</div>
						<div class="clear"></div>
					</div>
				<? } ?>
				<div class="clear"></div>
			</div><!-- /passionPresents -->
			<div class="clear"></div>
		</div><!-- /passionPresentsContainer -->
		<div class="clear"></div>
		<script>
			var preload_images = [<? for ($i = 0; $i < count($ppPosts); $i++) { ?>"<? echo $ppPosts[$i]['thumbnail']; ?>"<? if ($i < count($ppPosts) - 1) { echo ", "; } } ?>];
			do_preload_images(preload_images);
			passionPresentsHandlers();
		</script>
		<?
	}
}

function get_passion_features() {
	global $exclude_posts;
	$pfArgs = array('posts_per_page'=>'4', 'cat'=>$GLOBALS['passionfeatures_category']);
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
			<div id="passionfeaturesHeader"><img src="<? bloginfo('template_directory'); ?>/images/passionfeatures.jpg"></div>
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
}

function get_top_billing() {
	$tbArgs = array('post_status'=>'publish', 'posts_per_page'=>'6', 'cat'=>$GLOBALS['topbillin_category']);
	$topbillin = new WP_Query($tbArgs);
	if ($topbillin->have_posts()) { 
		while ($topbillin->have_posts()) { $topbillin->the_post();
			global $post;
			$thumbnail = "";
			if ($img_src = find_img_src($post)) { $thumbnail = $img_src; }
			$tbPosts[count($tbPosts)] = array('ID'=>$post->ID, 'permalink'=>get_permalink(), 'name'=>$post->post_name, 'title'=>get_the_title(), 'post_date'=>get_the_date(), 'author'=>get_the_author(), 'author_url'=>get_author_posts_url(get_the_author_meta('ID')), 'tags'=>get_the_tag_list('', ',', ''), 'cat'=>get_the_category(), 'thumbnail'=>$thumbnail, 'excerpt'=>str_replace("[...]", " <a href=\"" . get_permalink() . "\">Read More &raquo;</a>", get_the_excerpt()), "comment_count"=>get_comments_number(), "comments_link"=>get_comments_link($post->ID));
			$exclude_posts[] = $post->ID;
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
			jQuery('#topbillinLeftEnd').hover(function () { 
				jQuery(this).fadeTo(0, .6);
			}, function () {
				jQuery(this).fadeTo(0, 1);
			});
			
			jQuery('#topbillinRightEnd').click(function () { 
				topbillingRightScroll();
			});
			jQuery('#topbillinRightEnd').hover(function () { 
				jQuery(this).fadeTo(0, .6);
			}, function () {
				jQuery(this).fadeTo(0, 1);
			});
			
			var cnt = 0;
			jQuery('.topbillinPost').each(function() { cnt++; });
			jQuery('#topbillinInner').css('width', (cnt * jQuery('.topbillinPost').outerWidth(true)));
		});
	</script>
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
	<div class="clear"></div>
<?
}
?>