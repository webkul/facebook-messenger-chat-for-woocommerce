<?php
/**
 * WooCommerce Facebook Messenger Setting
 *
 * @package WooCommerce Facebook Messenger
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.

/**
 * Check class exist
 */
if ( ! class_exists( 'WKFCM_FB_Messenger_Settings' ) ) {

	/**
	 * Create main class for control settings
	 */
	class WKFCM_FB_Messenger_Settings {

		/**
		 * Instance variable
		 *
		 * @var $instance
		 */
		protected static $instance = null;


		/**
		 * Main class call function.
		 *
		 * @return void
		 */
		public function __construct() {
			$this->init();
		}

		/**
		 * Initiate support function show form.
		 *
		 * @return void
		 */
		public function init() {
			$pages        = get_pages(
				array(
					'post_status' => 'publish',
				)
			);
			$page_list    = wp_list_pluck( $pages, 'post_title', 'ID' );
			$exclude_page = get_option( 'wk_wc_facebook_messenger_pages', array() );
			if ( empty( $exclude_page ) ) {
				$exclude_page = array();
			}
			?>
			<div class="wrap">
			<h3><?php esc_html_e( 'WooCommerce Facebook Messenger Settings', 'wc_fcm' ); ?></h3>
			<?php settings_errors(); ?>
			<form method="post" action="options.php" >
				<?php settings_fields( 'woocommerce-wk-wc-fb-messenger-settings-group' ); ?>
				<?php do_settings_sections( 'woocommerce-wk-wc-fb-messenger-settings-group' ); ?>
				<table width="1000" class="wk-wc-woocommerce-fb-messenger-setting">
					<tr>
					<th width="250" scope="row">
							<?php esc_html_e( 'Facebook Messenger App Id', 'wc_fcm' ); ?>
						<span class="wk-wc-error">*  </span>
					</th>
					<td width="500">
						<label for="wk_wc_fb_messenger_app_id">
							<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'Unique identifier for a Facebook Page used to enable messaging and interaction through the Messenger platform.', 'wc_fcm' ); ?>">?</span>
						</label>
						<input name="wk_wc_fb_messenger_app_id" type="text" id="wk_wc_fb_messenger_app_id" value="<?php echo esc_attr( get_option( 'wk_wc_fb_messenger_app_id' ) ); ?>" required/>
					</td>
					</tr>
					<tr>
						<th width="250" scope="row"><?php esc_html_e( 'Facebook Messenger Page Id', 'wc_fcm' ); ?> <span class="wk-wc-error">*  </span></th>
						<td width="500">
							<label for="wk_wc_fb_messenger_page_id">
								<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'A unique identifier for your Facebook Messenger application.', 'wc_fcm' ); ?>">?</span>
							</label>
							<input name="wk_wc_fb_messenger_page_id" type="text" id="wk_wc_fb_messenger_page_id" value="<?php echo esc_attr( get_option( 'wk_wc_fb_messenger_page_id' ) ); ?>" required/>
						</td>
					</tr>
					<tr>
						<th width="250" scope="row"><?php esc_html_e( 'Facebook Messenger Theme Color', 'wc_fcm' ); ?></th>
						<td width="500">
							<label for="wk_wc_fb_messenger_app_id">
							<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'Customize the visual appearance of your Messenger experience by choosing a theme color that reflects your style and brand.', 'wc_fcm' ); ?>">?</span>
						</label>
							<input name="wk_wc_fb_messenger_theme_color" type="text" id="wk_wc_fb_messenger_theme_color" value="<?php echo esc_attr( get_option( 'wk_wc_fb_messenger_theme_color' ) ); ?>" />
						</td>
					</tr>
					<tr>
						<th width="250" scope="row"><?php esc_html_e( 'Facebook Messenger Welcome Message', 'wc_fcm' ); ?></th>
						<td width="500">
							<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'Engage and greet users with a personalized introduction or important information to make a great first impression on Messenger.', 'wc_fcm' ); ?>">?</span>
							<input name="wk_wc_fb_messenger_welcome_message" type="text" id="wk_wc_fb_messenger_welcome_message" value="<?php echo esc_attr( get_option( 'wk_wc_fb_messenger_welcome_message' ) ); ?>" />
						</td>
					</tr>
					<tr>
						<th width="250" scope="row"><?php esc_html_e( 'Facebook Messenger Logged Out Message', 'wc_fcm' ); ?></th>
						<td width="500">
							<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'Customize the message displayed to users when they are logged out of Facebook Messenger, providing relevant information or instructions.', 'wc_fcm' ); ?>">?</span>
							<input name="wk_wc_fb_messenger_logged_out_message" type="text" id="wk_wc_fb_messenger_logged_out_message" value="<?php echo esc_attr( get_option( 'wk_wc_fb_messenger_logged_out_message' ) ); ?>" />
						</td>
					</tr>
					<tr>
						<th><label for="status"><?php esc_html_e( 'Enable/Disable Facebook Messenger', 'wc_fcm' ); ?></label></th>
						<td width="500">
							<div class="wc_fms_flex" >
								<span class="wk-custom-tooltip" data-tooltip="<?php echo esc_attr__( 'Control Messenger availability based on your preferences or requirements.', 'wc_fcm' ); ?>">?</span>
								<div class="wk-wc-switch-field">
									<?php
									$enable_disable = get_option( 'wk_wc_facebook_messenger_enable_disable' );

									$enable_disable = ( empty( $enable_disable ) || ! isset( $enable_disable['options'] ) ) ? array( 'options' => 'disable' ) : $enable_disable;

									?>
									<input type="radio" class="switch_left" id="switch_left" name="wk_wc_facebook_messenger_enable_disable[options]" value="enable" <?php checked( 'enable' === $enable_disable['options'] ); ?>/>
									<label for="switch_left"><?php esc_html_e( 'Enable', 'wc_fcm' ); ?></label>
									<input type="radio" class="switch_right" id="switch_right" name="wk_wc_facebook_messenger_enable_disable[options]" value="disable" <?php checked( 'disable' === $enable_disable['options'] ); ?>/>
									<label for="switch_right"><?php esc_html_e( 'Disable', 'wc_fcm' ); ?></label>
								</div>
							</div>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Exclude Page to show Messenger', 'wc_fcm' ); ?></th>
						<td>

							<div class="wc_fms_flex" >
								<span class="wk-custom-tooltip wkc_fcm_multi_select" data-tooltip="<?php echo esc_attr__( 'Choose specific pages to exclude Messenger functionality.', 'wc_fcm' ); ?>">?</span>
								<select class="wk-custom-extra" name="wk_wc_facebook_messenger_pages[]" id="wk-wc-page-option" multiple>
									<?php foreach ( $page_list as $key => $value ) { ?>
									<option class="regular-text" value="<?php echo esc_attr( $key ); ?>" <?php echo ( in_array( (string) $key, $exclude_page, true ) ? 'selected' : '' ); ?>> <?php echo esc_html( $value ); ?> </option>
								<?php } ?>
								</select>
							</div>

						</td>
					</tr>
				</table>
				<p><?php submit_button(); ?></p>
			</form>
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
