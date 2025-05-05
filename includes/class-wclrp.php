<?php
class WCLRP {
    const VERSION         = '1.0.0';
    const TEXT_DOMAIN     = 'custom-login-register-page-for-woocommerce';
    const OPTION_PREFIX   = 'wclrp_';
    const SETTINGS_GROUP  = 'wclrp_settings_group';
    const SLUG            = 'custom-login-register-page-for-woocommerce';

    public function run() {
        require_once plugin_dir_path( __FILE__ ) . 'class-wclrp-shortcodes.php';
        require_once plugin_dir_path( __FILE__ ) . '../admin/class-wclrp-admin.php';
        require_once plugin_dir_path( __FILE__ ) . '../public/class-wclrp-public.php';

        ( new WCLRP_Shortcodes() )->register_shortcodes();
        ( new WCLRP_Admin() )->init();
        ( new WCLRP_Public() );

        add_action( 'template_redirect', [ $this, 'maybe_redirect_my_account' ] );
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
    }

    public function maybe_redirect_my_account() {
        if ( is_page( 'my-account' ) && ! is_user_logged_in() ) {
            $login_page_id = get_option( self::OPTION_PREFIX . 'login_page' );
            if ( $login_page_id ) {
                wp_redirect( get_permalink( $login_page_id ) );
                exit;
            }
        }
    }

    public function load_textdomain() {
        load_plugin_textdomain( self::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/../languages' );
    }
}
