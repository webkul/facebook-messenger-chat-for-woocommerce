<?php
/**
 * Check main exists class-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_Admin_Hook_Handler' ) ) {

	/**
	 * WKFCM_Admin_Hook_Handler-class file handler class.
	 */
	class WKFCM_Admin_Hook_Handler {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.2
		 */
		protected static $instance = null;

		/**
		 * Constructor of the class.
		 *
		 * @return void
		 */
		public function __construct() {
			$class_handler = WKFCM_Admin_Function_Handler::get_instance();
			add_action( 'admin_enqueue_scripts', array( $class_handler, 'wk_wc_fcm_register_scripts_admin' ) );
			add_action( 'admin_menu', array( $class_handler, 'wk_wc_fcm_fb_register_menu_page' ) );
			add_action( 'init', array( $class_handler, 'wk_wc_fcm_fb_messenger_woocommerce_registration' ) );
			add_filter( 'plugin_row_meta', array( $class_handler, 'wkmp_plugin_row_meta' ), 10, 2 );
			add_filter( 'plugin_action_links_' . WKFCM_PLUGIN_BASENAME, array( $class_handler, 'wk_wc_fcm_fb_add_plugin_setting_links' ), 999 );
		}

		/**
		 * This is a singleton page, access the single instance just using this method.
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! static::$instance ) {
				static::$instance = new self();
			}

			return static::$instance;
		}
	}
}
