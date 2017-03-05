<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// PERFORMANCE Settings output function

	function wpps_config_performance(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Performance Settings', 'wp-performance-security'); ?></h2>

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

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e('Compression', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="output_compression" value="1" <?php if ( isset( $config['output_compression'] ) ) checked( $config['output_compression'], 1 ); ?>>
								<span><?php _e('Enable GZIP compression', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><strong><?php _e('Warning:', 'wp-performance-security'); ?></strong> <?php _e('This can sometimes interfere with other plugins.'); ?> <br> <?php _e('You can often enable compression from your hosting console, or request activation from your website host.', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Pings', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_self_ping" value="1" <?php if ( isset( $config['wpps_self_ping'] ) ) checked( $config['wpps_self_ping'], 1 ); ?>>
								<span><?php _e('Disable self-ping', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('Stops WordPress from registering internal links as ‘pings’.', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Version strings', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_remove_script_version" value="1" <?php if ( isset( $config['wpps_remove_script_version'] ) ) checked( $config['wpps_remove_script_version'], 1 ); ?>>
								<span><?php _e('Remove the version query strings from scripts and styles', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('Query strings can cause problems for browser caching. Some browsers don’t cache files with query strings.', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Header', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_rel_links" value="1" <?php if ( isset( $config['wpps_rel_links'] ) ) checked( $config['wpps_rel_links'], 1 ); ?>>
								<span><?php _e('Remove relational links for the posts adjacent to the current post', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_short_link" value="1" <?php if ( isset( $config['wpps_short_link'] ) ) checked( $config['wpps_short_link'], 1 ); ?>>
								<span><?php _e('Remove Shortlink', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_wlw_manifest" value="1" <?php if ( isset( $config['wpps_wlw_manifest'] ) ) checked( $config['wpps_wlw_manifest'], 1 ); ?>>
								<span><?php _e('Remove <em>Windows Live Writer</em> manifest link (wlwmanifest)', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_rsd_link" value="1" <?php if ( isset( $config['wpps_rsd_link'] ) ) checked( $config['wpps_rsd_link'], 1 ); ?>>
								<span><?php _e('Remove <abbr title="Really Simple Discovery">RSD</abbr> link', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('This only removes the RSD link from the header. You can also disable XMLRPC-RSD via the', 'wp-performance-security'); ?> <a href="admin.php?page=wpps_security"><?php _e('security settings', 'wp-performance-security'); ?></a>.</p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Emoji support', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_emoji_support" value="1" <?php if ( isset( $config['wpps_emoji_support'] ) ) checked( $config['wpps_emoji_support'], 1 ); ?>>
								<span><?php _e('Remove emoji support', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('Emoji support was added in WP 4.2 and adds unnecessary styles and scripts.', 'wp-performance-security'); ?></p>
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