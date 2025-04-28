<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class SAC_Post_Types {

	public function __construct() {
		add_action( 'init', array( $this, 'register_service_availability_post_type' ) );
	}

	public function register_service_availability_post_type() {
		$labels = array(
			'name'               => _x( 'Service Availabilities', 'Post Type General Name', 'service-availability-calendar' ),
			'singular_name'      => _x( 'Service Availability', 'Post Type Singular Name', 'service-availability-calendar' ),
			'menu_name'          => __( 'Service Availability', 'service-availability-calendar' ),
			'parent_item_colon'  => __( 'Parent Service Availability:', 'service-availability-calendar' ),
			'all_items'          => __( 'All Service Availability', 'service-availability-calendar' ),
			'view_item'          => __( 'View Service Availability', 'service-availability-calendar' ),
			'add_new_item'       => __( 'Add New Service Availability', 'service-availability-calendar' ),
			'add_new'            => __( 'Add New', 'service-availability-calendar' ),
			'edit_item'          => __( 'Edit Service Availability', 'service-availability-calendar' ),
			'update_item'        => __( 'Update Service Availability', 'service-availability-calendar' ),
			'new_item'           => __( 'New Service Availability', 'service-availability-calendar' ),
			'separate_items_with_commas' => __( 'Separate service availabilities with commas', 'service-availability-calendar' ),
			'search_items'       => __( 'Search Service Availabilities', 'service-availability-calendar' ),
			'not_found'          => __( 'No service availabilities found', 'service-availability-calendar' ),
			'not_found_in_trash' => __( 'No service availabilities found in Trash', 'service-availability-calendar' ),
			'items_list'         => __( 'Service availabilities list', 'service-availability-calendar' ),
			'items_list_navigation' => __( 'Service availabilities list navigation', 'service-availability-calendar' ),
			'filter_items_list'  => __( 'Filter service availabilities list', 'service-availability-calendar' ),
		);
		$args   = array(
			'label'               => __( 'Service Availability', 'service-availability-calendar' ),
			'description'         => __( 'Manages service availability entries.', 'service-availability-calendar' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ), // You can add more supports like 'editor' if needed
			'hierarchical'        => false,
			'public'              => false, // Make it non-publicly queryable
			'show_ui'             => true, // Show in admin UI
			'show_in_menu'        => true, // Show in the admin menu
			'menu_position'       => 20, // Adjust the menu position
			'menu_icon'           => 'dashicons-calendar-alt', // Use a relevant dashicon
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'post', // Use standard post capabilities
		);
		register_post_type( 'service_availability', $args );
	}

}

new SAC_Post_Types();