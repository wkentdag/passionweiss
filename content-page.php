<?php 
if ( have_posts() ) : 

while ( have_posts() ) : the_post(); ?>
                    
<div class="page-article">
<!--title
<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tactics' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
<!--end title-->

<!-- post thumbnail-->
<?
if ( has_post_thumbnail() ):
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
list($imgwidth, $imgheight, $type, $attr) = getimagesize("$url");
?>
<a href="javascript: lightbox('<? echo $url; ?>','<? echo $imgwidth; ?>','<? echo $imgheight; ?>');">
<?
echo "<img src='$url' class='post-thumbnail' border='0' />";
?>
</a>
<?
//the_post_thumbnail();
endif;
?>
<!-- end post thumbnail-->

<!-- post content -->
<?php the_content(); ?>
<!-- end post content -->
         


</div><!--end article-->
<?php 
endwhile;
endif; ?> 