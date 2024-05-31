<?php
/**
 * Check main exists Common-class-function-handler file.
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'WKFCM_Common_Function_Handler' ) ) {

	/**
	 * WKFCM_Common_Function_Handler-class file handler class.
	 */
	class WKFCM_Common_Function_Handler {

		/**
		 * The single instance of the class.
		 *
		 * @var $instance
		 * @since 1.0.2
		 */
		protected static $instance = null;

		/**
		 * Add code in header for support other plugin function.
		 *
		 * @return void
		 */
		public function wk_wc_fcm_add_code_in_header() {
			$exclude_page = get_option( 'wk_wc_facebook_messenger_pages', array() );
			if ( ! empty( $exclude_page ) ) {
				if ( in_array( get_the_ID(), $exclude_page, true ) ) {
					return;
				}
			}
			$page_id            = get_option( 'wk_wc_fb_messenger_page_id', 0 );
			$color              = get_option( 'wk_wc_fb_messenger_theme_color', '#ffffff' );
			$welcome_msg        = get_option( 'wk_wc_fb_messenger_welcome_message', esc_html__( 'Welcome to Facebook! Connect, share, and enjoy! If you have any questions or need help, just ask. Enjoy your time here!', 'wc_fcm' ) );
			$logged_out_message = get_option( 'wk_wc_fb_messenger_logged_out_message', esc_html__( 'Thank you for using Facebook! Logging out... Have a great day!', 'wc_fcm' ) );
			$enable_or_disable  = get_option( 'wk_wc_facebook_messenger_enable_disable', array() );
			$enable_or_disable  = ! empty( $enable_or_disable['options'] ) ? $enable_or_disable['options'] : 'enable';
			if ( 'enable' === $enable_or_disable ) {
				?>
				<div class="wk-wc-container">
					<!-- Load Facebook SDK for JavaScript -->
					<div id="fb-root"></div>
					<div class="fb-customerchat" attribution=setup_tool page_id="<?php echo esc_attr( $page_id ); ?>" theme_color=" <?php echo esc_attr( $color ); ?> " logged_in_greeting="<?php echo esc_attr( $welcome_msg ); ?>" logged_out_greeting="<?php echo esc_attr( $logged_out_message ); ?>">
					</div>
				</div>
				<?php
			}
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
