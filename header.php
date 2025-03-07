<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="shortcut icon" href="<?php global $path_to_favicon; echo ($path_to_favicon !== null) ? bloginfo('wpurl') . $path_to_favicon : get_template_directory_uri() . '/favicon.ico'; ?>" />
<!-- outdated in newer versions of wordpress  -->
<!-- <link rel="pingback" href="<?php //bloginfo('pingback_url'); ?>" /> -->
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php global $lw_header_content; echo "\n".$lw_header_content."\n"; ?>
<?php wp_enqueue_script('jquery'); ?>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<?php wp_head(); ?>
<script type="text/javascript">
	jQuery(window).on('load', function() { // web page has finished loading

    function isMobile() {
    var index = navigator.appVersion.indexOf("Mobile"); // detect chrome for android and ios safari
    var index2 = navigator.appVersion.indexOf("Android"); // detect firefox for android
    if (index2) { return (index2 > -1); }
    return (index > -1);
    }   

    usingmobile = isMobile();
    if (usingmobile || jQuery(window).width() < 800){
        jQuery("#searchform #s").attr('placeholder', 'Search');
    }

	});
 </script>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
<?php lightword_header_image(); ?>
<div id="header">
<?php lightword_rss_feed(); ?>

<div id="top_bar">
<div class="center_menu">
<?php # Top menu logic
global $lw_remove_searchbox, $lw_use_dumb_menu;
if( $lw_use_dumb_menu == 'true' || !function_exists('wp_nav_menu') ) { # Don't use WP custom menu
	lightword_dumb_menu();
} else {
	# Yay, we get to be fancy (and a bit lazy ;-)
	# No home button is auto-inserted; custom menus should be completely
	# defined by the menu and the menu only.
	#
	# Falls back to LightWord's "dumb" menu if something's amiss.
	$lw_menuclass = ( $lw_remove_searchbox == 'true' ) ? 'menu expand' : 'menu';
	wp_nav_menu( array( 'menu' => 'lightword_top_menu', 'echo' => true, 'menu_id' => 'front_menu', 'menu_class' => $lw_menuclass, 'container' => '', 'theme_location' => 'lightword_top_menu', 'link_before' => '<span>', 'link_after' => '</span>', 'fallback_cb' => 'lightword_dumb_menu' ) );
}
?>
</div>
<?php echo lightword_searchbox(); ?>
</div>

</div>
<div id="content">

	