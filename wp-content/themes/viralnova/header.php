<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CloneTemplates
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper clearfix">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'clonetemplates' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header clearfix">
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">&nbsp;</a>
		
			<form method="get" action="<?php echo home_url( '/' ); ?>">
				<input class="search" placeholder="<?php _e( 'what are you looking for?', 'clonetemplates' ); ?>" value="<?php echo get_search_query() ?>" name="s" type="text">			
			</form>
			<div class="top-social">
				<div class="social">
					<?php ct_social_profile();?>
				</div>		
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="nav-box">
		<button class="menu-toggle"><?php _e( 'Primary Menu', 'clonetemplates' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav', 'menu_id' => 'navCategoryLinks' ) ); ?>
	</div>

	<div id="content" class="content clearfix">
