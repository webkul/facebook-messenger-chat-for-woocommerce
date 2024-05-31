<?php
/**
 * Plugin Name: WooCommerce Facebook Chat Messenger
 * Plugin URI: https://codecanyon.net/item/facebook-messenger-chat-for-woocommerce/23241741
 * Description: WordPress WooCommerce Facebook Chat Messenger to allow Facebook chat on your store.
 * Version: 1.0.1
 * Author: Webkul
 * Author URI: https://webkul.com
 * Text Domain: wc_fcm
 * Domain Path: /languages
 *
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * WC requires at least: 5.0
 * WC Tested up to: 8.3
 *
 * WKWC_Addons: 1.1.9
 * WKWC_Settings: Messenger_settings
 * WKWC_Icon_URL: https://store.webkul.com/media/catalog/product/cache/1/image/260x260/9df78eab33525d08d6e5fb8d27136e95/w/o/woocommerce-facebook-messenger-chat-webkul_1.png
 *
 * Store URI: https://store.webkul.com/woocommerce-facebook-messenger-chat.html
 * Blog URI: https://webkul.com/blog/facebook-messenger-chat-woocommerce/
 *
 * Requires Plugins: woocommerce
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

/**
 * Define Constants.
 */
! defined( 'WKFCM_PLUGIN_FILE' ) && define( 'WKFCM_PLUGIN_FILE', plugin_dir_url( __FILE__ ) );
! defined( 'WKFCM_DIR_FILE' ) && define( 'WKFCM_DIR_FILE', plugin_dir_path( __FILE__ ) );
! defined( 'WKFCM_PLUGIN_BASENAME' ) && define( 'WKFCM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Load files with autoload file.
if ( ! class_exists( 'WKWC_Modules_Autoload' ) && file_exists( __DIR__ . '/modules/class-wkwc-modules-autoload.php' ) ) {
	require_once __DIR__ . '/modules/class-wkwc-modules-autoload.php';
}

// Load core auto-loader.
require __DIR__ . '/inc/class-wkfcm-autoload.php';

// Include the main WKFCM class.
if ( ! class_exists( 'WKFCM', false ) ) {
	include_once WKFCM_DIR_FILE . '/includes/class-wkfcm.php';
	WKFCM::get_instance();
}
