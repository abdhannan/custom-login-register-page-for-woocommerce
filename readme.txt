=== Custom Login Register Page for WooCommerce ===
Contributors: abdhannan
Tags: woocommerce, login, register, shortcode, user account
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Separate WooCommerce login and register forms into individual pages using shortcodes. Fully compatible with default WooCommerce fields.

== Description ==

WooCommerce by default combines login and register forms in the My Account page. This plugin allows you to:

* Use separate pages for login and register.
* Add login form using `[wclrp_login_form]` shortcode.
* Add register form using `[wclrp_register_form]` shortcode.
* Select custom login and register pages from admin settings.
* Keep using default WooCommerce form fields and validation.
* Compatible with most WooCommerce-compatible themes.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to WooCommerce > Login/Register Pages to select your custom login and register pages.
4. Add `[wclrp_login_form]` or `[wclrp_register_form]` to the desired pages.

== Frequently Asked Questions ==

= Will it affect the default My Account page? =

If you select custom login page, users will be redirected from `/my-account/` to your custom login page when not logged in.

== Screenshots ==

1. Admin settings page to select login/register pages
2. Frontend login form
3. Frontend register form

== Changelog ==

= 1.0.0 =
* Initial release with shortcode and settings support.

== Upgrade Notice ==

= 1.0.0 =
First release, compatible with WooCommerce default fields and user flow.

== License ==

This plugin is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License v2 or later.
