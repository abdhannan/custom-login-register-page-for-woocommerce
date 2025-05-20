<?php
class CUSTLORE {
    const VERSION         = '1.0.0';
    const TEXT_DOMAIN     = 'custom-login-register-page-for-woocommerce';
    const OPTION_PREFIX   = 'custlore_';
    const SETTINGS_GROUP  = 'custlore_settings_group';
    const SLUG            = 'custom-login-register-page-for-woocommerce';

    public function run() {
        require_once plugin_dir_path( __FILE__ ) . 'class-custlore-shortcodes.php';
        require_once plugin_dir_path( __FILE__ ) . '../admin/class-custlore-admin.php';
        require_once plugin_dir_path( __FILE__ ) . '../public/class-custlore-public.php';

        ( new CUSTLORE_Shortcodes() )->register_shortcodes();
        ( new CUSTLORE_Admin() )->init();
        ( new CUSTLORE_Public() );

        add_action( 'template_redirect', [ $this, 'maybe_redirect_my_account' ] );
        add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
    }

    public function maybe_redirect_my_account() {
        if ( is_page( 'my-account' ) && ! is_user_logged_in() ) {
            $login_page_id = get_option( self::OPTION_PREFIX . 'login_page' );
            if ( $login_page_id ) {
                wp_safe_redirect( get_permalink( $login_page_id ) );
                exit;
            }
        }
    }

}
