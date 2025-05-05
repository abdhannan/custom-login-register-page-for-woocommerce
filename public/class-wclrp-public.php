<?php
/**
 * Public hooks & assets
 */

class WCLRP_Public {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            WCLRP::OPTION_PREFIX . 'public',
            plugin_dir_url( __FILE__ ) . 'css/wclrp-public.css',
            [],
            WCLRP::VERSION
        );
    }
}
