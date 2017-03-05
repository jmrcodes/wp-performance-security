<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// GOOGLE ANALYTICS Settings output function

	function wpps_config_analytics(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Google Analytics Settings', 'wp-performance-security'); ?></h2>

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

				<table class="form-table">
					<tr>
						<th scope="row"><?php _e('Enable', 'wp-performance-security'); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="checkbox" id="wpps_ga_insert" name="wpps_ga_insert" value="1" <?php if ( isset( $config['wpps_ga_insert'] ) ) checked( $config['wpps_ga_insert'], 1 ); ?>>
									<span><?php _e('Add Google Analytics tracking code', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Tracking ID', 'wp-performance-security'); ?></th>
						<td>
							<fieldset class="wpps_ga_sub">
								<label><?php _e('Google Analytics Tracking ID', 'wp-performance-security'); ?>:
									<input type="text" class="regular-text" name="wpps_ga_id" value="<?php if ( isset( $config['wpps_ga_id'] ) ) echo $config['wpps_ga_id']; ?>" required placeholder="UA-123456-78">
								</label>
								<p class="description"><strong><?php _e('Note:', 'wp-performance-security'); ?></strong> <?php _e('You <em>must</em> include the correct tracking ID for your site.', 'wp-performance-security'); ?></p>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Advanced Features', 'wp-performance-security'); ?></th>
						<td>
							<fieldset class="wpps_ga_sub wpps_ga_uni_sub">
								<label>
									<input type="checkbox" name="wpps_ga_ssl" value="1" <?php if ( isset( $config['wpps_ga_ssl'] ) ) checked( $config['wpps_ga_ssl'], 1 ); ?>>
									<span><?php _e('Force SSL', 'wp-performance-security'); ?></span>
								</label>
								<p class="description"><?php _e('Send all data using SSL, even from insecure (HTTP) pages.', 'wp-performance-security'); ?></p>
							</fieldset>
							<br>
							<fieldset class="wpps_ga_sub wpps_ga_uni_sub">
								<label>
									<input type="checkbox" name="wpps_ga_display" value="1" <?php if ( isset( $config['wpps_ga_display'] ) ) checked( $config['wpps_ga_display'], 1 ); ?>>
									<span><?php _e('Enable Remarketing and Advertising Reporting Features in Analytics', 'wp-performance-security'); ?></span>
								</label>
								<p class="description"><?php _e('This enables the use of Advertising Features in Google Analytics. You will also need to modify your Property settings in Google Analytics. When it is enabled you will see data in the Demographics and Interests reports, see GDN Impression data in the Multi-Channel Funnel reports, and take advantage of DoubleClick-platform integrations.', 'wp-performance-security'); ?> <a href="https://support.google.com/analytics/answer/3450482" rel="nofollow"><?php _e('Learn more', 'wp-performance-security'); ?></a></p>
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