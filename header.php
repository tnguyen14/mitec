<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package mitec
 * @since mitec 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<script type="text/javascript" src="http://fast.fonts.com/jsapi/7e158b78-d36c-416e-a793-6fa09d40e40f.js"></script>

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mitec' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<?php // adding page title as a class
$page_title = sanitize_title(get_the_title());?>

<body <?php body_class($page_title); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=535772989768560";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="top-links">
			<h1 class="links-toggle">Energy Links</h1>
			<ul class="links">
				<li><a href="http://mitenergyconference.com/">Energy Conference</a></li>
				<li><a href="http://cep.mit.edu/">Clean Energy Prize</a></li>
				<li><a href="http://mitenergynight.org/">Energy Night</a></li>
				<li><a href="http://www.mitenergyfinanceforum.org/">Energy Finance Forum</a></li>
			</ul>
		</div><!-- .top-links -->

		<div class="main-header">
			<a class="site-title" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<div class="member-login"><a href="https://www.energyfolks.com/accounts/Login">Member Log In</a></div>
		</div><!-- .main-header -->

		<div class="nav-wrapper">
			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'mitec' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mitec' ); ?>"><?php _e( 'Skip to content', 'mitec' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->
		</div><!-- .nav-wrapper -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">