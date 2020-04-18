<?php
/**
 * Extend GiveWP
 *
 * @package     spiralWebDb\ExtendGiveWP
 * @author      Robert A. Gadon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:         Extend GiveWP
 * Plugin URI:          https://github.com/rgadon107/cornerstone/plugins/extend-give-wp/
 * Description:         Extends the GiveWP donation plugin by rendering added custom content to the donation form.
 * Version:             1.0.2
 * Requires at least:   4.7
 * Requires PHP:        5.6
 * Author:              Robert A. Gadon
 * Author URI:          https://spiralwebdb.com
 * Text Domain:         extend-give-wp
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace spiralWebDb\ExtendGiveWP;

defined( 'ABSPATH' ) || exit;

/**
 * Get the absolute path to the plugin's root directory.
 *
 * @since  1.0.0
 *
 * @return string Absolute path to the plugin's root directory.
 * @ignore
 * @access private
 */
function _get_plugin_dir() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

/**
 * Checks if this plugin is in development mode.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return bool
 */
function _is_in_development_mode() {
	return defined( WP_DEBUG ) && WP_DEBUG === true;
}

/*
 *  Registers the plugin with WordPress activation, deactivation, and uninstall hooks.
 *
 *  @since 1.0.0
 *
 *  @return void
 */
function register_plugin() {

	register_activation_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
	register_deactivation_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
	register_uninstall_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 * @return void
 */
function autoload_files() {
	$files = [
		'/src/admin/option-settings-admin.php',
		'/src/support/load-assets.php',
	];

	foreach ( $files as $filename ) {
		require _get_plugin_dir() . $filename;
	}
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	autoload_files();

	register_plugin();
}

launch();
