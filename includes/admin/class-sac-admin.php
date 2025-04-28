<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class SAC_Admin {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	public function add_admin_menu() {
		add_menu_page(
			__( 'Service Availability', 'service-availability-calendar' ),
			__( 'Service Availability', 'service-availability-calendar' ),
			'manage_options',
			'service-availability',
			array( $this, 'all_availability_page' ),
			'dashicons-calendar-alt',
			20
		);

		add_submenu_page(
			'service-availability',
			__( 'Add Service Availability', 'service-availability-calendar' ),
			__( 'Add New', 'service-availability-calendar' ),
			'manage_options',
			'add-service-availability',
			array( $this, 'add_availability_page' )
		);

		add_submenu_page(
			null, // Hidden submenu for editing
			__( 'Edit Service Availability', 'service-availability-calendar' ),
			__( 'Edit Availability', 'service-availability-calendar' ),
			'manage_options',
			'edit-service-availability',
			array( $this, 'edit_availability_page' )
		);
	}

	public function add_availability_page() {
		require_once SAC_PLUGIN_PATH . 'includes/admin/views/add-availability.php';
	}

	public function all_availability_page() {
		require_once SAC_PLUGIN_PATH . 'includes/admin/views/all-availability.php';
	}

	public function edit_availability_page() {
		require_once SAC_PLUGIN_PATH . 'includes/admin/views/edit-availability.php';
	}

	public function enqueue_admin_scripts( $hook ) {
		if ( 'toplevel_page_service-availability' === $hook ||
			'service-availability_page_add-service-availability' === $hook ||
			'service-availability_page_edit-service-availability' === $hook ) {
			wp_enqueue_style( 'sac-admin-css', SAC_PLUGIN_URL . 'assets/css/sac-admin.css', array(), SAC_PLUGIN_VERSION );
			wp_enqueue_script( 'sac-admin-js', SAC_PLUGIN_URL . 'assets/js/sac-admin.js', array( 'jquery' ), SAC_PLUGIN_VERSION, true );
		}
	}
}
