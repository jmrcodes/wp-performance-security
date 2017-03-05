<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// LOGIN PAGE Settings output function

	function wpps_config_login(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Login Page Settings', 'wp-performance-security'); ?></h2>

		<?php if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce($_POST['_wpnonce']) ) : ?>
		<div class="updated fade" >
			<p><?php _e('Settings saved successfully', 'wp-performance-security'); ?></p>
		</div>
		<?php endif; ?>

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

		<?php
			wp_nonce_field();
			$config = get_option('wpps_options');
		?>

			<div class="wpps-settings">

				<h3>Login Page Logo</h3>
				<p><?php _e('The login page uses the WordPress logo. You can personalise this in keeping with your site branding by using the “Site Icon” or another custom image.', 'wp-performance-security'); ?></p>
				<table class="form-table">
					<tr>
						<th scope="row"><?php _e('Site Icon', 'wp-performance-security'); ?></th>
						<td>
						<?php if ( function_exists( 'wp_site_icon' ) && has_site_icon() ) : ?>
							<fieldset>
								<label>
									<input type="checkbox" id="wpps_site_icon_logo" name="wpps_site_icon_logo" value="1" <?php if ( isset( $config['wpps_site_icon_logo'] ) ) checked( $config['wpps_site_icon_logo'], 1 ); ?>>
									<span><?php _e('Use the “Site Icon” image as the login page logo', 'wp-performance-security'); ?></span>
								</label>
								<p class="description"><?php _e( 'Selecting this option will over-ride the Login logo setting, below.', 'wp-performance-security'); ?></p>
							</fieldset>
						<?php else : ?>
							<input type="hidden" name="wpps_site_icon_logo" value="0">
							<p class="description"><?php _e( 'To use the Site Icon for the login page logo WordPress version 4.3 or higher must be installed and a site icon must be set in the Theme Customizer.', 'wp-performance-security'); ?></p>
						<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpss_custom_login_logo"><?php _e('Custom Image', 'wp-performance-security'); ?></label></th>
						<td>
							<input type="text" class="regular-text code" id="wpss_custom_login_logo" name="wpss_custom_login_logo" placeholder="<?php if(is_ssl()){ echo 'https://'; } else { echo 'http://'; } ?>" value="<?php if ( isset( $config['wpss_custom_login_logo'] ) ) echo esc_url( $config['wpss_custom_login_logo'], array( 'http', 'https' ) ); ?>">
							<p class="description"><?php _e('URL of custom image, 300px x 200px. Leave blank for default WordPress logo.', 'wp-performance-security'); ?></p>
						</td>
					</tr>
				</table>

				<hr>

				<h3>Login Page Logo Link</h3>
				<p><?php _e('The login page logo links to WordPress.org. You can link the logo to your site or another custom URL. You can also change the text of the', 'wp-performance-security'); ?> <code>title</code> <?php _e('attribute of the link.'); ?></p>
				<table class="form-table">
					<tr>
						<th scope="row"><?php _e('Site URL', 'wp-performance-security'); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="checkbox" id="wpps_site_login_url" name="wpps_site_login_url" value="1" <?php if ( isset( $config['wpps_site_login_url'] ) ) checked( $config['wpps_site_login_url'], 1 ); ?>>
									<span><?php _e('Link the login page logo to your site URL', 'wp-performance-security'); ?></span>
								</label>
								<p class="description"><?php _e( 'Selecting this option will over-ride the Custom Login URL setting, below.', 'wp-performance-security'); ?></p>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wpps_custom_login_url"><?php _e('Custom Login URL', 'wp-performance-security'); ?></label></th>
						<td>
							<input type="text" class="regular-text code" id="wpps_custom_login_url" name="wpps_custom_login_url" placeholder="<?php if(is_ssl()){ echo 'https://'; } else { echo 'http://'; } ?>" value="<?php if ( isset( $config['wpps_custom_login_url'] ) ) echo esc_url( $config['wpps_custom_login_url'], array( 'http', 'https' ) ); ?>">
							<p class="description"><?php _e('You can use a custom URL or leave this field blank for default.', 'wp-performance-security'); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="wpps_custom_login_title"><?php _e('URL title attribute', 'wp-performance-security'); ?></label>
						</th>
						<td>
							<input type="text" id="wpps_custom_login_title" name="wpps_custom_login_title" class="regular-text" value="<?php if ( isset( $config['wpps_custom_login_title'] ) ) echo sanitize_text_field( $config['wpps_custom_login_title'] ); ?>">
						</td>
					</tr>
				</table>

				<hr>

				<table class="form-table">
					<tr>
						<th scope="row"><?php _e('Errors', 'wp-performance-security'); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="checkbox" name="login_errors" value="1" <?php if ( isset( $config['login_errors'] ) ) checked( $config['login_errors'], 1 ); ?>>
									<span><?php _e('Hide detailed login form error messages', 'wp-performance-security'); ?></span>
								</label>
								<p class="description"><?php _e('By default WordPress shows detailed errors for failed login attempts.', 'wp-performance-security'); ?></p>
							</fieldset>
						</td>
					</tr>
				</table>

			</div>
			<p class="submit">
				<input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wp-performance-security'); ?>">
			</p>
		</form>
	</div>

<?php
	}
?>