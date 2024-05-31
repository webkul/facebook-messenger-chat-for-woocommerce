<?php
/**
 * Check main exists class-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_Admin_Function_Handler' ) ) {

	/**
	 * WKFCM_Admin_Function_Handler-class file handler class.
	 */
	class WKFCM_Admin_Function_Handler {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.2
		 */
		protected static $instance = null;

		/**
		 * Plugin row data.
		 *
		 * @param string $links Links.
		 * @param string $file Filepath.
		 *
		 * @hooked 'plugin_row_meta' filter hook.
		 *
		 * @return array
		 */
		public function wkmp_plugin_row_meta( $links, $file ) {
			if ( plugin_basename( WKFCM_PLUGIN_BASENAME ) === $file ) {
				$row_meta = array(
					'docs'    => '<a target="_blank" href="' . esc_url( apply_filters( 'wkfcm_docs_url', 'https://webkul.com/blog/facebook-messenger-chat-woocommerce/' ) ) . '" aria-label="' . esc_attr__( 'View  documentation', 'wc_fcm' ) . '">' . esc_html__( 'Docs', 'wc_fcm' ) . '</a>',
					'support' => '<a target="_blank" href="' . esc_url( apply_filters( 'wkfcm_support_url', 'https://webkul.uvdesk.com/' ) ) . '" aria-label="' . esc_attr__( 'Visit customer support', 'wc_fcm' ) . '">' . esc_html__( 'Support', 'wc_fcm' ) . '</a>',
				);

				return array_merge( $links, $row_meta );
			}

			return (array) $links;
		}

		/**
		 * Admin Register menu for plugin fb form.
		 *
		 * @return void
		 */
		public function wk_wc_fcm_fb_register_menu_page() {
			add_submenu_page(
				'wkwc-addons',
				esc_html__( 'Facebook Chat Messenger', 'wc_fcm' ),
				esc_html__( 'Facebook', 'wc_fcm' ) . '<br>' . esc_html__( 'Messenger Chat', 'wc_fcm' ),
				'manage_options',
				'Messenger_settings',
				array( $this, 'facebook_chat_messenger_settings' )
			);
		}

		/**
		 * Show setting links.
		 *
		 * @param array $links Setting links.
		 * @return array
		 */
		public function wk_wc_fcm_fb_add_plugin_setting_links( $links ) {
			$links   = is_array( $links ) ? $links : array();
			$links[] = '<a href="' . esc_url( admin_url( '/admin.php?page=Messenger_settings' ) ) . '">' . esc_html__( 'Settings', 'wc_fcm' ) . '</a>';

			return $links;
		}
		/**
		 * Admin Function for messenger settings.
		 *
		 * @return void
		 */
		public function facebook_chat_messenger_settings() {
			WKFCM_FB_Messenger_Settings::get_instance();
		}

		/**
		 * Admin Register main scripts for plugin.
		 *
		 * @return void
		 */
		public function wk_wc_fcm_register_scripts_admin() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wk-wc-fb-login-js', WKFCM_PLUGIN_URL . 'assets/js/backend.js', array( 'wp-color-picker' ), '1.0.1', true );
			wp_register_style( 'wk-wc-fcm-admin-backend-style', WKFCM_PLUGIN_URL . 'assets/css/main.css', array(), '1.0.5' );
			wp_enqueue_style( 'wk-wc-fcm-admin-backend-style' );
			wp_register_style( 'select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all' );
			wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'select2css' );
			wp_enqueue_script( 'select2' );
		}

		/**
		 * Register fb messenger
		 *
		 * @return void
		 */
		public function wk_wc_fcm_fb_messenger_woocommerce_registration() {
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_fb_messenger_app_id' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_fb_messenger_page_id' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_fb_messenger_theme_color' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_fb_messenger_welcome_message' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_fb_messenger_logged_out_message' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_facebook_messenger_enable_disable' );
			register_setting( 'woocommerce-wk-wc-fb-messenger-settings-group', 'wk_wc_facebook_messenger_pages' );
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
