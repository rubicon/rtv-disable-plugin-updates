<?php
defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'rubicon_register_menu' );

function rubicon_register_menu() {
    add_plugins_page(
        __( 'Ignored Plugins', 'rubicon-ignore-plugin-updates' ),
        __( 'Ignored Plugins', 'rubicon-ignore-plugin-updates' ),
        'manage_options',
        'rubicon-ignored-plugins',
        'rubicon_render_settings_page'
    );
}

function rubicon_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'rubicon-ignore-plugin-updates' ) );
    }

    // Ensure get_plugins() function is available.
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $all_plugins   = get_plugins();
    $ignored_plugins = get_option( 'rubicon_ignored_plugins', array() );
    ?>
    <div id="rubicon-header" class="rubicon-header sticky top-0 z-10 bg-gray-100 p-4 border-b border-gray-300">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold">
                    <?php _e( 'Rubicon: Ignore Plugin Updates', 'rubicon-ignore-plugin-updates' ); ?>
                    <span class="rubicon-version text-sm text-gray-600"><?php echo esc_html( 'v1.0.6' ); ?></span>
                </h1>
            </div>
            <div class="header-actions space-x-2">
                <button id="toggle-all-on" class="button bg-blue-600 text-white px-3 py-1 rounded"><?php _e( 'Toggle All On', 'rubicon-ignore-plugin-updates' ); ?></button>
                <button id="toggle-all-off" class="button bg-blue-600 text-white px-3 py-1 rounded"><?php _e( 'Toggle All Off', 'rubicon-ignore-plugin-updates' ); ?></button>
                <button id="reset-to-defaults" class="button bg-red-600 text-white px-3 py-1 rounded"><?php _e( 'Reset to Defaults', 'rubicon-ignore-plugin-updates' ); ?></button>
                <button id="save-changes" class="button bg-green-600 text-white px-3 py-1 rounded"><?php _e( 'Save Changes', 'rubicon-ignore-plugin-updates' ); ?></button>
            </div>
        </div>
        <div class="mt-2 flex space-x-4">
            <a href="https://wordpress.org/plugins/ignore-plugin-updates/" target="_blank" class="text-blue-600"><?php _e( 'Review', 'rubicon-ignore-plugin-updates' ); ?></a>
            <a href="#" class="text-blue-600"><?php _e( 'Translate', 'rubicon-ignore-plugin-updates' ); ?></a>
            <a href="https://rubicontv.com/docs" target="_blank" class="text-blue-600"><?php _e( 'Docs', 'rubicon-ignore-plugin-updates' ); ?></a>
            <a href="https://rubicontv.com/support" target="_blank" class="text-blue-600"><?php _e( 'Support', 'rubicon-ignore-plugin-updates' ); ?></a>
        </div>
    </div>
    <div class="rubicon-table mt-6">
        <div class="filters mb-4 space-x-2">
            <button class="filter bg-gray-200 px-2 py-1 rounded" data-filter="all"><?php _e( 'All', 'rubicon-ignore-plugin-updates' ); ?></button>
            <button class="filter bg-gray-200 px-2 py-1 rounded" data-filter="ignored"><?php _e( 'Ignored', 'rubicon-ignore-plugin-updates' ); ?></button>
            <button class="filter bg-gray-200 px-2 py-1 rounded" data-filter="not-ignored"><?php _e( 'Not Ignored', 'rubicon-ignore-plugin-updates' ); ?></button>
        </div>
        <form method="post" action="">
            <table class="widefat fixed striped">
                <thead>
                    <tr>
                        <th class="check-column">
                            <label class="toggle-switch inline-block">
                                <input type="checkbox" id="toggle-all" />
                                <span class="slider round"></span>
                            </label>
                        </th>
                        <th><?php _e( 'Plugin', 'rubicon-ignore-plugin-updates' ); ?></th>
                        <th><?php _e( 'Description', 'rubicon-ignore-plugin-updates' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $all_plugins as $plugin_file => $plugin_data ) : ?>
                        <tr class="plugin-row <?php echo in_array( $plugin_file, $ignored_plugins ) ? 'ignored' : 'not-ignored'; ?>">
                            <td class="check-column">
                                <label class="toggle-switch inline-block">
                                    <input type="checkbox" name="ignored_plugins[]" value="<?php echo esc_attr( $plugin_file ); ?>" <?php checked( in_array( $plugin_file, $ignored_plugins ) ); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><?php echo esc_html( $plugin_data['Name'] ); ?></td>
                            <td><?php echo wp_kses_post( $plugin_data['Description'] ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
    <?php
}
