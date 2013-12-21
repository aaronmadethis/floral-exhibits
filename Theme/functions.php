<?php
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 206, 206, true ); // default Post Thumbnail dimensions (cropped)
}	
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'about-grid', 170, 170, true );
	add_image_size( 'hero-home', 2000, 1400, false);
	add_image_size( 'solutions-home', 1000, 565, true );
	add_image_size( 'plans-floral-home', 331, 490, true );
}

if ( ! function_exists( 'fe_wp_setup' ) ) {
	function fe_wp_setup() {
		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array( 'primary' => 'Primary menu' ) );
	}
}
/**
 * Tell WordPress to run tjr_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'fe_wp_setup' );

/**
 * These two functions are for grabbing certain images from posts
*/
function post_first_image($post_id){
	
	$attachments = get_posts( array(
		'order'          => 'ASC',
		'orderby' 		 => 'menu_order ID',
		'post_type'      => 'attachment',
		'post_parent'    => $post_id,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
		'size'			 => 'thumbnail') 
	);
	return $attachments[0]->ID;	
	// return print_r($attachments);
}

if ( ! function_exists( 'post_all_images_data' ) ) {

	function post_all_images_data($post_id){
		$links =  array();

		$attachments = get_posts( array(
			'order' => 'DEC',
			'orderby' => 'menu_order ID',
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post_id )
		);

		return $attachments;
	}
}

/**
 * Get a category id using it's name / slug
*/
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

function red_color( $atts, $content = null ) {
	return '<span class="red_color">' . $content . '</span>';
}

add_shortcode( 'red_color', 'red_color' );

/**
 * Functions for removing image attributes from posts
 */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/**
 * Functions for adding javascripts
 */
add_action( 'template_redirect', 'my_script_enqueuer' );

function my_script_enqueuer() {
	wp_enqueue_script( 'jquery' );
	$modernizr_url = get_bloginfo('template_directory') . '/js/vendor/modernizr-2.6.1.min.js';
	wp_enqueue_script('modernizr', $modernizr_url);

	$display_script_url = get_bloginfo('template_directory') . '/js/display-0.1.js';
	$plugins = get_bloginfo('template_directory') . '/js/plugins-0.2.js';
	wp_enqueue_script('display_script', $display_script_url, array('jquery'), '', true);
	wp_enqueue_script('plugins', $plugins, array('jquery', 'modernizr'), '', true);
}

?>