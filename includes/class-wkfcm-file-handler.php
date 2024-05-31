<?php
/**
 * Check main exists class-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_File_Handler' ) ) {

	/**
	 * WKFCM_File_Handler-class file handler class.
	 */
	class WKFCM_File_Handler {

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
			$this->wkfcm_includes();
		}

		/**
		 * Include file.
		 *
		 * @return void
		 */
		public function wkfcm_includes() {
			if ( $this->wkfcm_is_request( 'frontend' ) ) {
				$status = get_option( 'wkfcm_plugin_status', true );
				if ( $status ) {
					WKFCM_Front_Hook_Handler::get_instance();
				}
			} else {
				WKFCM_Admin_Hook_Handler::get_instance();
			}
			WKFCM_Common_Hook_Handler::get_instance();
		}

		/**
		 * Which type of request is this?
		 *
		 * @param string $type admin, ajax, cron or frontend.
		 *
		 * @return bool
		 */
		private function wkfcm_is_request( $type ) {
			if ( 'admin' === $type ) {

				return is_admin();
			}

			return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
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
