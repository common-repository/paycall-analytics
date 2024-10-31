<?php

/**
 * Plugin Name: PayCall Analytics
 * Plugin URI: https://wordpress.org/plugins/paycall-analytics/
 * Description: PayCall google analytics integration
 * Author: PayCall
 * Author URI: https://www.paycall.co.il
 * Version: 1.0
 * Text Domain: paycall
 * License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


// Hook the 'wp_footer' action hook, add the function named 'mfp_Add_Text' to it
add_action("wp_footer", "paycall_add_script");
if (!function_exists('paycall_plugin_register_settings'))
{
    function paycall_plugin_register_settings()
    {

        register_setting('paycall_plugin_options_group', 'paycall_token');
    }
}
add_action('admin_init', 'paycall_plugin_register_settings');

if (!function_exists('paycall_add_script'))
{
    function paycall_add_script()
    {
        echo '<script id="ptoken" src="https://ws.callindex.co.il/campaign/send_analytics.js?ptoken=' . get_option('paycall_token') . '"></script>';
    }
}
add_action('admin_menu', 'paycall_plugin_setup_menu');

if (!function_exists('paycall_plugin_setup_menu'))
{
    function paycall_plugin_setup_menu()
    {
        add_menu_page('Paycall Analytics Page', 'Paycall Analytics', 'manage_options', 'paycall-plugin', 'paycall_init');
    }
}
if (!function_exists('paycall_init'))
{
    function paycall_init()
    {
        echo "<h1>Paycall Analytics</h1>";
        paycall_custom_page_html_form();
    }
}

//add_options_page('Custom Plugin', 'Custom Plugin Setting', 'manage_options', 'custom-plugin-setting-url', 'custom_page_html_form');
if (!function_exists('paycall_custom_page_html_form'))
{
    function paycall_custom_page_html_form()
    { ?>
        <div class="wrap">

            <form method="post" action="options.php">
                <?php settings_fields('paycall_plugin_options_group'); ?>

                <table class="form-table">

                    <tr>
                        <th><label for="first_field_id">Checkcall Token:</label></th>

                        <td>
                            <input type='text' class="regular-text" id="first_field_id" name="paycall_token" value="<?php echo get_option('paycall_token'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h1 style="color: red;">על מנת שהתוסף יעבוד כראוי יש לוודא שמוטמע באתר גוגל אנליטיקס </h1>
                        </td>
                    </tr>

                </table>

                <?php submit_button(); ?>

        </div>
<?php
    }
}

?>