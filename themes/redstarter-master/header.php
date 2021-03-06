<?php
/**
 * The header for our theme.
 *
 * @package RED_Starter_Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html( 'Skip to content' ); ?></a>

			<header id="masthead" class="site-header" role="banner">
				

				<nav id="site-navigation" class="main-navigation space-between grey-border-bottom padding-bottom-med border-edge" role="navigation">
					<div class="home-logo"> 
					<a href="http://localhost:8888/wordpress/">
						<img class="nav-home home-white" src="http://localhost:8888/wordpress/wp-content/themes/redstarter-master/assets/images/logos/inhabitent-logo-tent-white.svg">
						<img class="nav-home home-green" src="http://localhost:8888/wordpress/wp-content/themes/redstarter-master/assets/images/logos/inhabitent-logo-tent.svg">
					</a>
					</div>

					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html( 'Primary Menu ' ); ?></button>
					

					<div class="flex">
					<?php wp_nav_menu( array( 'theme_location ' => 'primary ', 'menu_id ' => ' primary-menu ' ) ); ?>
					</div>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->

			<div id="content" class="site-content">
