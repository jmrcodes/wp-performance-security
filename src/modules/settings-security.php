<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// SECURITY Settings output function

	function wpps_config_security(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Security Settings', 'wp-performance-security'); ?></h2>

		<?php
			if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce($_POST['_wpnonce']) ) {
				echo '<div class="updated fade"><p>';
				_e('Settings saved successfully', 'wp-performance-security');
				echo '</p></div>';
			}

			if ( class_exists( 'Jetpack' ) ) {
				echo '<div class="update-nag">';
				_e('Jetpack is currently installed. Disabling XML-RPC might impact this plugin.', 'wp-performance-security');
				echo '</div>';
			}
		?>

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

		<?php
			wp_nonce_field();
			$config = get_option('wpps_options');
		?>

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e('WordPress Version', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_remove_wp_version" value="1" <?php if ( isset( $config['wpps_remove_wp_version'] ) ) checked( $config['wpps_remove_wp_version'], 1 ); ?>>
								<span><?php _e('Remove the WordPress version number', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('This stops potential hackers from being able to identify which version of WordPress you are using and what vulnerabilities you might be exposed to.', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('XML-RPC', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="xmlrpc_enabled" value="1" <?php if ( isset( $config['xmlrpc_enabled'] ) ) checked( $config['xmlrpc_enabled'], 1 ); ?>>
								<span><?php _e('Disable XML-RPC', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('This will disable external editors and services that rely on XML-RPC to connect with your WordPress installion.', 'wp-performance-security'); ?></p>
						</fieldset>
						<br>
						<fieldset>
							<label>
								<input type="checkbox" name="xmlrpc_pingback" value="1" <?php if ( isset( $config['xmlrpc_ping'] ) ) checked( $config['xmlrpc_ping'], 1 ); ?>>
								<span><?php _e('Disable XML-RPC Pingback Ping', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('Prevents WordPress XML-RPC from being used as part of a “Pingback Botnet”. If you need to use XML-RPC this option should be enabled.', 'wp-performance-security'); ?></p>
						</fieldset>
						<br>
						<fieldset>
							<label>
								<input type="checkbox" name="atom_service_url_filter" value="1" <?php if ( isset( $config['atom_service_url_filter'] ) ) checked( $config['atom_service_url_filter'], 1 ); ?>>
								<span><?php _e('Disable XML-RPC SSL Testing', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('Prevents WordPress from testing XML-RPC SSL capability when XML-RPC not in use', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Comments', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" id="wpps_closeCommentsGlobaly" name="wpps_closeCommentsGlobaly" value="1" <?php if ( isset( $config['wpps_closeCommentsGlobaly'] ) ) checked( $config['wpps_closeCommentsGlobaly'], 1 ); ?>>
								<span><?php _e('Disable comments', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<div class="wpps_menu_comments_sub">
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_media_comment_status" value="1" <?php if ( isset( $config['wpps_media_comment_status'] ) ) checked( $config['wpps_media_comment_status'], 1 ); ?>>
									<span><?php _e('Disable comments on media files', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_clickable_comments" value="1" <?php if ( isset( $config['wpps_clickable_comments'] ) ) checked( $config['wpps_clickable_comments'], 1 ); ?>>
									<span><?php _e('Disable active links in comments', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_comment_url" value="1" <?php if ( isset( $config['wpps_comment_url'] ) ) checked( $config['wpps_comment_url'], 1 ); ?>>
									<span><?php _e('Remove the ‘URL’ field from the comments form', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<span><?php _e('Minimum number of characters required in a comment', 'wp-performance-security'); ?>: </span>
									<input type="number" class="small-text" min="0" name="wpps_minimum_comment_length" value="<?php if ( isset( $config['wpps_minimum_comment_length'] ) ) echo $config['wpps_minimum_comment_length']; ?>">
								</label>
								<p class="description"><?php _e('A minimum character length prevents short comments.', 'wp-performance-security'); ?></p>
							</fieldset>
						</div>
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