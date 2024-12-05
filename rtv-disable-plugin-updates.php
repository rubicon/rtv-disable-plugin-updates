<?php
/**
 * RTV Disable Plugin Updates
 * 
 * @package           RTVDisablePluginUpdates
 * @author            Dax Davis
 * @copyright         2024 Dax Davis
 * @license           GPL-2.0-or-later
 * 
 * @wordpress-plugin
 * Plugin Name:       RTV Disable Plugin Updates
 * Plugin URI:        https://rubicontv.com
 * Description:       A WordPress plugin to manage and disable updates for selected plugins.
 * Version:           1.0.5
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Dax Davis
 * Author URI:        https://rubicontv.com
 * Text Domain:       rtv-disable-plugin-updates
 * Domain Path:       /languages
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://rubicontv.com/plugins/ignore-plugins
 */
 
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include required files.
require_once plugin_dir_path( __FILE__ ) . 'includes/settings-page.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/helpers.php';

/**
 * Add a "Settings" link to the plugin actions on the plugins page.
 *
 * @param array $links An array of action links.
 * @return array Modified action links.
 */
function rtv_plugin_action_links( $links ) {
    $settings_link = '<a href="admin.php?page=rtv-ignored-plugins">' . __( 'Settings', 'rtv-disable-plugin-updates' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'rtv_plugin_action_links' );

/**
 * Filter to disable plugin updates for the selected plugins.
 *
 * @param object $value The site transient holding plugin update data.
 * @return object Modified site transient.
 */
function rtv_disable_plugin_updates( $value ) {
    $ignored_plugins = get_option( 'rtv_ignored_plugins', [] );

    if ( isset( $value ) && is_object( $value ) && isset( $value->response ) ) {
        foreach ( $ignored_plugins as $plugin ) {
            if ( isset( $value->response[ $plugin ] ) ) {
                unset( $value->response[ $plugin ] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'rtv_disable_plugin_updates' );
