<?php get_header(); ?>
<div id="content-body">
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
<div class="mobile"><?php get_search_form(); ?></div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php if (function_exists('post_class')) post_class(); else print 'class="post"'; ?> id="post-<?php the_ID(); ?>">
<?php lightword_show_sidebox(); ?>
<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php edit_post_link(__('Edit this post','lightword'), '<span class="edit_content">', '</span>'); ?>
<?php lightword_simple_date(); ?>
<?php lightword_adsense_spot(); // you can add the adsense code via theme settings ?>
<?php if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { the_post_thumbnail(array( 200,200 ), array( 'class' => 'alignleft' )); } ?>
<?php the_content(''); ?>
<?php if(function_exists('wp_print')) { print_link(); } ?>
<?php wp_link_pages('before=<div class="nav_link">'.__('PAGES','lightword').': &after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>

<?php if ($lw_enjoy_post == 'true' && is_attachment() != TRUE) : ?>
<div class="promote clear">
<h3><?php _e('Enjoy this article?','lightword'); ?></h3>
<p><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Consider subscribing to our RSS feed!','lightword'); ?></a></p>
</div>
<?php endif; ?>

<?php if ($lw_post_author == 'Single page' || $lw_post_author == 'Both' && is_attachment() != TRUE) : ?>
<div class="about_author">
<h4><?php _e('Posted by','lightword'); ?> <a href="<?php the_author_meta('url'); ?> "><?php the_author(); ?></a></h4>
</div>
<?php endif; ?>

<div class="cat_tags clear">
<span class="category"><?php if($lw_disable_tags == 'true' || !get_the_tags()) { _e('Filed under:','lightword'); echo ' '; the_category(', ');} else if (get_the_tags() && $lw_disable_tags == 'false') { _e('Tagged as:','lightword'); echo ' '; the_tags(''); } ?></span>
<span class="continue desktop"><a class="nr_comm_spot" href="<?php the_permalink(); ?>#respond"><?php if('open' != $post->comment_status) _e('Comments Off','lightword'); else _e('Leave a comment','lightword'); ?></a></span><div class="clear"></div>
</div>
<div class="cat_tags_close"></div>


</div>

<?php comments_template(); ?>

<div class="next_previous_links">
<span class="alignleft"><?php next_post_link(); ?></span>
<span class="alignright"><?php previous_post_link(); ?></span>
<div class="clear"></div>

</div>
<?php endwhile; else: ?>

<h2><?php _e('Not Found','lightword'); ?></h2>
<p><?php  _e('Sorry, but you are looking for something that isn\'t here.','lightword'); ?></p>

<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>