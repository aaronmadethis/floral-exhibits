<?php

// -- register install script
register_activation_hook(__FILE__, 'fe_wp_carousel_install');

// -- register the deactivation script
register_deactivation_hook(__FILE__, 'fe_wp_carousel_deactivate');

// -- runs when plug-in is installed
function fe_wp_carousel_install(){
}

// -- run on uninstall deletes options
function fe_wp_carousel_deactivate() {
	// -- delete options
	// -- delete_option('total_columns');
}

// Load our custom assets.
add_action( 'admin_enqueue_scripts', 'fe_wp_carousel_assets');

function fe_wp_carousel_assets(){

}

// -- Set up the post types
add_action('init', 'fe_wp_carousel_regiser_post_types');

// -- Register Post Types function
function fe_wp_carousel_regiser_post_types(){

	// -- set arguments for the portfolio_page post type
	$fe_wp_pt_args = array(
		'public' => true,
		'query_var' => 'fe_carousel',
		'rewrite' => array(
				'slug' => 'sm/fe_carousel',
				'with_front' => false
		),
		'supports' => array(
			'title',
			'page-attributes'
		),
		'labels' => array(
			'name' => 'Home Carousel Items',
			'singular_name' => 'Carousel Item',
			'add_new' => 'Add a Carousel Item',
			'add_new_item' => 'Add a Carousel Item',
			'edit_item' => 'Edit a Carousel Item',
			'new_item' => 'New Carousel Item',
			'view_item' => 'View Carousel Items',
			'search_items' => 'Search Carousel Items',
			'not_found' => 'No Carousel Items Found',
			'not_found_in_trash' => 'No Carousel Items Found in Trash'
		),
		'capability_type' => 'page',
		'hierarchical' => true,
        // 'register_meta_box_cb' => 'add_portfolio_metaboxes',
        'taxonomies' => array( 'category' ),
        'has_archive'   => true
	);

	// -- register the portfolio post type
	register_post_type( 'fe_carousel', $fe_wp_pt_args );
}

