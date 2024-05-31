<?php
/**
 * Check main exists class-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_Front_Hook_Handler' ) ) {

	/**
	 * WKFCM_Front_Hook_Handler-class file handler class.
	 */
	class WKFCM_Front_Hook_Handler {

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
			$class_handler = WKFCM_Front_Function_Handler::get_instance();
			add_action( 'wp_enqueue_scripts', array( $class_handler, 'wk_wc_fcm_add_scripts_frontend' ) );
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
