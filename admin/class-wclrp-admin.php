<?php
/**
 * Admin settings for WooCommerce Custom Login Register Page
 */
class WCLRP_Admin {

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
            __( 'Login/Register Settings', WCLRP::TEXT_DOMAIN ),
            __( 'Login/Register Pages', WCLRP::TEXT_DOMAIN ),
            'manage_options',
            'wclrp-settings',
            [ $this, 'settings_page' ]
        );
    }

    /**
     * Register settings and fields
     */
    public function register_settings() {
        register_setting( WCLRP::SETTINGS_GROUP, WCLRP::OPTION_PREFIX . 'login_page', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        
        register_setting( WCLRP::SETTINGS_GROUP, WCLRP::OPTION_PREFIX . 'register_page', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ] );
        

        add_settings_section(
            'wclrp_main_section',
            __( 'Page Settings', WCLRP::TEXT_DOMAIN ),
            null,
            'wclrp-settings'
        );

        add_settings_field(
            'wclrp_login_page',
            __( 'Login Page', WCLRP::TEXT_DOMAIN ),
            [ $this, 'dropdown_pages_login' ],
            'wclrp-settings',
            'wclrp_main_section'
        );

        add_settings_field(
            'wclrp_register_page',
            __( 'Register Page', WCLRP::TEXT_DOMAIN ),
            [ $this, 'dropdown_pages_register' ],
            'wclrp-settings',
            'wclrp_main_section'
        );
    }

    /**
     * Render login page dropdown
     */
    public function dropdown_pages_login() {
        $selected = get_option( WCLRP::OPTION_PREFIX . 'login_page' );
        wp_dropdown_pages( [
            'name'              => 'wclrp_login_page',
            'selected'          => esc_attr( $selected ),
            'show_option_none'  => esc_html__( '— Select —', WCLRP::TEXT_DOMAIN ),
        ] );
    }

    /**
     * Render register page dropdown
     */
    public function dropdown_pages_register() {
        $selected = get_option( WCLRP::OPTION_PREFIX . 'register_page' );
        wp_dropdown_pages( [
            'name'              => WCLRP::OPTION_PREFIX . 'register_page',
            'selected'          => esc_attr( $selected ),
            'show_option_none'  => esc_html__( '— Select —', WCLRP::TEXT_DOMAIN ),
        ] );
    }

    /**
     * Render the admin settings page
     */
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Custom Login/Register Settings', WCLRP::TEXT_DOMAIN ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( WCLRP::SETTINGS_GROUP );
                do_settings_sections( 'wclrp-settings' );
                submit_button();
                ?>
            </form>

            <hr>

            <h2><?php echo esc_html__( 'How to Use This Plugin', WCLRP::TEXT_DOMAIN ); ?></h2>
            <p><?php echo esc_html__( 'This plugin allows you to create separate login and register pages for WooCommerce users using shortcodes.', WCLRP::TEXT_DOMAIN ); ?></p>

            <ol>
                <li><?php echo esc_html__( 'Create two new pages in WordPress: one for login and one for register.', WCLRP::TEXT_DOMAIN ); ?></li>
                <li><?php echo esc_html__( 'On the login page, add the shortcode', WCLRP::TEXT_DOMAIN ); ?>: <code>[wclrp_login_form]</code></li>
                <li><?php echo esc_html__( 'On the register page, add the shortcode', WCLRP::TEXT_DOMAIN ); ?>: <code>[wclrp_register_form]</code></li>
                <li><?php echo esc_html__( 'Go back to this settings page and select your login and register pages from the dropdown.', WCLRP::TEXT_DOMAIN ); ?></li>
                <li><?php echo esc_html__( 'Save changes. When an unauthenticated user visits the default WooCommerce account page, they will be redirected to your custom login page.', WCLRP::TEXT_DOMAIN ); ?></li>
            </ol>

            <p><strong><?php echo esc_html__( 'Tip:', WCLRP::TEXT_DOMAIN ); ?></strong> <?php echo esc_html__( 'Make sure the pages you select are published and not set to private.', WCLRP::TEXT_DOMAIN ); ?></p>


        </div>
        <hr>
        <p style="margin-top: 40px; font-size: 13px; color: #666;">
            <?php
            /* translators: %s: author name */
            echo sprintf(
                esc_html__( 'Plugin developed by %s.', WCLRP::TEXT_DOMAIN ),
                '<a href="' . esc_url( 'https://abdhannan.codes' ) . '" target="_blank" rel="noopener noreferrer">Abd Hannan</a>'
            );
            ?>
            <br />
            &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html__( 'All rights reserved.', WCLRP::TEXT_DOMAIN ); ?>
        </p>

        <?php
    }
}
