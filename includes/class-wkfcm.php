<?php
/**
 * Main Class
 *
 * @package WooCommerce Facebook Chat Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

if ( ! class_exists( 'Wkfcm' ) ) {

	/**
	 * WKFCM Main Class
	 */
	final class WKFCM {

		/**
		 * Instance variable
		 *
		 * @var $instance
		 */
		protected static $instance = null;

		/**
		 * WKFCM Constructor function.
		 */
		public function __construct() {
			$this->wkcfm_define_constants();
			$this->wkfcm_init_hooks();
		}

		/**
		 * Defining plugin's constant.
		 *
		 * @return void
		 */
		public function wkcfm_define_constants() {
			defined( 'WKFCM_PLUGIN_URL' ) || define( 'WKFCM_PLUGIN_URL', plugin_dir_url( dirname( __FILE__ ) ) );
			defined( 'WKFCM_VERSION' ) || define( 'WKFCM_VERSION', '1.0.1' );
			defined( 'WKFCM_SCRIPT_VERSION' ) || define( 'WKFCM_SCRIPT_VERSION', '1.0.1' );
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @return void
		 */
		private function wkfcm_init_hooks() {
			add_action( 'init', array( $this, 'wkfcm_load_plugin_textdomain' ), 0 );
			add_action( 'plugins_loaded', array( $this, 'wkfcm_load_plugin' ) );
		}

		/**
		 * Load plugin text domain.
		 */
		public function wkfcm_load_plugin_textdomain() {
			load_plugin_textdomain( 'wc_fcm', false, plugin_basename( dirname( WKFCM_PLUGIN_URL ) ) . '/languages' );
		}

		/**
		 * Load eu price indication plugin.
		 *
		 * @return void
		 */
		public function wkfcm_load_plugin() {
			if ( $this->wkfcm_dependency_satisfied() ) {
				WKFCM_File_Handler::get_instance();
			} else {
				add_action( 'admin_notices', array( $this, 'wkfcm_show_wc_not_installed_notice' ) );
			}
		}

		/**
		 * Check if WooCommerce are installed and activated.
		 *
		 * @return bool
		 */
		public function wkfcm_dependency_satisfied() {
			return true;
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @return void
		 */
		public function __clone() {
			wp_die( __FUNCTION__ . esc_html__( 'Cloning is forbidden.', 'wc_fcm' ) );
		}

		/**
		 * Deserializing instances of this class is forbidden.
		 *
		 * @return void
		 */
		public function __wakeup() {
			wp_die( __FUNCTION__ . esc_html__( 'Deserializing instances of this class is forbidden.', 'wc_fcm' ) );
		}

		/**
		 * Show wc not installed notice.
		 *
		 * @return void
		 */
		public function wkfcm_show_wc_not_installed_notice() {
			?>
			<div class="error">
				<p>
					<?php echo sprintf( /* translators: %s wkfcm links */ esc_html__( 'WooCommerce Facebook Chat Messenger Login depends on the last version of %1$s or later to work!', 'wc_fcm' ), '<a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank">' . esc_html__( 'WooCommerce', 'wc_fcm' ) . '</a>' ); ?>
				</p>
			</div>
			<?php
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

