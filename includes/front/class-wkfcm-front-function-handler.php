<?php
/**
 * Check main exists class-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_Front_Function_Handler' ) ) {

	/**
	 * WKFCM_Front_Function_Handler-class file handler class.
	 */
	class WKFCM_Front_Function_Handler {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.2
		 */
		protected static $instance = null;

		/**
		 * Add scripts for front end.
		 *
		 * @return void
		 */
		public function wk_wc_fcm_add_scripts_frontend() {
			$page_id = get_option( 'wk_wc_fb_messenger_page_id' );
			$app_id  = get_option( 'wk_wc_fb_messenger_app_id' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_style( 'wk-wc-fcm-front-style', WKFCM_PLUGIN_URL . 'assets/css/main.css', array(), '1.0.5' );
			wp_enqueue_script( 'wk-wc-fbchat-login-js', WKFCM_PLUGIN_URL . 'assets/js/main.js', array(), '1.0.1', true );
			wp_localize_script(
				'wk-wc-fbchat-login-js',
				'fb_messenger_ids',
				array(
					'page_id' => $page_id,
					'app_id'  => $app_id,
				)
			);
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
