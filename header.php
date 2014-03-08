<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title>
		<?php bloginfo('name'); // show the blog name, from settings ?> |
		<?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
	</title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css' />

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<script src="<?php echo get_bloginfo('template_url') . '/js/modernizr.custom.25376.js' ?>"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
	<div id="perspective" class="perspective effect-rotateleft">
		<div class="container">
			<div class="wrapper"><!-- wrapper needed for scroll -->

				<header id="masthead" role="banner">
					<div class="row">
						<div class="small-10 medium-6 columns">
							<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php echo get_template_directory_uri(); ?>/images/hope_alliance-logo.png" alt="Hope Alliance Church" />
							</a>
						</div>
						<div class="hide-for-medium-down medium-6 columns">
							<menu class="top-links">
							<?php if(is_active_sidebar('top_links'))
								dynamic_sidebar('top_links'); ?>
							</menu>
							<nav role="navigation" class="site-navigation main-navigation">
								<?php wp_nav_menu( array(
									'theme_location' 	=> 'primary',
									'menu_class' 			=> 'nav-menu',
									'container'				=> false
									) ); ?>
							</nav>
						</div>
						<div class="hide-for-large-up small-2 columns">
							<button id="show-menu" class="menu-trigger"></button>
						</div>
					</div>
				</header>