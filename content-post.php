<div class="postSummary">
	<div class="postSummaryHeader">
		<div class="postSummaryTitle"><a href="<? echo $POST['permalink']; ?>"><? echo truncate($POST['title'], 150); ?></a></div>
		<div class="postSummaryDate"><? echo $POST['post_date']; ?></div>
	</div><!-- /post_summary_header -->
	<div class="postSummaryContent">
		<? if ($POST['thumbnail'] != "") { ?><div class="postSummaryImage"><a href="<? echo $POST['permalink']; ?>"><img src="<? echo $POST['thumbnail']; ?>" class="postThumbnail"></a></div><? } ?>
		<div class="postSummaryExcerpt"><? echo $POST['excerpt']; ?></div>
		
		<div class="postSummaryContentFooter">
			<div class="postSummaryAuthor"><? echo $POST['author']; ?></div>
			<div class="postSummarySocial">
				<div class="addthis_toolbox addthis_default_style" addthis:url="<? the_permalink(); ?>" addthis:title="<? echo addslashes(get_the_title()); ?>" addthis:description="<? echo str_replace("\"", "'", addslashes(wp_kses(get_the_excerpt(), ""))); ?>">
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div><!-- /post_summary_content -->
	<div class="postSummaryFooter">
		<div class="postSummaryComments"><? if (intval($POST['comment_count']) == 1) echo $POST['comment_count'] . " Comment"; else if (intval($POST['comment_count']) > 1) echo $POST['comment_count'] . "Comments"; ?></div>
		<div class="postSummaryMeta">
			POSTED IN <? echo $POST['tags']; ?> | <a href="<? echo $POST['comments_link']; ?>">LEAVE A COMMENT</a>
		</div>
	</div><!-- /post_summary_footer -->
</div><!-- /post_summary -->
<?
if ($ind == 0 && is_array($pfPosts)) { ?>
	<div id="passionfeaturesContainer">
		<div id="passionfeaturesHeader"><img src="<? bloginfo('template_directory'); ?>/images/passionfeatures.jpg"></div>
		<div id="passionfeatures">
			<? foreach ($pfPosts as $PFPOST) { ?>
				<div class="passionfeaturesPost">
					<div class="passionfeaturesImage"><a href="<? echo $PFPOST['permalink']; ?>"><img src="<? echo $PFPOST['thumbnail']; ?>" class="postThumbnail"></a></div>
					<div class="passionfeaturesTitle"><a href="<? echo $PFPOST['permalink']; ?>"><? echo $PFPOST['title']; ?></a></div>
					<div class="passionfeaturesAuthor">By <? echo $PFPOST['author']; ?></div>
				</div>
			<? } ?>
		</div>
	</div>
<?
}
$ind++;
?>