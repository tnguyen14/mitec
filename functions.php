<?php
/**
 * mitec functions and definitions
 *
 * @package mitec
 * @since mitec 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since mitec 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'mitec_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since mitec 1.0
 */
function mitec_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on mitec, use a find and replace
	 * to change 'mitec' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mitec', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mitec' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	/**
	* add image sizes
	*/

	add_image_size('cover-photo', 1400, 9999);
	add_image_size('timely-content', 230, 110, true);
	add_image_size('homepage-module', 280, 145, true);
	add_image_size('sponsor-logo', 175, 120);
	add_image_size('team-member', 120, 120, true);
	add_image_size('310x120', 310, 120, true);
}
endif; // mitec_setup
add_action( 'after_setup_theme', 'mitec_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since mitec 1.0
 */
function mitec_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mitec' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'mitec_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function mitec_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// bxslider css
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri().'/inc/bxslider/jquery.bxslider.css' );
	// fancybox css
	wp_enqueue_style( 'fancybox-css', get_template_directory_uri().'/inc/fancybox/jquery.fancybox.css' );
	// main stylesheet
	wp_enqueue_style( 'main', get_template_directory_uri().'/css/style.css' );


	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'jquery-tools', get_template_directory_uri(). '/js/jquery.tools.min.js', array( 'jquery' ), '1.2.7', true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri(). '/inc/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.0', true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri(). '/inc/fancybox/jquery.fancybox.pack.js', array(), '', true );

	wp_enqueue_script( 'scripts', get_template_directory_uri(). '/js/scripts.min.js', array( 'jquery', 'jquery-tools' ), '0.1', true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'mitec_scripts' );

/** Excerpt more link
 *
 */
function new_excerpt_more($more) {
       global $post;
	return '<a class="learn-more" href="'. get_permalink( $post->ID ) . '"> Learn More &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Change the order of team members to arrange by menu order
 *
 */
function mitec_team_members_order( $query ) {
	if ( ( $query->is_post_type_archive( 'team_members' ) || is_tax( 'teams' ) ) && $query->is_main_query() ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
		if ( $query->is_post_type_archive( 'team_members' ) ):
			$query->set( 'tax_query', array(
					array(
						'taxonomy' 	=> 'teams',
						'field'		=> 'slug',
						'terms'		=> 'executive-team'
					)
				)
			);
		endif;
	}
}
add_action( 'pre_get_posts', 'mitec_team_members_order' );

/** Get calendar events in Boston are.
 * Used in homepage
 * @return JSON object
 */
function get_ef_events( $url ) {
	$events_raw = file_get_contents( $url );
	$events_json = json_decode( $events_raw );

	return $events_json;
}

/** Add custom meta box for for featured post
 *
 */
function mitec_add_featured_post_meta() {
	$post_types = array( 'post' );
	foreach ( $post_types as $post_type ) {
		//  add_meta_box( $id, $title, $callback, $post_type, $context, $priority, $callback_args );
		add_meta_box( 'mitec_featured_post', __( 'Featured Post' ), 'featured_post_meta_inner', $post_type, 'side', 'high' );
	}
}

/** Display the featured post box content
 *
 */
function featured_post_meta_inner() {
	global $post;
	// Use nonce for verification
	// wp_nonce_field( $action, $name, $referer, $echo )
	$nonce_name = 'mitec_featured_post_' . $post->ID . '_nonce';
	$nonce_action = 'add_featured_post_' . $post->ID;
	wp_nonce_field( $nonce_action, $nonce_name );

	$meta_value = get_post_meta( $post->ID, 'mitec_blog_featured_post', true );
	echo '<label for="featured_post">';
	echo '<input type="checkbox" id="featured-post" name="mitec_blog_featured_post" value="1" ' . checked( 1, $meta_value, false ) . ' />';
	echo ' Feature this post </label>';
}

function mitec_save_featured_post_meta( $post_id ) {
	$nonce_name = 'mitec_featured_post_' . $post_id . '_nonce';
	$nonce_action = 'add_featured_post_' . $post_id;

	 // First we need to check if the current user is authorised to do this action.
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ){
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	// wp_verify_nonce( $nonce, $action );
	// Secondly we need to check if the user intended to change this value.
	if ( ! isset( $_POST[$nonce_name] ) || ! wp_verify_nonce( $_POST[$nonce_name], $nonce_action ) ) {
		return;
	}

	$meta_value = $_POST['mitec_blog_featured_post'];

	// update_post_meta($post_id, $meta_key, $meta_value, $prev_value);
	update_post_meta( $post_id, 'mitec_blog_featured_post', $meta_value );
}

add_action( 'add_meta_boxes', 'mitec_add_featured_post_meta' );
add_action( 'save_post', 'mitec_save_featured_post_meta' );


