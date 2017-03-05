<?php
if ( !defined( 'ABSPATH' ) ) exit;

// ADMINISTRATION Settings output function

function wpps_config_admin(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS Administration Settings', 'wp-performance-security'); ?></h2>

		<?php if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce($_POST['_wpnonce']) ) : ?>
		<div class="updated fade" >
			<p><?php _e('Settings saved successfully', 'wp-performance-security'); ?></p>
		</div>
		<?php endif; ?>

		<form method="post" action="<?php //echo $_SERVER['REQUEST_URI']; ?>admin-post.php">
			<input type="hidden" name="action" value="save_wpps_admin" />

		<?php
			wp_nonce_field();
			$config = get_option('wpps_options');
		?>

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e('Admin Bar', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_admin_bar" value="1" <?php if ( isset( $config['wpps_admin_bar'] ) ) checked( $config['wpps_admin_bar'], 1 ); ?>>
								<span><?php _e('Hide the Admin bar from front-facing pages', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Statistics', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_stats_footer" value="1" <?php if ( isset( $config['wpps_stats_footer'] ) ) checked( $config['wpps_stats_footer'], 1 ); ?>>
								<span><?php _e('Show database statistics', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('Display database queries, time spent and memory consumption in the footer of Admin pages.', 'wp-performance-security'); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="wpps_replace_howdy"><?php _e('WordPress greeting', 'wp-performance-security'); ?></label>
					</th>
					<td>
						<input type="text" class="regular-text" id="wpps_replace_howdy" name="wpps_replace_howdy" value="<?php if ( isset( $config['wpps_replace_howdy'] ) ) echo $config['wpps_replace_howdy']; ?>">
						<p class="description"><?php _e('Change the default WordPress greeting on Admin pages.', 'wp-performance-security'); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Dashboard Widgets', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_primary" value="1" <?php if ( isset( $config['wpps_dash_primary'] ) ) checked( $config['wpps_dash_primary'], 1 ); ?>>
								<span><?php _e('Remove ‘WordPress Blog’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_secondary" value="1" <?php if ( isset( $config['wpps_dash_secondary'] )  ) checked( $config['wpps_dash_secondary'], 1 ); ?>>
								<span><?php _e('Remove ‘Other WordPress News’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_right_now" value="1" <?php if ( isset( $config['wpps_dash_right_now'] ) ) checked( $config['wpps_dash_right_now'], 1 ); ?>>
								<span><?php _e('Remove ‘Right Now’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_incoming_links" value="1" <?php if ( isset( $config['wpps_dash_incoming_links'] ) ) checked( $config['wpps_dash_incoming_links'], 1 ); ?>>
								<span><?php _e('Remove ‘Incoming Links’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_quick_press" value="1" <?php if ( isset( $config['wpps_dash_quick_press'] ) ) checked( $config['wpps_dash_quick_press'], 1 ); ?>>
								<span><?php _e('Remove ‘Quick Press’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_recent_drafts" value="1" <?php if ( isset( $config['wpps_dash_recent_drafts'] ) ) checked( $config['wpps_dash_recent_drafts'], 1 ); ?>>
								<span><?php _e('Remove ‘Recent Drafts’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_recent_comments" value="1" <?php if ( isset( $config['wpps_dash_recent_comments'] ) ) checked( $config['wpps_dash_recent_comments'], 1 ); ?>>
								<span><?php _e('Remove ‘Recent Comments’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_dash_plugins" value="1" <?php if ( isset( $config['wpps_dash_plugins'] ) ) checked( $config['wpps_dash_plugins'], 1 ); ?>>
								<span><?php _e('Remove ‘Plugins’ widget', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Menu items', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" id="wpps_menu_wp" name="wpps_menu_wp" value="1" <?php if ( isset( $config['wpps_menu_wp'] ) ) checked( $config['wpps_menu_wp'], 1 ); ?>>
								<span><?php _e('Remove WordPress menu', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('Remove the ‘WordPress’ menu from the top left of the Admin section or select individual options to remove.', 'wp-performance-security'); ?></p>
						<br>

						<div class="wpps_menu_wp_sub">
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_about" value="1" <?php if ( isset( $config['wpps_menu_about'] ) ) checked( $config['wpps_menu_about'], 1 ); ?>>
									<span><?php _e('About', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_wporg" value="1" <?php if ( isset( $config['wpps_menu_wporg'] ) ) checked( $config['wpps_menu_wporg'], 1 ); ?>>
									<span><?php _e('WordPress.org', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_documentation" value="1" <?php if ( isset( $config['wpps_menu_documentation'] ) ) checked( $config['wpps_menu_documentation'], 1 ); ?>>
									<span><?php _e('Documentation', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_forums" value="1" <?php if ( isset( $config['wpps_menu_forums'] ) ) checked( $config['wpps_menu_forums'], 1 ); ?>>
									<span><?php _e('Support Forums', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_feedback" value="1" <?php if ( isset( $config['wpps_menu_feedback'] ) ) checked( $config['wpps_menu_feedback'], 1 ); ?>>
									<span><?php _e('Feedback', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
							<fieldset>
								<label>
									<input type="checkbox" name="wpps_menu_site" value="1" <?php if ( isset( $config['wpps_menu_site'] ) ) checked( $config['wpps_menu_site'], 1 ); ?>>
									<span><?php _e('View Site', 'wp-performance-security'); ?></span>
								</label>
							</fieldset>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('“All Settings” menu', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_all_settings_link" value="1" <?php if ( isset( $config['wpps_all_settings_link'] ) ) checked( $config['wpps_all_settings_link'], 1 ); ?>>
								<span><?php _e('Add new Admin menu item “All Settings”', 'wp-performance-security'); ?></span>
							</label>
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