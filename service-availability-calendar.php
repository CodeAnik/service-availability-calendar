<?php
/**
 * Plugin Name: Service Availability using Calendar
 * Plugin URI: https://dgency.com
 * Description: Manages and displays service availability with a calendar integration.
 * Version: 2.0.1
 * Author: Anik Khan
 * Author URI: codeanik.github.io/portfolio
 * License: GPLv2 or later
 * Text Domain: service-availability-calendar
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define plugin constants.
 */
define( 'SAC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SAC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SAC_PLUGIN_VERSION', '1.0.0' );

/**
 * Include the main plugin class.
 */
require_once SAC_PLUGIN_PATH . 'includes/class-sac-plugin.php';

/**
 * Activation and deactivation hooks.
 */
register_activation_hook( __FILE__, array( 'SAC_Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'SAC_Plugin', 'deactivate' ) );

/**
 * Initialize the plugin.
 */
function run_service_availability_calendar() {
	$plugin = new SAC_Plugin();
	$plugin->run();
}
run_service_availability_calendar();


// Register custom post type for service availability (hidden from UI)
function sac_register_service_availability_post_type() {
    register_post_type('service_availability', array(
        'labels' => array(
            'name'          => __('Service Availabilities', 'service-availability-calendar'),
            'singular_name' => __('Service Availability', 'service-availability-calendar'),
        ),
        'public'            => false,
        'show_ui'           => false,
        'supports'          => array('title'),
        'has_archive'       => false,
    ));
}
add_action('init', 'sac_register_service_availability_post_type');
