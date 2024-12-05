<?php
defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'rtv_register_menu' );

function rtv_register_menu() {
    add_plugins_page( 
        'Ignored Plugins', 
        'Ignored Plugins', 
        'manage_options', 
        'rtv-ignored-plugins', 
        'rtv_render_settings_page' 
    );
}

function rtv_render_settings_page() {
    $all_plugins = get_plugins();
    $ignored_plugins = get_option( 'rtv_ignored_plugins', [] );
    ?>
    <div class="wrap">
        <h1>RTV Disable Plugin Updates</h1>
        <p>This plugin allows you to manage which plugins should be ignored for updates.</p>

        <table class="table-container">
            <thead>
                <tr>
                    <th class="toggle-column">Ignore</th>
                    <th class="plugin-column">Plugin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $all_plugins as $path => $plugin ): ?>
                    <tr>
                        <td class="toggle-column">
                            <label class="toggle-switch">
                                <input type="checkbox" name="rtv_ignored_plugins[]" value="<?php echo esc_attr( $path ); ?>" <?php checked( in_array( $path, $ignored_plugins ) ); ?>>
                                <span class="toggle-slider"></span>
                            </label>
                        </td>
                        <td class="plugin-column">
                            <strong><?php echo esc_html( $plugin['Name'] ); ?></strong><br />
                            <span><?php echo esc_html( $plugin['Description'] ); ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="submit" class="button-primary" value="Save Changes" />
    </div>
    <?php
}
?>
