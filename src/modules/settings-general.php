<?php
if ( !defined( 'ABSPATH' ) ) exit;

// GENERAL Settings output function

function wpps_config_general(){
?>
	<div class="wrap">
		<h2><?php _e('WPPS General Settings', 'wp-performance-security'); ?></h2>

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
					<th scope="row"><?php _e('Excerpts', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_page_excerpts" value="1" <?php if ( isset( $config['wpps_page_excerpts'] ) ) checked( $config['wpps_page_excerpts'], 1 ); ?>>
								<span><?php _e('Allow excerpts on Pages', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<span><?php _e('Number of words in excerpts: ', 'wp-performance-security'); ?></span>
								<input type="number" class="small-text" name="wpps_excerpt_length" value="<?php if ( isset( $config['wpps_excerpt_length'] ) ) echo $config['wpps_excerpt_length']; ?>">
							</label>
						</fieldset>
						<fieldset>
							<label>
								<span><?php _e('“Read More” text: ', 'wp-performance-security'); ?></span>
								<input type="text" class="regular-text" name="wpps_excerpt_more" value="<?php if ( isset( $config['wpps_excerpt_more'] ) ) echo $config['wpps_excerpt_more']; ?>">
							</label>
							<p class="description"><?php _e('The WordPress default is an ellipsis in square brackets [&hellip;]', 'wp-performance-security'); ?></span>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('“Read More”', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_read_more" value="1" <?php if ( isset( $config['wpps_read_more'] ) ) checked( $config['wpps_read_more'], 1 ); ?>>
								<span><?php _e('Disable “Read More” links from jumping to anchor', 'wp-performance-security'); ?></span>
							</label>
							<p class="description"><?php _e('When creating a <code>&lt;!--more--&gt;</code> link in WordPress the default action is to jump to the ‘more’ section.', 'wp-performance-security'); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Custom Post Types', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_searchAll" value="1" <?php if ( isset( $config['wpps_searchAll'] ) ) checked( $config['wpps_searchAll'], 1 ); ?>>
								<span><?php _e('Show Custom Post Types in the search results', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_custom_feed_request" value="1" <?php if ( isset( $config['wpps_custom_feed_request'] ) ) checked( $config['wpps_custom_feed_request'], 1 ); ?>>
								<span><?php _e('Show Custom Post Types in the RSS feed', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Tags', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_tags_pages" value="1" <?php if ( isset( $config['wpps_tags_pages'] ) ) checked( $config['wpps_tags_pages'], 1 ); ?>>
								<span><?php _e('Allow tags on pages', 'wp-performance-security'); ?></span>
							</label>
						<?php if ( in_array( 'post_tag', get_object_taxonomies('page') ) ) : ?>
							<p class="help"><?php _e( 'Tags are now a registered taxonomy for Pages. Un-checking this option will unregister tags for pages.', 'wp-performance-security' ); ?></p>
							<p class="help"><?php _e( 'This will remove the tag metabox and menu option for pages but will not delete any tags that you have applied to pages.', 'wp-performance-security' ); ?></p>
							<br>
						<?php endif; ?>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_tags_query" value="1" <?php if ( isset( $config['wpps_tags_query'] ) ) checked( $config['wpps_tags_query'], 1 ); ?>>
								<span><?php _e('When showing tag archives, ensure all content types are shown', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Uploads', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_custom_upload_mimes" value="1" <?php if ( isset( $config['wpps_custom_upload_mimes'] ) ) checked( $config['wpps_custom_upload_mimes'], 1 ); ?>>
								<span><?php _e('Allow SVG image uploads', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('HTML5 Support', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_html5_support" value="1" <?php if ( isset( $config['wpps_html5_support'] ) ) checked( $config['wpps_html5_support'], 1 ); ?>>
								<span><?php _e('Use HTML5 markup for the comment forms, search forms, comment lists, images and captions.', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Auto-Formatting', 'wp-performance-security'); ?></th>
					<td>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_auto_content" value="1" <?php if ( isset( $config['wpps_auto_content'] ) ) checked( $config['wpps_auto_content'], 1 ); ?>>
								<span><?php _e('Disable auto-formatting in content', 'wp-performance-security'); ?></span>
							</label>
						</fieldset>
						<fieldset>
							<label>
								<input type="checkbox" name="wpps_auto_excerpt" value="1" <?php if ( isset( $config['wpps_auto_excerpt'] ) ) checked( $config['wpps_auto_excerpt'], 1 ); ?>>
								<span><?php _e('Disable auto-formatting in excerpts', 'wp-performance-security'); ?></span>
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