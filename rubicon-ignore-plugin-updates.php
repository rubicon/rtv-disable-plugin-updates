<?php
/**
 * Rubicon: Ignore Plugin Updates
 *
 * This plugin allows WordPress administrators to selectively ignore automatic updates for specific plugins.
 * By enabling update ignore status on chosen plugins, it helps prevent unwanted updates that could disrupt
 * custom configurations or cause compatibility issues. The plugin provides a modern, responsive settings page
 * with Tailwind CSS–styled toggle switches, persistent settings storage, JSON import/export capabilities, and
 * robust logging integration with popular activity log plugins.
 *
 * @package           RubiconIgnorePluginUpdates
 * @version           1.0.7
 * @author            Dax Davis
 * @copyright         2024 Dax Davis. All rights reserved.
 * @license           GPL-2.0-or-later
 * @link              https://rubicontv.com
 *
 * @wordpress-plugin
 * Plugin Name:       Rubicon: Ignore Plugin Updates
 * Plugin URI:        https://rubicontv.com/plugins/ignore-plugin-updates
 * Description:       Rubicon: Ignore Plugin Updates is a comprehensive WordPress plugin that empowers administrators to selectively ignore automatic updates for specific plugins. This helps maintain compatibility and prevent disruptions. The plugin features a modern settings page with Tailwind CSS–styled toggle switches, persistent settings, JSON import/export capabilities, and logging integration with popular activity log plugins.
 * Version:           1.0.7
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Dax Davis
 * Author URI:        https://rubicontv.com
 * Text Domain:       rubicon-ignore-plugin-updates
 * Domain Path:       /languages
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://wordpress.org/plugins/ignore-plugin-updates/
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include required files.
require_once plugin_dir_path( __FILE__ ) . 'includes/settings-page.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/helpers.php';

/**
 * Load the plugin's text domain for translation.
 *
 * @return void
 */
function rubicon_load_textdomain() {
    load_plugin_textdomain( 'rubicon-ignore-plugin-updates', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'rubicon_load_textdomain' );

/**
 * Logs changes to the ignored plugins list.
 *
 * This function checks for the existence of logging functions provided by popular logging plugins
 * (such as WP Activity Log, Sucuri Scanner, Activity Log, Simple History, User Activity Log, and Stream)
 * and uses them to record log entries when changes are made.
 *
 * @param string $message The log message.
 * @return void
 */
function rubicon_log_change( $message ) {
    if ( function_exists( 'wal_log' ) ) {
        wal_log( $message );
    } elseif ( function_exists( 'sucuri_scanner_log' ) ) {
        sucuri_scanner_log( $message );
    } elseif ( function_exists( 'activity_log_add_entry' ) ) {
        activity_log_add_entry( $message );
    } elseif ( function_exists( 'simple_history_log' ) ) {
        simple_history_log( $message );
    } elseif ( function_exists( 'ual_add_log' ) ) {
        ual_add_log( $message );
    } elseif ( function_exists( 'stream_log' ) ) {
        stream_log( $message );
    }
}

/**
 * Register uninstall hook to clean up plugin options.
 *
 * @return void
 */
register_uninstall_hook( __FILE__, 'rubicon_plugin_uninstall_cleanup' );
function rubicon_plugin_uninstall_cleanup() {
    delete_option( 'rubicon_ignored_plugins' );
}

/**
 * Add a "Settings" link to the plugin action links on the Plugins page.
 *
 * @param array $links An array of existing action links.
 * @return array Modified array including the Settings link.
 */
function rubicon_plugin_action_links( $links ) {
    $settings_link = '<a href="admin.php?page=rubicon-ignored-plugins">' . __( 'Settings', 'rubicon-ignore-plugin-updates' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'rubicon_plugin_action_links' );
