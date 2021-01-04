<?php
/*
Plugin Name: Slider AVDevs
Description: WordPress plugin to create a slider & display it with shortcode [avd_slideshow sliderid="" count="" orderby="" order=""].
Version: 1.0
Text Domain: slider-avdevs
Author: AVDevs
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AVD_PLUGIN_URL', plugin_dir_url( __FILE__) );
define( 'AVD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'AVD_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'AVD_PLUGIN_VERSION', '1.0' );

/* ---------------------------------------------------------------------------
 * Load the plugin required files
 * --------------------------------------------------------------------------- */
add_action( 'plugins_loaded','avd_sliders_plugin_load_function' );

if ( ! function_exists( 'avd_sliders_plugin_load_function' ) ) :
	function avd_sliders_plugin_load_function(){
		require_once( 'avd-sliders-post.php' );
		require_once( 'avd-sliders-shortcode.php' );
		
	}
endif;

/* ---------------------------------------------------------------------------
 * Activate AVDevs-Slider Plugin
 * --------------------------------------------------------------------------- */

register_activation_hook(__FILE__,'avd_sliders_plugin_enabled');

if ( ! function_exists( 'avd_sliders_plugin_enabled' ) ) :
	function avd_sliders_plugin_enabled() {	
			 
		
	}
endif;

/* ---------------------------------------------------------------------------
 * Deactivate AVDevs-Slider Plugin
 * --------------------------------------------------------------------------- */

if ( function_exists('register_deactivation_hook') )
	register_deactivation_hook(__FILE__,'avd_sliders_plugin_deactivated'); 

if ( ! function_exists( 'avd_sliders_plugin_deactivated' ) ) :
	function avd_sliders_plugin_deactivated() { 
		
		// Clear any cached data
		wp_cache_flush();
		
	}
endif;

/* ---------------------------------------------------------------------------
 * Uninstall AVDevs-Slider Plugin
 * --------------------------------------------------------------------------- */

if ( function_exists('register_uninstall_hook') )
	register_uninstall_hook(__FILE__,'avd_sliders_plugin_droped'); 

if ( ! function_exists( 'avd_sliders_plugin_droped' ) ) :
	function avd_sliders_plugin_droped() { 
	 $args = array (
	    'post_type' => 'slideshow',
	    'nopaging' => true
	  );
	  $query = new WP_Query ($args);
	  while ($query->have_posts ()) {
	    $query->the_post ();
	    $id = get_the_ID ();
	    wp_delete_post ($id, true);
	  }
	  wp_reset_postdata ();
	
		
	}
endif;




?>
