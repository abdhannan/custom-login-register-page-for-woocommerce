<?php
/**
 * Plugin Name: Custom Login Register Page for WooCommerce
 * Description: Allows separating WooCommerce login and registration forms into individual pages using shortcodes.
 * Version:     1.0.0
 * Author:      Abd Hannan
 * Author URI:  https://profiles.wordpress.org/abd-hannan/
 * Text Domain: custom-login-register-page-for-woocommerce
 * Domain Path: /languages
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.8
* Requires PHP: 7.4
* Requires Plugins: woocommerce
 */

defined( 'ABSPATH' ) || exit;

require_once plugin_dir_path( __FILE__ ) . 'includes/class-custlore.php';

function run_custlore_plugin() {
    $plugin = new CUSTLORE();
    $plugin->run();
}
run_custlore_plugin();
