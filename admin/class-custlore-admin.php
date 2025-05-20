<?php
/**
 * Admin settings for WooCommerce Custom Login Register Page
 */
class CUSTLORE_Admin {

    /**
     * Initialize hooks
     */
    public function init() {
        add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    /**
     * Add menu under WooCommerce
     */
    public function add_admin_menu() {
        add_submenu_page(
            'woocommerce',
            __( 'Login/Register Settings', 'custom-login-register-page-for-woocommerce' ),
            __( 'Login/Register Pages', 'custom-login-register-page-for-woocommerce' ),
            'manage_options',
            'custlore-settings',
            [ $this, 'settings_page' ]
        );
    }

    /**
     * Register settings and fields
     */
    public function register_settings() {
        register_setting( CUSTLORE::SETTINGS_GROUP, CUSTLORE::OPTION_PREFIX . 'login_page', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        
        register_setting( CUSTLORE::SETTINGS_GROUP, CUSTLORE::OPTION_PREFIX . 'register_page', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        

        add_settings_section(
            'custlore_main_section',
            __( 'Page Settings', 'custom-login-register-page-for-woocommerce' ),
            null,
            'custlore-settings'
        );

        add_settings_field(
            'custlore_login_page',
            __( 'Login Page', 'custom-login-register-page-for-woocommerce' ),
            [ $this, 'dropdown_pages_login' ],
            'custlore-settings',
            'custlore_main_section'
        );

        add_settings_field(
            'custlore_register_page',
            __( 'Register Page', 'custom-login-register-page-for-woocommerce' ),
            [ $this, 'dropdown_pages_register' ],
            'custlore-settings',
            'custlore_main_section'
        );
    }

    /**
     * Render login page dropdown
     */
    public function dropdown_pages_login() {
        $selected = get_option( CUSTLORE::OPTION_PREFIX . 'login_page' );
        wp_dropdown_pages( [
            'name'              => 'custlore_login_page',
            'selected'          => esc_attr( $selected ),
            'show_option_none'  => esc_html__( '— Select —', 'custom-login-register-page-for-woocommerce' ),
        ] );
    }

    /**
     * Render register page dropdown
     */
    public function dropdown_pages_register() {
        $selected = get_option( CUSTLORE::OPTION_PREFIX . 'register_page' );
        wp_dropdown_pages( [
            'name'              => esc_attr( CUSTLORE::OPTION_PREFIX . 'register_page' ),
            'selected'          => esc_attr( $selected ),
            'show_option_none'  => esc_html__( '— Select —', 'custom-login-register-page-for-woocommerce' ),
        ] );
    }

    /**
     * Render the admin settings page
     */
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Custom Login/Register Settings', 'custom-login-register-page-for-woocommerce' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( CUSTLORE::SETTINGS_GROUP );
                do_settings_sections( 'custlore-settings' );
                submit_button();
                ?>
            </form>

            <hr>

            <h2><?php echo esc_html__( 'How to Use This Plugin', 'custom-login-register-page-for-woocommerce' ); ?></h2>
            <p><?php echo esc_html__( 'This plugin allows you to create separate login and register pages for WooCommerce users using shortcodes.', 'custom-login-register-page-for-woocommerce' ); ?></p>

            <ol>
                <li><?php echo esc_html__( 'Create two new pages in WordPress: one for login and one for register.', 'custom-login-register-page-for-woocommerce' ); ?></li>
                <li><?php echo esc_html__( 'On the login page, add the shortcode', 'custom-login-register-page-for-woocommerce' ); ?>: <code>[custlore_login_form]</code></li>
                <li><?php echo esc_html__( 'On the register page, add the shortcode', 'custom-login-register-page-for-woocommerce' ); ?>: <code>[custlore_register_form]</code></li>
                <li><?php echo esc_html__( 'Go back to this settings page and select your login and register pages from the dropdown.', 'custom-login-register-page-for-woocommerce' ); ?></li>
                <li><?php echo esc_html__( 'Save changes. When an unauthenticated user visits the default WooCommerce account page, they will be redirected to your custom login page.', 'custom-login-register-page-for-woocommerce' ); ?></li>
            </ol>

            <p><strong><?php echo esc_html__( 'Tip:', 'custom-login-register-page-for-woocommerce' ); ?></strong> <?php echo esc_html__( 'Make sure the pages you select are published and not set to private.', 'custom-login-register-page-for-woocommerce' ); ?></p>


        </div>
        <hr>
        <p style="margin-top: 40px; font-size: 13px; color: #666;">
            <?php
            echo sprintf(
                // translators: %s is the HTML link to the plugin author's website.
                esc_html__( 'Plugin developed by %s.', 'custom-login-register-page-for-woocommerce' ),
                '<a href="' . esc_url( 'https://abdhannan.codes' ) . '" target="_blank" rel="noopener noreferrer">Abd Hannan</a>'
            );
            ?>
            <br />
            &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html__( 'All rights reserved.', 'custom-login-register-page-for-woocommerce' ); ?>
        </p>

        <?php
    }
}
