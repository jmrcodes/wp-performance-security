<?php
	if ( !defined( 'ABSPATH' ) ) exit;

	// Process settings update
	add_action( 'admin_post_save_wpps_admin', 'process_wpps_admin_options' );

	function process_wpps_admin_options() {


	}


	/*
	add_action('plugins_loaded', 'wpps_update_settings');
	function wpps_update_settings(){
		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'] ) ) {
			return;
		}

		$config = get_option('wpps_options');
		foreach( $_POST as $key=>$value ){
			$wpps_options[$key] = sanitize_text_field( $value );
		}
		update_option('wpps_options', $wpps_options );
	}
	*/

	// Add Menu pages and settings submenu pages
	function wpps_item_menu() {

		add_menu_page(
			__('WP Performance & Security', 'wp-performance-security'), // page title
			__('WPPS', 'wp-performance-security'), 						// menu title
			'manage_options', 											// capabilities
			'wpps', 													// menu-slug
			'wpps_config_general', 										// function
			'dashicons-shield-alt' 										// icon, using dashicons
		);

		// General Settings
		$general = add_submenu_page(
			'wpps', 													// parent menu-slug to add to
			__('WPPS General Settings', 'wp-performance-security'), 	// title of the page
			__('General', 'wp-performance-security'), 					// menu title
			'manage_options', 											// capabilities
			'wpps', 													// menu-slug ~ this is the same as the parent because the first option duplicates the parent
			'wpps_config_general' 										// function
		);

		add_action('load-'.$general, 'wpps_general_help');

		// Performance Settings
		$performance = add_submenu_page(
			'wpps',
			__('WPPS Performance Settings', 'wp-performance-security'),
			__('Performance', 'wp-performance-security'),
			'manage_options',
			'wpps_performance',
			'wpps_config_performance'
		);
		add_action('load-'.$performance, 'wpps_performance_help');

		// Security Settings
		$security = add_submenu_page(
			'wpps',
			__('WPPS Security Settings', 'wp-performance-security'),
			__('Security', 'wp-performance-security'),
			'manage_options',
			'wpps_security',
			'wpps_config_security'
		);
		add_action('load-'.$security, 'wpps_security_help');

		// Admin Settings
		$admin = add_submenu_page(
			'wpps',
			__('WPPS Admin Settings', 'wp-performance-security'),
			__('Administration', 'wp-performance-security'),
			'manage_options',
			'wpps_admin',
			'wpps_config_admin'
		);
		add_action('load-'.$admin, 'wpps_admin_help');

		// Login Settings
		$login = add_submenu_page(
			'wpps',
			__('WPPS Login Settings', 'wp-performance-security'),
			__('Login', 'wp-performance-security'),
			'manage_options',
			'wpps_login',
			'wpps_config_login'
		);
		add_action('load-'.$login, 'wpps_login_help');

		// Verification Settings
		$verification = add_submenu_page(
			'wpps',
			__('WPPS Verification Settings', 'wp-performance-security'),
			__('Verification', 'wp-performance-security'),
			'manage_options',
			'wpps_verification',
			'wpps_config_verification'
		);
		add_action('load-'.$verification, 'wpps_verification_help');

		// Google Analytics Settings
		$analytics = add_submenu_page(
			'wpps',
			__('WPPS Google Analytics', 'wp-performance-security'),
			__('Analytics', 'wp-performance-security'),
			'manage_options',
			'wpps_analytics',
			'wpps_config_analytics'
		);
		add_action('load-'.$analytics, 'wpps_analytics_help');

	}
	add_action('admin_menu', 'wpps_item_menu');

	// Add JS script
	function wpps_add_script_fn($hook){
		wp_enqueue_script('wpps_admin_js', plugins_url('/js/admin.js', __FILE__ ), array('jquery-core'), '1.0', true ) ;
	}
	add_action( 'admin_enqueue_scripts', 'wpps_add_script_fn' );

	// Add settings link on plugin page
	function wpps_plugin_settings_link($links) {
		$settings_link = '<a href="admin.php?page=wpps">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
	$plugin = 'wp-performance-security/wp-performance-security.php';
	add_filter("plugin_action_links_$plugin", 'wpps_plugin_settings_link');

	// Add meta links on plugin page
	function wpps_plugin_meta_links( $links, $file ) {
		if ( strpos( $file, 'wp-performance-security.php' ) !== false ) {
			$meta_link = array(
				'Donate via <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BNWNBPEK33UBA" target="_blank">PayPal</a> or <a href="https://www.coinbase.com/imaginarymedia" target="_blank">Bitcoin</a>',
				'<a href="https://wordpress.org/support/view/plugin-reviews/wp-performance-security" target="_blank">Rate This Plugin</a>'
			);
			$links = array_merge( $links, $meta_link );
		}
		return $links;
	}
	add_filter('plugin_row_meta', 'wpps_plugin_meta_links', 10, 2 );

?>