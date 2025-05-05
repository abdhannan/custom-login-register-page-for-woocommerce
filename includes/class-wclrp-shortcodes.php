<?php
/**
 * Shortcodes for login and register
 */
class WCLRP_Shortcodes {

    /**
     * Register all shortcodes
     */
    public function register_shortcodes() {
        add_shortcode( 'wclrp_login_form', [ $this, 'render_login_form' ] );
        add_shortcode( 'wclrp_register_form', [ $this, 'render_register_form' ] );
    }

    /**
     * Output the WooCommerce login form
     */
    public function render_login_form() {
        if ( is_user_logged_in() ) {
            return __( 'You are already logged in.', WCLRP::TEXT_DOMAIN );
        }

        if ( ! get_option( 'woocommerce_enable_myaccount_registration' ) ) {
            return __( 'Registration is disabled.', WCLRP::TEXT_DOMAIN );
        }

        
        

        ob_start();
        wc_get_template( 'myaccount/form-login.php' );
        return ob_get_clean();
    }

    /**
     * Output the WooCommerce register form
     */
    public function render_register_form() {
        if ( is_user_logged_in() ) {
            return __( 'You are already registered and logged in.', WCLRP::TEXT_DOMAIN );
        }


        if ( get_option( 'wclrp_register_page' ) && get_the_ID() !== (int) get_option( 'wclrp_register_page' ) ) {
            return __( 'This page is not correctly configured. Please check your settings.', WCLRP::TEXT_DOMAIN );
        }


        ob_start();
        // Only show the registration form
        do_action( 'woocommerce_before_customer_login_form' );
        ?>
        <div class="woocommerce">
            <div class="u-columns col2-set" id="customer_login">
                <div class="u-column2 col-2">
                    <h2><?php esc_html__( 'Register', WCLRP::TEXT_DOMAIN ); ?></h2>
                    <?php
                    /**
                     * Hook: woocommerce_register_form_start.
                     */
                    do_action( 'woocommerce_register_form_start' );

                    woocommerce_form_field( 'username', [
                        'type'        => 'text',
                        'required'    => true,
                        'label'       => __( 'Username', WCLRP::TEXT_DOMAIN ),
                    ]);

                    woocommerce_form_field( 'email', [
                        'type'        => 'email',
                        'required'    => true,
                        'label'       => __( 'Email address', WCLRP::TEXT_DOMAIN ),
                    ]);

                    woocommerce_form_field( 'password', [
                        'type'        => 'password',
                        'required'    => true,
                        'label'       => __( 'Password', WCLRP::TEXT_DOMAIN ),
                    ]);

                    /**
                     * Hook: woocommerce_register_form.
                     */
                    do_action( 'woocommerce_register_form' );

                    wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' );
                    ?>
                    <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', WCLRP::TEXT_DOMAIN ); ?>"><?php esc_html_e( 'Register', WCLRP::TEXT_DOMAIN ); ?></button>
                    <?php
                    /**
                     * Hook: woocommerce_register_form_end.
                     */
                    do_action( 'woocommerce_register_form_end' );
                    ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
