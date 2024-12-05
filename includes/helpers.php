<?php
defined( 'ABSPATH' ) || exit;

add_action( 'admin_init', 'rtv_register_settings' );

function rtv_register_settings() {
    register_setting( 'rtv_settings_group', 'rtv_ignored_plugins' );
}
