<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Main plugin class.
 */
class SAC_Plugin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->load_dependencies();
	}

	/**
	 * Load required core classes.
	 */
	private function load_dependencies() {
		require_once SAC_PLUGIN_PATH . 'includes/class-sac-post-types.php';
		require_once SAC_PLUGIN_PATH . 'includes/admin/class-sac-admin.php';
		require_once SAC_PLUGIN_PATH . 'includes/public/class-sac-public.php';
		// Include other necessary files here
	}

	/**
	 * Run the plugin.
	 */
	public function run() {
		// Initialize admin and public classes
		new SAC_Admin();
		new SAC_Public();
	}

	/**
	 * Plugin activation hook.
	 */
	public static function activate() {
		// Perform actions on plugin activation (e.g., create database tables)
	}

	/**
	 * Plugin deactivation hook.
	 */
	public static function deactivate() {
		// Perform actions on plugin deactivation
	}

}