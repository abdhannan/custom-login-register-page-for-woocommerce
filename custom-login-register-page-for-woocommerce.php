<?php
/**
 * Plugin Name: Custom Login Register Page for WooCommerce
 * Description: Allows separating WooCommerce login and registration forms into individual pages using shortcodes.
 * Version:     1.0.0
 * Author:      Abd Hannan
 * Author URI:  https://abdhannan.codes
 * Text Domain: custom-login-register-page-for-woocommerce
 * Domain Path: /languages
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/class-wclrp.php';

function run_wclrp_plugin() {
    $plugin = new WCLRP();
    $plugin->run();
}
run_wclrp_plugin();
