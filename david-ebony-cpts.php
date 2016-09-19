<?php
/*
Plugin Name: David Ebony Custom Post Types
Description: Declares three custom post types for davidebony.com
Version: 1.0
Author: Sokhi Wagner
*/

add_action('init', 'davidebony_register_my_cpts');

function davidebony_register_my_cpts() {
	register_post_type('shop_item', array(
		'label' => 'Shop Items',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'shop', 'with_front' => false),
		'query_var' => true,
		'has_archive' => 'shop',
		'supports' => array('title','editor','thumbnail'),
        'taxonomies' => array( '' ),
        'menu_icon'    => 'dashicons-cart',
		'menu_position' => 20,
		'labels' => array (
			'name' => 'Shop Items',
			'singular_name' => 'Shop Item',
			'menu_name' => 'Shop Items',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Shop Item',
			'edit' => 'Edit',
			'edit_item' => 'Edit Shop Item',
			'new_item' => 'New Item',
			'view' => 'View Item',
			'view_item' => 'View Item',
			'search_items' => 'Search Shop Items',
			'not_found' => 'No Item Found',
			'not_found_in_trash' => 'No Item Found in Trash',
			'parent' => 'Parent',
			) //end labels
		) //end register array
	); //end register shop_item

	register_post_type('film_music', array(
		'label' => 'Film Music Items',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'film-and-music', 'with_front' => false),
		'query_var' => true,
		'has_archive' => 'film-and-music',
		'supports' => array('title','editor','thumbnail'),
        'taxonomies' => array( '' ),
        'menu_icon'    => 'dashicons-admin-media',
		'menu_position' => 20,
		'labels' => array (
			'name' => 'Film-Music Items',
			'singular_name' => 'Film-Music Item',
			'menu_name' => 'Film-Music Items',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Film-Music Item',
			'edit' => 'Edit',
			'edit_item' => 'Edit Film-Music Item',
			'new_item' => 'New Film-Music Item',
			'view' => 'View Film-Music Item',
			'view_item' => 'View Film-Music Item',
			'search_items' => 'Search Film-Music Items',
			'not_found' => 'No Item Found',
			'not_found_in_trash' => 'No Item Found in Trash',
			'parent' => 'Parent',
			) //end labels
		) //end register array
	); //end register film_music

	register_post_type('guest_artist', array(
		'label' => 'Guest Artists',
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'guest-artist', 'with_front' => false),
		'query_var' => true,
		'has_archive' => false,
		'supports' => array('title','editor','thumbnail'),
        'taxonomies' => array( '' ),
        'menu_icon'    => 'dashicons-art',
		'menu_position' => 20,
		'labels' => array (
			'name' => 'Guest Artists',
			'singular_name' => 'Guest Artist',
			'menu_name' => 'Guest Artist',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Guest Artist',
			'edit' => 'Edit',
			'edit_item' => 'Edit Guest Artist',
			'new_item' => 'New Guest Artist',
			'view' => 'View Guest Artist',
			'view_item' => 'View Guest Artist',
			'search_items' => 'Search Guest Artist',
			'not_found' => 'No Item Found',
			'not_found_in_trash' => 'No Item Found in Trash',
			'parent' => 'Parent',
			) //end labels
		) //end register array
	);  //end register guest_artist

} // end davidebony_register_my_cpts

/**
 * Flush rewrite rules to make custom URLs active
 */
function davidebony_rewrite_flush() {
    davidebony_register_my_cpts(); //
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'davidebony_rewrite_flush' );


?>
