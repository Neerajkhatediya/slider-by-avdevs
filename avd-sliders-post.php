<?php

/*
 * Plugin frontend scripts
 */
 
function plugin_frontend_scripts() {
	
	
	wp_enqueue_script( 'avd-sliders-jquery-js', AVD_PLUGIN_URL .'js/jquery.min.js');
	wp_enqueue_script( 'avd-sliders-bootstrap-js', AVD_PLUGIN_URL .'js/bootstrap.min.js');
        wp_enqueue_style('avd-sliders-bootstrap-css', AVD_PLUGIN_URL.'css/bootstrap.css');
        wp_enqueue_style('avd-sliders-bootstrap-cdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
}
add_action('init', 'plugin_frontend_scripts');

/*
 * Custom Post Type and Taxonomy
 */

add_action('init', 'slideshow_register');

function slideshow_register() {

    $labels = array(
        'name' => _x('Slides', 'post type general name'),
        'singular_name' => _x('Slideshow Item', 'post type singular name'),
        'add_new' => _x('Add New', 'slideshow item'),
        'add_new_item' => __('Add New Slideshow Item'),
        'edit_item' => __('Edit Slideshow Item'),
        'new_item' => __('New Slideshow Item'),
        'view_item' => __('View Slideshow Item'),
        'search_items' => __('Search Slideshow'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','thumbnail','editor'),
        'rewrite' => array('slug' => 'slideshow', 'with_front' => FALSE)
      ); 

    register_post_type( 'slideshow' , $args );

    $labels = array(
    'name' => _x( 'Sliders', 'taxonomy general name' ),
    'singular_name' => _x( 'Slider', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Sliders' ),
    'popular_items' => __( 'Popular Sliders' ),
    'all_items' => __( 'All Sliders' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Slider' ), 
    'update_item' => __( 'Update Slider' ),
    'add_new_item' => __( 'Add New Slider' ),
    'new_item_name' => __( 'New Slider Name' ),
    'separate_items_with_commas' => __( 'Separate Sliders with commas' ),
    'add_or_remove_items' => __( 'Add or remove Sliders' ),
    'choose_from_most_used' => __( 'Choose from the most used Sliders' ),
    'menu_name' => __( 'Sliders' ),
    ); 

	 
	register_taxonomy('Sliders','slideshow',array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'show_in_rest' => true,
	    'show_admin_column' => true,
	    'update_count_callback' => '_update_post_term_count',
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'Slider' ),
	));
}

?>
