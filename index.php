<?php get_header(); ?>
<div id="content-body">
<?php if (function_exists('wp_snap')) { echo wp_snap(); } ?>

<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

<div class="mobile"><?php get_search_form(); ?></div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php if (function_exists('post_class')) post_class(); else print 'class="post"'; ?> id="post-<?php the_ID(); ?>">
<?php lightword_show_sidebox(); ?>
<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<div class="mobile"><?php echo get_the_time('F j, Y', $post); ?></div>
<?php lightword_simple_date(); ?>

<?php if ($lw_post_author == 'Main page' || $lw_post_author == 'Both') : ?>
<div class="about_author">
<h4><?php _e('Posted by','lightword'); ?> <a href="<?php the_author_meta('url'); ?>"><?php the_author(); ?></a></h4>
</div>
<?php endif; ?>
<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { the_post_thumbnail(array( 200,200 ), array( 'class' => 'alignleft' )); } ?>
<?php the_content(''); ?>
<?php if(function_exists('wp_print')) { print_link(); } ?>
<?php wp_link_pages('before=<div class="nav_link">'.__('PAGES','lightword').': &after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>

<div class="cat_tags clear">
<span class="category mobile" style="text-align: right;"><?php echo wp_count_comments($post->id)->approved." comments"; ?></span>
<span class="category"><?php if($lw_disable_tags == 'true' || !get_the_tags()) { _e('Filed under:','lightword'); echo ' '; the_category(', ');} else if (get_the_tags() && $lw_disable_tags == 'false') { _e('Tagged as:','lightword'); echo ' '; the_tags(''); } ?></span>
<span class="continue desktop"><?php $pos = strpos($post->post_content, '<!--more-->'); if($pos==''){ ?><a class="nr_comm_spot" href="<?php the_permalink(); ?>#comments"><?php 
// var_dump(wp_count_comments($post->id)->approved); exit();
if(wp_count_comments($post->id)->approved ==1 ) { _e('1 Comment','lightword');
} elseif('open' != $post->comment_status) { _e('Comments Off','lightword'); 
} elseif(wp_count_comments($post->id)->approved == 0) { _e('No Comments','lightword'); 
} else { echo wp_count_comments($post->id)->approved." Comments"; } ?></a>
 <?php } else { ?>
	<a title="<?php _e('Read more about','lightword'); ?> 
	<?php the_title(); ?>" href="<?php the_permalink() ?>#more-<?php echo $id; ?>">
 	<?php _e('Continue reading','lightword'); ?></a>
 <?php } ?>
</span><div class="clear"></div>
</div>
<div class="cat_tags_close"></div>
</div>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<h2><?php _e('Not Found','lightword'); ?></h2>
<p><?php  _e('Sorry, but you are looking for something that isn\'t here.','lightword'); ?></p>

<?php endif; ?>


<?php
if ( !function_exists('wp_pagenavi') ) {
?>
<div class="newer_older">
<span class="newer">&nbsp;<?php previous_posts_link(__('&laquo; Newer Entries','lightword')) ?></span>
<span class="older">&nbsp;<?php next_posts_link(__('Older Entries &raquo;','lightword')) ?></span>
</div>
<?php
}else{
wp_pagenavi();
}
?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>