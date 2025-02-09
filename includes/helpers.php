<?php
defined( 'ABSPATH' ) || exit;

add_action( 'admin_init', 'rubicon_register_settings' );

/**
 * Registers the plugin settings in the WordPress Options API.
 *
 * @return void
 */
function rubicon_register_settings() {
    register_setting( 'rubicon_settings_group', 'rubicon_ignored_plugins' );
}
