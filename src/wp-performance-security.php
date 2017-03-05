<?php
/**
 * Plugin Name: WP Performance & Security
 * Plugin URI: https://jmr.codes/wp/wpps/
 * Description: Change WordPress settings that can improve the performance and security of your site. Reduce load times, vulnerabilities, and control comments and hidden WordPress features. <a href="https://wordpress.org/support/plugin/wp-performance-security">Need help?</a>
 * Version: 0.7.2
 * Author: James Robinson
 * Author URI: https://jmr.codes/
 * License: GPL3
 */

/*  Copyright 2016 James Robinson (email : support@jmr.codes)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 3, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !defined( 'ABSPATH' ) ) exit;

// Add settings and styles files
include('modules/settings.php');
include('modules/settings-general.php');
include('modules/settings-performance.php');
include('modules/settings-security.php');
include('modules/settings-admin.php');
include('modules/settings-login.php');
include('modules/settings-verification.php');
include('modules/settings-analytics.php');
include('modules/help.php');

// Init settings values on activation
register_activation_hook( __FILE__, 'wpps_activate' );

function wpps_activate(){
	$config = get_option('wpps_options');

	// ===== GENERAL SETTINGS =================== //
	$wpps_options['wpps_excerpt_length'] = '55';
	$wpps_options['wpps_page_excerpts'] = 0;
	$wpps_options['wpps_excerpt_more'] = '[...]';
	$wpps_options['wpps_read_more'] = 0;
	$wpps_options['wpps_searchAll'] = 0;
	$wpps_options['wpps_custom_feed_request'] = 0;
	$wpps_options['wpps_tags_pages'] = 0;
	$wpps_options['wpps_tags_query'] = 0;
	$wpps_options['wpps_custom_upload_mimes'] = 0;
	$wpps_options['wpps_html5_support'] = 0;
	$wpps_options['wpps_auto_content'] = 0;
	$wpps_options['wpps_auto_content'] = 0;

	// ===== PERFORMANCE SETTINGS =============== //
	$wpps_options['output_compression'] = 0;
	$wpps_options['wpps_self_ping'] = 0;
	$wpps_options['wpps_remove_script_version'] = 0;
	$wpps_options['wpps_rel_links'] = 0;
	$wpps_options['wpps_wlw_manifest'] = 0;
	$wpps_options['wpps_rsd_link'] = 0;
	$wpps_options['wpps_short_link'] = 0;
	$wpps_options['wpps_emoji_support'] = 0;

	// ===== SECURITY SETTINGS ================== //
	$wpps_options['wpps_remove_wp_version'] = 0;
	$wpps_options['xmlrpc_enabled'] = 0;
	$wpps_options['xmlrpc_ping'] = 0;
	$wpps_options['atom_service_url_filter'] = 0;

	// Comments
	$wpps_options['wpps_clickable_comments'] = 0;
	$wpps_options['wpps_media_comment_status'] = 0;
	$wpps_options['wpps_closeCommentsGlobaly'] = 0;
	$wpps_options['wpps_comment_url'] = 0;
	$wpps_options['wpps_minimum_comment_length'] = 0;

	// ===== ADMIN SETTINGS ===================== //
	$wpps_options['wpps_admin_bar'] = 0;
	$wpps_options['wpps_stats_footer'] = 0;
	$wpps_options['wpps_all_settings_link'] = 0;
	$wpps_options['wpps_replace_howdy'] = '';

	// Dashboard Widgets
	$wpps_options['wpps_dash_primary'] = 0;
	$wpps_options['wpps_dash_secondary'] = 0;
	$wpps_options['wpps_dash_right_now'] = 0;
	$wpps_options['wpps_dash_incoming_links'] = 0;
	$wpps_options['wpps_dash_quick_press'] = 0;
	$wpps_options['wpps_dash_recent_drafts'] = 0;
	$wpps_options['wpps_dash_recent_comments'] = 0;
	$wpps_options['wpps_dash_plugins'] = 0;

	// Admin Menu Items
	$wpps_options['wpps_menu_wp'] = 0;
	$wpps_options['wpps_menu_about'] = 0;
	$wpps_options['wpps_menu_wporg'] = 0;
	$wpps_options['wpps_menu_documentation'] = 0;
	$wpps_options['wpps_menu_forums'] = 0;
	$wpps_options['wpps_menu_feedback'] = 0;
	$wpps_options['wpps_menu_site'] = 0;


	// ===== LOGIN PAGE SETTINGS ================ //
	$wpps_options['wpps_site_icon_logo'] = 0;
	$wpps_options['wpss_custom_login_logo'] = '';
	$wpps_options['wpps_custom_login_url'] = '';
	$wpps_options['wpps_custom_login_title'] = '';
	$wpps_options['login_errors'] = 0;

	// ===== GOOGLE ANALYTICS SETTINGS ========== //
	$wpps_options['wpps_ga_insert'] = 0;
	$wpps_options['wpps_ga_id'] = '';
	$wpps_options['wpps_ga_ssl'] = 0;
	$wpps_options['wpps_ga_display'] = 0;

	update_option('wpps_options', $wpps_options );
}


add_action( 'plugins_loaded', 'wpps_init' );

function wpps_init() {

	// ************ GET THE SETTINGS *************************************************************************************** //

	$config = get_option('wpps_options');


	/* ===================================================================================================================== //
	// ================ WPPS GENERAL SETTINGS ============================================================================== //
	// ===================================================================================================================== */

	// ************ CHANGE THE LENGTH OF THE DEFAULT EXCERPT *************************************************************** //
	if( isset( $config['wpps_excerpt_length'] ) &&  $config['wpps_excerpt_length'] != '' ){
		add_filter('excerpt_length', 'wpps_excerpt_length');
		function wpps_excerpt_length( $length ) {
			$config = get_option('wpps_options');
			return $config['wpps_excerpt_length'];
		}
	}

	// ************ CUSTOM EXCERPT ELLIPSES ******************************************************************************** //
	if( isset( $config['wpps_excerpt_more'] ) && $config['wpps_excerpt_more'] != '' ){
		add_filter( 'excerpt_more', 'custom_excerpt_more', 98 );
		add_filter('the_content_more_link', 'custom_excerpt_more', 98);
		function custom_excerpt_more( $more ) {
			$config = get_option('wpps_options');
			$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( ) . '#more-' . get_the_ID() ), $config['wpps_excerpt_more'] );
			return ' ' . $link;
		}
	}

	// ************ ALLOW EXCERPTS ON PAGES ******************************************************************************** //
	if( isset( $config['wpps_page_excerpts'] ) && $config['wpps_page_excerpts'] == 1 ){
		add_action('init', 'wpps_page_excerpts');
		function wpps_page_excerpts() {
			add_post_type_support( 'page', 'excerpt' );
		}
	}

	// ************ STOP "READ MORE" LINK FROM JUMPING TO NAMED ANCHOR ***************************************************** //
	if( isset( $config['wpps_read_more'] ) && $config['wpps_read_more'] == 1 ){
		add_filter('excerpt_more', 'wpps_no_jump', 99);
		add_filter('the_content_more_link', 'wpps_no_jump', 99);
		function wpps_no_jump( $more ) {
			$more_text = '[...]';
			$config = get_option('wpps_options');
			if( isset( $config['wpps_excerpt_more'] ) && $config['wpps_excerpt_more'] != '' ) {
				$more_text = $config['wpps_excerpt_more'];
			}
			$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), $config['wpps_excerpt_more'] );
			return ' ' . $link;
		}
	}

	// ************ SHOW CUSTOM POST TYPES IN SEARCH RESULTS *************************************************************** //
	if( isset( $config['wpps_searchAll'] ) && $config['wpps_searchAll'] == 1 ){
		add_filter( 'the_search_query', 'wpps_searchAll' );
		function wpps_searchAll( $query ) {
			if ( $query->is_search ) { $query->set( 'post_type', array( 'site', 'plugin', 'theme', 'person' )); }
			return $query;
		}
	}

	// ************  SHOW CUSTOM POST TYPES IN THE RSS FEEDS *************************************************************** //
	if( isset( $config['wpps_custom_feed_request'] ) && $config['wpps_custom_feed_request'] == 1 ){
		add_filter( 'request', 'wpps_custom_feed_request' );
		function wpps_custom_feed_request( $vars ) {
			if (isset($vars['feed']) && !isset($vars['post_type']))
				$vars['post_type'] = array( 'post', 'site', 'plugin', 'theme', 'person' );
			return $vars;
		}
	}

	// ************  ALLOW TAGS ON PAGES *********************************************************************************** //
	if( isset( $config['wpps_tags_pages'] ) && $config['wpps_tags_pages'] == 1 ){
		add_action('init', 'wpps_tags_pages');
		function wpps_tags_pages() {
			register_taxonomy_for_object_type('post_tag', 'page');
		}
	}

	if( isset( $config['wpps_tags_pages'] ) && $config['wpps_tags_pages'] == 0 ){
		if ( in_array( 'post_tag', get_object_taxonomies('page') ) ) {
			add_action('init', 'remove_tags_page');
			function remove_tags_page() {
				unregister_taxonomy_for_object_type('post_tag', 'page');
			}
		}
	}

	// ************  INCLUDE TAGS IN QUERIES ******************************************************************************* //
	if( isset( $config['wpps_tags_query'] ) && $config['wpps_tags_query'] == 1 ){
		add_action('pre_get_posts', 'wpps_tags_query');
		function wpps_tags_query($wp_query) {
			if ($wp_query->get('tag')) {
				$wp_query->set('post_type', 'any');
			}
		}
	}

	// ************ ALLOW UPLOADS OF SVG MIME TYPE ************************************************************************* //
	if( isset( $config['wpps_custom_upload_mimes'] ) && $config['wpps_custom_upload_mimes'] == 1 ){
		add_filter('upload_mimes', 'wpps_custom_upload_mimes');
		function wpps_custom_upload_mimes ( $existing_mimes = array() ) {
			$existing_mimes['svg'] = 'image/svg+xml';
			$existing_mimes['svgz'] = 'image/svg+xml';
			return $existing_mimes;
		}
	}

	// ************ ENABLE HTML5 MARKUP ************************************************************************************ //
	if( isset( $config['wpps_html5_support'] ) && $config['wpps_html5_support'] == 1 && function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	}

	// ************ DISABLE AUTO-FORMATTING IN CONTENT ********************************************************************* //
	if( isset( $config['wpps_auto_content'] ) && $config['wpps_auto_content'] == 1 ){
		remove_filter( 'the_content', 'wpautop' );
	}

	// ************ DISABLE AUTO-FORMATTING IN EXCERPT ********************************************************************* //
	if( isset( $config['wpps_auto_excerpt'] ) && $config['wpps_auto_excerpt'] == 1 ){
		remove_filter( 'the_excerpt', 'wpautop' );
	}


	/* ===================================================================================================================== //
	// ================ WPPS PERFORMANCE SETTINGS ========================================================================== //
	// ===================================================================================================================== */

	// ************ ENABLE GZIP COMPRESSION ******************************************************************************** //
	if( isset( $config['output_compression'] ) && $config['output_compression'] == 1 && extension_loaded("zlib") && ini_get( "output_handler") != "ob_gzhandler" ) {
		add_action('wp', create_function('', '@ob_end_clean();@ini_set("zlib.output_compression", 1);'));
	}

	// ************ DISABLE SELF-PING ************************************************************************************** //
	if( isset( $config['wpps_self_ping'] ) && $config['wpps_self_ping'] == 1 ){
		add_action( 'pre_ping', 'wpps_self_ping' );
		function wpps_self_ping( $links ) {
			$home = get_option( 'home' );
			foreach ( $links as $l => $link ) {
				if ( 0 === strpos( $link, $home ) ){
					unset($links[$l]);
				}
			}
		}
	}

	// ************ REMOVE THE VERSION QUERY STRING FROM SCRIPTS AND STYLES - ALLOWS FOR BETTER CACHING ******************** //
	if( isset( $config['wpps_remove_script_version'] ) && $config['wpps_remove_script_version'] == 1 ){
		add_filter( 'script_loader_src', 'wpps_remove_script_version', 15, 1 );
		add_filter( 'style_loader_src', 'wpps_remove_script_version', 15, 1 );
		function wpps_remove_script_version( $src ){
			return remove_query_arg( 'ver', $src );
		}
	}

	// ************ REMOVE RELATIONAL LINKS ******************************************************************************** //
	if( isset( $config['wpps_rel_links'] ) && $config['wpps_rel_links'] == 1 ){
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link' );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	}

	// ************ REMOVE WP SHORTLINK ************************************************************************************ //
	if( isset( $config['wpps_short_link'] ) && $config['wpps_short_link']== 1 ){
		remove_action( 'wp_head', 'wp_shortlink_wp_head');
	}

	// ************ REMOVE WINDOWS LIVE WRITER LINK ************************************************************************ //
	if( isset( $config['wpps_wlw_manifest'] ) && $config['wpps_wlw_manifest'] == 1 ){
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	// ************ REMOVE RSD LINK **************************************************************************************** //
	if( isset( $config['wpps_rsd_link'] ) && $config['wpps_rsd_link'] == 1 ){
		remove_action( 'wp_head', 'rsd_link' );
	}


	// ************ REMOVE EMOJI SUPPORT *********************************************************************************** //
	if( isset( $config['wpps_emoji_support'] ) && $config['wpps_emoji_support'] == 1 ){
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}


	/* ===================================================================================================================== //
	// ================ WPPS SECURITY SETTINGS ============================================================================= //
	// ===================================================================================================================== */

	// ************ REMOVE WORDPRESS VERSION NUMBER ************************************************************************ //
	if( isset( $config['wpps_remove_wp_version'] ) && $config['wpps_remove_wp_version'] == 1 ){
		remove_action('wp_head', 'wp_generator');
		add_filter('the_generator', 'wpps_remove_wp_version');
		function wpps_remove_wp_version() {
			return '';
		}
	}

	// ************ DISABLE XMLRPC ***************************************************************************************** //
	if( isset( $config['xmlrpc_enabled'] ) && $config['xmlrpc_enabled'] == 1 ){
		add_filter('xmlrpc_enabled', '__return_false');
	}

	// ************ PREVENTS WORDPRESS XMLRPC PINGBACK ********************************************************************* //
	if( isset( $config['xmlrpc_ping'] ) && $config['xmlrpc_ping'] == 1 ){
		add_filter( 'xmlrpc_methods', 'wpps_xmlrpc_pingback' );
		function wpps_xmlrpc_pingback( $methods ) {
			unset( $methods['pingback.ping'] );
			return $methods;
		}
	}

	// ************ PREVENTS WORDPRESS FROM TESTING SSL CAPABILITY ON domain.com/xmlrpc.php?rsd **************************** //
	// see: http://csspark.com/wilderness/snippets/wordpress-snippets/remove-xml-rpc-use-performance-boost/
	if( isset( $config['atom_service_url_filter'] ) && $config['atom_service_url_filter'] == 1 ){
		remove_filter('atom_service_url','atom_service_url_filter');
	}

	// ************ DISABLE COMMENTS GLOBALLY ****************************************************************************** //
	if( isset( $config['wpps_closeCommentsGlobaly'] ) && $config['wpps_closeCommentsGlobaly'] == 1 ){
		add_filter('comments_number', 'wpps_closeCommentsGlobaly');
		add_filter('comments_open', 'wpps_closeCommentsGlobaly');
		add_filter( 'pings_open', 'wpps_closeCommentsGlobaly', 20, 2 );
		function wpps_closeCommentsGlobaly($data) {
			return false;
		}
	}

	// ************ DISABLE COMMENTS ON MEDIA FILES ************************************************************************ //
	if( isset( $config['wpps_media_comment_status'] ) && $config['wpps_media_comment_status'] == 1 ){
		add_filter( 'comments_open', 'wpps_media_comment_status', 10 , 2 );
		function wpps_media_comment_status( $open, $post_id ) {
			$post = get_post( $post_id );
			if( $post->post_type == 'attachment' ) {
				return false;
			}
			return $open;
		}
	}

	// ************ DISABLE AUTO LINKING OF URLS IN COMMENTS *************************************************************** //
	if( isset( $config['wpps_clickable_comments'] ) && $config['wpps_clickable_comments'] == 1 ){
		remove_filter('comment_text', 'make_clickable', 9);
	}

	// ************ REMOVES URL FIELD FROM COMMENTS ************************************************************************ //
	if( isset( $config['wpps_comment_url'] ) && $config['wpps_comment_url'] == 1 ) {
		add_filter('comment_form_default_fields','wpps_remove_comment_url');
		function wpps_remove_comment_url($fields) {
			unset($fields['url']);
			return $fields;
		}
	}

	// ************ ENFORCE MINIMUM COMMENT LENGTH ************************************************************************* //
	if ( isset( $config['wpps_minimum_comment_length'] ) && $config['wpps_minimum_comment_length'] > 0 ) {
		add_filter( 'preprocess_comment', 'wpps_minimum_comment' );
		function wpps_minimum_comment( $commentdata ) {
			$config = get_option('wpps_options');
			$minimalCommentLength = $config['wpps_minimum_comment_length'];
			if ( strlen( trim( $commentdata['comment_content'] ) ) < $minimalCommentLength ) {
				wp_die( 'All comments must be at least ' . $minimalCommentLength . ' characters long.' );
			}
			return $commentdata;
		}
	}


	/* ===================================================================================================================== //
	// ================ WPPS ADMIN PAGE SETTINGS =========================================================================== //
	// ===================================================================================================================== */

	// ************ HIDE THE ADMIN BAR FROM FRONT FACING PAGES ************************************************************* //
	if ( isset( $config['wpps_admin_bar'] ) && $config['wpps_admin_bar'] == 1 ) {
		add_filter('show_admin_bar', '__return_false');
	}

	// ************ SHOW DATABASE STATISTICS IN FOOTER ********************************************************************* //
	if( isset( $config['wpps_stats_footer'] ) && $config['wpps_stats_footer'] == 1 ){
		add_filter('admin_footer_text', 'wpps_stats_footer');
		function wpps_stats_footer() {
			$stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory', get_num_queries(), timer_stop( 0, 3 ), memory_get_peak_usage() / 1024 / 1024 );
			return '<p class="alignleft">' . $stat . '</p>';
		}
	}

	// ************ CHANGE THE DEFAULT WORDPRESS GREETING IN ADMIN ********************************************************* //
	if( isset( $config['wpps_replace_howdy'] ) && $config['wpps_replace_howdy'] != '' ) {
		add_filter( 'admin_bar_menu', 'wpps_replace_howdy', 25 );
		function wpps_replace_howdy( $wp_admin_bar ) {
			$config = get_option('wpps_options');
			$welcome = sanitize_text_field( $config['wpps_replace_howdy'] );
			$my_account = $wp_admin_bar->get_node('my-account');
			$newtitle = preg_replace( "/^(.*?),/", $config['wpps_replace_howdy'], $my_account->title );
			$wp_admin_bar->add_node( array(
				'id' => 'my-account',
				'title' => $newtitle,
			) );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - WORDPRESS BLOG *************************************************************** //
	if( isset( $config['wpps_dash_primary'] ) && $config['wpps_dash_primary'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_primary' );
		function remove_dashboard_primary() {
			remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - OTHER WORDPRESS NEWS ********************************************************* //
	if( isset( $config['wpps_dash_secondary'] ) && $config['wpps_dash_secondary'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_secondary' );
		function remove_dashboard_secondary() {
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - RIGHT NOW ******************************************************************** //
	if( isset( $config['wpps_dash_right_now'] ) && $config['wpps_dash_right_now'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_right_now' );
		function remove_dashboard_right_now() {
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - INCOMING LINKS *************************************************************** //
	if( isset( $config['wpps_dash_incoming_links'] ) && $config['wpps_dash_incoming_links'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_incoming_links' );
		function remove_dashboard_incoming_links() {
			remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - PLUGINS ********************************************************************** //
	if( isset( $config['wpps_dash_plugins'] ) && $config['wpps_dash_plugins'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_plugins' );
		function remove_dashboard_plugins() {
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - QUICK PRESS ****************************************************************** //
	if( isset( $config['wpps_dash_quick_press'] ) && $config['wpps_dash_quick_press'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_quick_press' );
		function remove_dashboard_quick_press() {
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - RECENT DRAFTS **************************************************************** //
	if( isset( $config['wpps_dash_recent_drafts'] ) && $config['wpps_dash_recent_drafts'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_recent_drafts' );
		function remove_dashboard_recent_drafts() {
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE DASHBOARD WIDGET - RECENT COMMENTS ************************************************************** //
	if( isset( $config['wpps_dash_recent_comments'] ) && $config['wpps_dash_recent_comments'] == 1 ){
		add_action( 'admin_init', 'remove_dashboard_recent_comments' );
		function remove_dashboard_recent_comments() {
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		}
	}

	// ************ REMOVE WP MENU - WHOLE MENU **************************************************************************** //
	if( isset( $config['wpps_menu_wp'] ) && $config['wpps_menu_wp'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_wp' );
		function wpps_menu_wp() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('wp-logo');
		}
	}

	// ************ REMOVE WP MENU - ABOUT WORDPRESS *********************************************************************** //
	if( isset( $config['wpps_menu_about'] ) && $config['wpps_menu_about'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_about' );
		function wpps_menu_about() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('about');
		}
	}

	// ************ REMOVE WP MENU - WORDPRESS.ORG ************************************************************************* //
	if( isset( $config['wpps_menu_wporg'] ) && $config['wpps_menu_wporg'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_wporg' );
		function wpps_menu_wporg() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('wporg');
		}
	}

	// ************ REMOVE WP MENU - DOCUMENTATION ************************************************************************* //
	if( isset( $config['wpps_menu_documentation'] ) && $config['wpps_menu_documentation'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_documentation' );
		function wpps_menu_documentation() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('documentation');
		}
	}

	// ************ REMOVE WP MENU - SUPPORT FORUMS ************************************************************************ //
	if( isset( $config['wpps_menu_forums'] ) && $config['wpps_menu_forums'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_forums' );
		function wpps_menu_forums() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('support-forums');
		}
	}

	// ************ REMOVE WP MENU - FEEDBACK ****************************************************************************** //
	if( isset( $config['wpps_menu_feedback'] ) && $config['wpps_menu_feedback'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_feedback' );
		function wpps_menu_feedback() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('feedback');
		}
	}

	// ************ REMOVE WP MENU - VIEW SITE LINK ************************************************************************ //
	if( isset( $config['wpps_menu_site'] ) && $config['wpps_menu_site'] == 1 ){
		add_action( 'wp_before_admin_bar_render', 'wpps_menu_site' );
		function wpps_menu_site() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('view-site');
		}
	}

	// ************ ADD NEW ADMIN MENU ITEM "ALL SETTINGS" ***************************************************************** //
	if( isset( $config['wpps_all_settings_link'] ) && $config['wpps_all_settings_link'] == 1 ){
		add_action('admin_menu', 'wpps_all_settings_link');
		function wpps_all_settings_link() {
			add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
		}
	}


	/* ===================================================================================================================== //
	// ================ WPPS LOGIN PAGE SETTINGS =========================================================================== //
	// ===================================================================================================================== */

	// ************ SITE ICON LOGIN LOGO *********************************************************************************** //
	if( isset( $config['wpps_site_icon_logo'] ) && $config['wpps_site_icon_logo'] == 1 ) {

		if ( function_exists( 'wp_site_icon' ) && has_site_icon() ) {
			add_action('login_head', 'wpps_site_icon_logo_fn');
			function wpps_site_icon_logo_fn() {
				echo '<style>
				.login h1 { width: 320px; height: 200px; }
				.login h1 a { background:url('. get_site_icon_url() . ') 50% 50% no-repeat; background-size: contain; height: 200px; width: 320px; }
				</style>';
			}
		}
	}

	// ************ CUSTOM LOGIN LOGO ************************************************************************************** //
	if( isset( $config['wpss_custom_login_logo'] ) && isset( $config['wpps_site_icon_logo'] ) && $config['wpps_site_icon_logo'] == 0 && ! empty( $config['wpss_custom_login_logo'] ) ) {
		add_action('login_head', 'wpss_custom_login_logo');
		function wpss_custom_login_logo() {
			$config = get_option('wpps_options');
			echo '<style>
			.login h1 { width: 320px; height: 200px; }
			.login h1 a { background:url('. $config['wpss_custom_login_logo'].') 50% 50% no-repeat; background-size:contain; height: 200px; width: 320px; }
			</style>';
		}
	}

	// ************ SITE URL LOGIN URL *************************************************************************************** //
	if( isset( $config['wpps_site_login_url'] ) && $config['wpps_site_login_url'] == 1 ){
		add_filter('login_headerurl', 'wpps_site_login_url');
		function wpps_site_login_url(){
			return  esc_url( home_url( '/' ) );
		}
	}

	// ************ CUSTOM LOGIN URL *************************************************************************************** //
	if( isset( $config['wpps_custom_login_url'] ) && isset( $config['wpps_site_login_url'] ) && $config['wpps_site_login_url'] == 0 && ! empty( $config['wpps_custom_login_url'] ) ){
		add_filter('login_headerurl', 'wpps_custom_login_url');
		function wpps_custom_login_url(){
			$config = get_option('wpps_options');
			return  $config['wpps_custom_login_url'];
		}
	}

	// ************ CUSTOM LOGIN URL TITLE ATTRIBUTE *********************************************************************** //
	if( isset( $config['wpps_custom_login_title'] ) && ! empty ( $config['wpps_custom_login_title'] ) ) {
		add_filter('login_headertitle', 'wpps_custom_login_title');
		function wpps_custom_login_title(){
			$config = get_option('wpps_options');
			return  $config['wpps_custom_login_title'];
		}
	}

	// ************ HIDE LOGIN FORM ERROR MESSAGES ************************************************************************* //
	if( isset( $config['login_errors'] ) && $config['login_errors'] == 1 ){
		add_filter('login_errors', create_function('$a', "return 'Error';"));
	}


	/* ===================================================================================================================== //
	// ================ WPPS GOOGLE ANALYTICS SETTINGS ===================================================================== //
	// ===================================================================================================================== */

	// ************ GOOGLE ANALYTICS INSERTION ***************************************************************************** //
	if( isset( $config['wpps_ga_insert'] ) && $config['wpps_ga_insert'] == 1 ){
		add_action('wp_head', 'wpps_ga_code', 999);
	}

	// ************ UNIVERSAL ANALYTICS CODE ******************************************************************************* //
	function wpps_ga_code(){

		$config = get_option('wpps_options');
		$tracking_code_display = '';
		$tracking_code_ssl = '';

		// Default SSL option == FALSE
		if( isset( $config['wpps_ga_ssl'] ) && $config['wpps_ga_ssl'] == 1 ){
			$tracking_code_ssl = "ga('set', 'forceSSL', true);";
		}

		// Default Display Features option == ''
		if( isset( $config['wpps_ga_display'] ) && $config['wpps_ga_display'] == 1 ){
			$tracking_code_display = "ga('require', 'displayfeatures');";
		}

		echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
		echo $tracking_code_ssl;
		echo "ga('create', '" . $config['wpps_ga_id'] . "', 'auto');";
		echo $tracking_code_display;
		echo "ga('send', 'pageview');</script>";
	}

}

?>
