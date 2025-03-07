<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
echo '<p class="nocomments">';
echo _e('This post is password protected. Enter the password to view comments.','lightword');
echo '</p>';
return;
}
// $comments_nr = lightword_fb_get_comment_type_count('comment');
// $trackbacks_nr = lightword_fb_get_comment_type_count('pings');
$oddcomment = 'alt ';
?>
<div id="tabsContainer">
<a href="#" class="tabs selected"><span><?php _e('Comments','lightword'); ?> (<?php echo get_comments_number($post->ID); ?>)</span></a>
<a href="#" class="tabs"><span><?php _e('Trackbacks','lightword'); ?> (<?php echo $trackbacks_nr; ?>)</span></a>
<span class="subscribe_comments"><?php post_comments_feed_link(__('( subscribe to comments on this post )','lightword')); ?></span>
<div class="clear_tab"></div>
<div class="tab-content selected">
<a name="comments"></a>

<?php if ( $comments ) : ?>
<div id="comentarii">
<ol class="commentlist">
<?php wp_list_comments('type=comment&callback=lightword_nested_comments'); ?>
</ol>

<?php if ((int) get_option('page_comments') === 1 && get_comment_pages_count() > 1): ?>
<div class="next_previous_links_comments">
<span class="alignleft"><?php previous_comments_link(__('&laquo; Older Comments','lightword')); ?></span>
<span class="alignright"><?php next_comments_link(__('Newer Comments &raquo;','lightword')); ?></span>
<div class="clear"></div>
</div>
<?php endif; ?>
</div>

<?php else : ?>
<?php if ('open' == $post->comment_status) : ?>
<p class="no"><?php _e('No comments yet.','lightword'); ?></p>
<?php else : // comments are closed ?>
<p class="no"><?php _e('Sorry, the comment form is closed at this time.','lightword'); ?></p>
<?php endif; ?>
<?php endif; ?>

 <?php if ($comments || comments_open()): ?>

<br/>

<?php
if ( function_exists('comment_form') ) {
comment_form(array(
                        'label_submit' => __('Submit','lightword'),
                        'title_reply' => 'Leave a comment',
                        'title_reply_to' => '',
                        'comment_notes_before' => '',
                        'comment_notes_after' => '',
                        'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
                        'cancel_reply_link'    => __( 'Cancel reply' )

                        ));
}else{
?>
<div id="respond">
<?php cancel_comment_reply_link(); ?>
<h2 style="background:transparent;"><?php comment_form_title( __('Leave a comment', 'lightword'), 'Reply' ); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__("You must be <a href=\"%s\">logged in</a> to post a comment.",'lightword'), get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()));?></p>
<?php else : ?>

<form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<?php if(function_exists('home_url')) $home_url = home_url(); else $home_url = get_bloginfo('url'); ?>
<p><?php printf(__('Logged in as %s.','lightword'), '<a href="'.$home_url.'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','lightword') ?>"><?php _e('Log out &raquo;','lightword'); ?></a></p>

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="1"></textarea></p>

<?php else : ?>


<p><textarea name="comment" id="comment" rows="10" tabindex="1"></textarea></p>
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name','lightword'); ?> <?php if ($req) _e('(required)','lightword'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('Mail (will not be published)','lightword');?> <?php if ($req) _e('(required)','lightword'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website','lightword'); ?></small></label></p>

<?php endif; ?>

<p><input name="submit" type="submit" id="submit" tabindex="4" accesskey="s" value="<?php echo esc_attr(__('Submit','lightword')); ?>" /><?php cancel_comment_reply_link(__('( Cancel )', 'lightword')); ?><br class="clear"/></p>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>
</div>
<?php } ?>


<?php endif; ?>
</div>

<div class="tab-content">
<?php if($trackbacks_nr == '0' && pings_open()) { echo '<p class="no">'; ?><?php _e('No trackbacks yet.','lightword'); ?><?php echo '</p>'; } ?>
<?php if(!pings_open()) { echo '<p class="no">'; ?><?php _e('Trackbacks are disabled.','lightword'); ?><?php echo '</p>'; } ?>
<?php foreach ($comments as $comment) : ?>
<?php $comment_type = get_comment_type(); ?>
<?php if($comment_type != 'comment') { ?>
<div class="trackbacks"><?php comment_author_link() ?></div>
<?php } ?>
<?php endforeach; ?>
</div>
</div>