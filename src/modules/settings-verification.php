<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// VERIFICATION Settings output function

	function wpps_config_verification(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Verification Settings', 'wp-performance-security'); ?></h2>

		<?php
			if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce($_POST['_wpnonce']) ) {
				echo '<div class="updated fade"><p>';
				_e('Settings saved successfully', 'wp-performance-security');
				echo '</p></div>';
			}
		?>

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

		<?php
			wp_nonce_field();
			$config = get_option('wpps_options');
		?>

			<p><?php _e('Various web services allow you to verify your website ownership by including a meta tag with a unique code.', 'wp-performance-security'); ?></p>
			<p><?php _e('Enter your meta key "content" value in the fields below to verify your site.', 'wp-performance-security'); ?></p>

			<table class="form-table">
				<tr>
					<th scope="row"><label for="wpps_v_gsc"><?php _e('Google Search Console', 'wp-performance-security'); ?></label></th>
					<td>
						<fieldset>
							<input type="text" class="regular-text" name="wpps_v_gsc" id="wpps_v_gsc" value="<?php if ( isset( $config['wpps_v_gsc'] ) ) echo $config['wpps_v_gsc']; ?>">
							<p class="description">Example Google verification code: <pre>&lt;meta name='google-site-verification' content='<strong>dBw5CvburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8</strong>'&gt;</pre></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wpps_v_bwt"><?php _e('Bing Webmaster Tools', 'wp-performance-security'); ?></label></th>
					<td>
						<fieldset>
							<input type="text" class="regular-text" name="wpps_v_bwt" id="wpps_v_bwt" value="<?php if ( isset( $config['wpps_v_bwt'] ) ) echo $config['wpps_v_bwt']; ?>">
							<p class="description">Example Bing verification code: <pre>&lt;meta name='msvalidate.01' content='<strong>12C1203B5086AECE94EB3A3D9830B2E</strong>'&gt;</pre></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wpps_v_pin"><?php _e('Pinterest', 'wp-performance-security'); ?></label></th>
					<td>
						<fieldset>
							<input type="text" class="regular-text" name="wpps_v_pin" id="wpps_v_pin" value="<?php if ( isset( $config['wpps_v_pin'] ) ) echo $config['wpps_v_pin']; ?>">
							<p class="description">Example Pinterest verification code: <pre>&lt;meta name='p:domain_verify' content='<strong>f100679e6048d45e4a0b0b92dce1efce</strong>'&gt;</pre></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wpps_v_alexa"><?php _e('Alexa', 'wp-performance-security'); ?></label></th>
					<td>
						<fieldset>
							<input type="text" class="regular-text" name="wpps_v_alexa" id="wpps_v_alexa" value="<?php if ( isset( $config['wpps_v_alexa'] ) ) echo $config['wpps_v_alexa']; ?>">
							<p class="description">Example Alexa verification code: <pre>&lt;meta name='alexaVerifyID' content='<strong>vaVi3c06t5F8z2iSDNzdhZyKQuE</strong>'&gt;</pre></p>
						</fieldset>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'wp-performance-security'); ?>">
			</p>
		</form>
	</div>

<?php
	}
?>