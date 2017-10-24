<?php

if ( !defined( 'ABSPATH' ) ) exit;

/* ================================================================================================================= //
// ================ WPPS GENERAL SETTINGS ========================================================================== //
// ================================================================================================================= */


// ***************** HELP - GENERAL SETTINGS *********************************************************************** //
function wpps_general_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );
	$content_details = '';

	$content_details .= '<h3>' . __( 'Excerpt Length', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Change the default excerpt length by entering the number of words that you want to allow. By default, WordPress excerpts have 55 words.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Change the “Read More” Text', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'By default WordPress excerpts use “more&hellip;” as the link to the full content. Enter a different link text.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Allow Excerpts On Pages', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'By default excerpts are only on WordPress posts. You can also allow them on pages. You might need to modify your theme theme to take advantage of this.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( '“Read More” Links', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'By default, when you click a “Read More” link in WordPress it will navigate to the post page and jumps to the additional content. You can change this behaviour so that “Read More” links navigate only to the single post page.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Custom Post Types', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'These settings allow custom posts to be included in WordPress searches and RSS feeds.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Tags', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Normally tags are only used on posts. You can allow them on pages as an additional taxonomy type. You can also ensure that when viewing a specific tag archive that all content types, including pages, are shown.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'SVG Uploads', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'SVG images can be used in themes but the Media Uploader doesn’t allow SVG files to be uploaded to the WordPress Media Library. SVG files are XML and they can include inline JavaScript, so there is a potential security risk in allowing these files to be uploaded. Enabling this is recommended, but be aware that WordPress disables SVG uploads for a reason.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'HTML5 Support', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress uses XHTML markup by default, however it is possible to use HTML5 elements in comment forms, search forms, comment lists, images and captions. WordPress uses the same classes on HTML5 elements so most themes will be fine, however the new elements may cause some theme problems. The use of HTML5 elements is recommended. They are generally backwards compatible and for modern browsers they can provide a better user experience.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Auto-formatting', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress auto-formatting changes double line-breaks into HTML paragraphs. This is usually a good thing, however WordPress auto-formatting will often wrap images and other elements in paragraphs when that isn’t the desired function. Removing auto-formatting is recommended if users are comfortable with HTML coding — it eliminates any unexpected markup.', 'wp-performance-security' ) . '</p>';
	$screen -> add_help_tab( array(
		'id'	=> 'general_help_details',
		'title'	=> __('Summary & Recommendations'),
		'content'	=> $content_details,
	) );
}

// ***************** HELP - PERFORMANCE SETTINGS ******************************************************************* //
function wpps_performance_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );
	$content_details = '';

	$content_details .= '<h3>' . __( 'Compression', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Compressing your WordPress site is strongly recommended for improved performance, however this method will not always work and may interfere with other plugins. It attempts to set output compression via PHP. There may be other, easier ways, of getting your webserver to compress files. ', 'wp-performance-security' ) . '</p>';
	$content_details .= '<p>' . __( 'If this method works, without causing conflicts, it is a recommended setting. You can test whether content is being compressed using using ') . '<a href="http://checkgzipcompression.com/">Check GZIP Compression</a>.</p>';

	$content_details .= '<h3>' . __( 'Internal Pings', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress will sometimes register a “pingback” for internal links between content on your site. Disabling “self-pings” can improve performance and keep things tidy. This is a recommended setting.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Version Strings', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress will usually append a query string indicating the version of a script or style, to the URL of the file: ', 'wp-performance-security' ) . '<br><code>http://example.com/wp-content/my-theme/my-script.js?ver=1.02</code><br>' . __('Some browsers won’t cache scripts or styles that have a query string. Removing the version query strings is a recommended setting.', 'wp-performance-security') . ' <a href="http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/">' .__('Read more here', 'wp-performance-security') . '</a>.</p>';

	$content_details .= '<h3>' . __( 'Header', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress inserts a number of links in the header. For many sites these aren’t useful and removing them can reduce the page size and decrease load time. Removing unused header links is recommended.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Emoji Support', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Emoji Support was added to WordPress in version 4.2. WordPress now adds about 4K of inline CSS and JavaScript to every page. If you don’t use emojis disabling them is recommended.', 'wp-performance-security' ) . '</p>';
	$screen -> add_help_tab( array(
		'id' => 'performance_help_details',
		'title' => __('Summary & Recommendations'),
		'content' => $content_details,
	) );

}

// ***************** HELP - SECURITY SETTINGS ********************************************************************** //
function wpps_security_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );
	$content_details = '';

	$content_details .= '<h3>' . __( 'WordPress Version', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Removing the WordPress version information from the site is strongly recommended. This stops potential hackers from being able to identify which version of WordPress you are using and whether your site is exposed to any security vulnerabilities specific to your version of WordPress.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Disable XML-RPC', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'XML-RPC is a “remote procdedure call” protocol and since WordPress 3.5 it has been enabled by default. XML-RPC is used for trackbacks, pingbacks, and remote access by software clients and services. The JetPack plugin uses XML-RPC, as do the WordPress mobile apps.', 'wp-performance-security' ) . '</p>';
	$content_details .= '<p>' . __( 'Due to the level of access it can provide, XML-RPC has also been associated with a number of security vulnerabilities. It is undoubtably useful but if you don’t use external clients or plugins that use the protocol we recommend disabling XML-RPC.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Disable XML-RPC Pingback Ping', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Any WordPress site with pingback enabled (which is on by default) can be used in DDOS attacks against other sites. It is strongly recommended that it the pingback ping is disabled, especially if you need the other functions of XML-RPC.', 'wp-performance-security' ) . ' <a href="https://blog.sucuri.net/2014/03/more-than-162000-wordpress-sites-used-for-distributed-denial-of-service-attack.html">' . __( 'Read more here', 'wp-performance-security' ) . '</a></p>';

	$content_details .= '<h3>' . __( 'Disable XML-RPC SSL Test', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress uses a CURL operation to test for SSL capability for XML-RPC. If you’re not using XML-RPC you can remove the filter. There is a small performance boost from this, as it stops an unnecessary HTTPS request.', 'wp-performance-security' ) . ' <a href="http://csspark.com/wilderness/snippets/wordpress-snippets/remove-xml-rpc-use-performance-boost/">' . __( 'Read more here', 'wp-performance-security' ) . '</a></p>';

	$content_details .= '<h3>' . __( 'Comments', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Comment management can be exhausting. It is possible to completely disable comments. WordPress allows you to disable comments on posts and pages but you can also disable comments on media files using the settings below. You can disabling the automatic conversion of URLs found in comments into links, and you can remove the URL field from your comments form so that commenters can’t add their website information. You can also set a minimum number of characters for all comments to prevent simple comments that add little to the conversation on your site.', 'wp-performance-security' ) . '</p>';

	$screen -> add_help_tab( array(
		'id' => 'security_help_details',
		'title' => __('Summary & Recommendations'),
		'content' => $content_details,
	) );

}

// ***************** HELP - ADMIN SETTINGS ************************************************************************* //
function wpps_admin_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );
	$content_details = '';

	$content_details .= '<h3>' . __( 'Admin Bar', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'It is possible to remove the WordPress admin bar from front-facing pages.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Statistics', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'This setting replaces “Thank you for creating with WordPress” with the number of database queries made, time spent and memory consumption.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'WordPress Greeting', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'When using WordPress as a CMS for professional sites it might be necessary to replace the default WordPress greeting with a more formal message. Enter a string here as a greeting for your users.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Dashbaord Widgets', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress allows each user to hide or display a number of dashboard widgets. For professional sites it might be necessary to remove these entirely and prevent them from being displayed to any users.', 'wp-performance-security' ) . '</a></p>';

	$content_details .= '<h3>' . __( 'WordPress Menu', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'Removing the WordPress menu or some of the items on the menu may be necessary to help remove any confusion for users on some professional sites.', 'wp-performance-security' ) . '</a></p>';

	$content_details .= '<h3>' . __( 'All Settings', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'The “All Settings” menu creates a new settings page with a list of all the site settings.', 'wp-performance-security' ) . '</p>';

	$screen -> add_help_tab( array(
		'id' => 'admin_help_details',
		'title' => __('Summary'),
		'content' => $content_details,
	) );

}

// ***************** HELP - LOGIN PAGE SETTINGS ******************************************************************** //
function wpps_login_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );
	$content_details = '';

	$content_details .= '<h3>' . __( 'Login Logo', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress 4.3 introduced “Site Icon” functionality — the ability to create a favicon in the Theme Customizer. This setting allows you to use the same cropped image for the logo on your login page.', 'wp-performance-security' ) . '</p>';
	$content_details .= '<p>' . __( 'Alternatively you can use any custom image. You will need to enter the URL of the image manually. The default size is 300px x 200px.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Login URL', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'By default, the logo on the login page links to WordPress.org. You can choose to link to the site URL or enter a custom URL.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'URL Title Attribute', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'You can also update the link title attribute to match your new logo.', 'wp-performance-security' ) . '</p>';

	$content_details .= '<h3>' . __( 'Errors', 'wp-performance-security' ) . '</h3>';
	$content_details .= '<p>' . __( 'WordPress offers detailed error messages, this can be a security risk because it can reveal certain information, such as whether a username is valid. You can disable these messages, although this may reduce usability.', 'wp-performance-security' ) . '</a></p>';

	$screen -> add_help_tab( array(
		'id' => 'admin_help_details',
		'title' => __('Summary & Recommendations'),
		'content' => $content_details,
	) );

}

// ***************** HELP - GOOGLE ANALYTICS SETTINGS ************************************************************** //
function wpps_verification_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );

	$content_about = '<p><a href="https://support.google.com/webmasters/answer/35659?hl=en">' . __( 'Google Search Console meta verification help', 'wp-performance-security' ) . '</a></p>';
	$content_about .= '<p><a href="https://www.bing.com/webmaster/help/how-to-verify-ownership-of-your-site-afcfefc6">' . __( 'Bing Webmaster Tools meta verification help', 'wp-performance-security' ) . '</a></p>';
	$content_about .= '<p><a href="https://help.pinterest.com/en/articles/confirm-your-website">' . __( 'Pinterest meta verification help', 'wp-performance-security' ) . '</a></p>';
	$content_about .= '<p><a href="http://www.alexa.com/siteowners/claim">' . __( 'Alexa verification details', 'wp-performance-security' ) . '</a></p>';

	$screen -> add_help_tab( array(
		'id' => 'verification_help_about',
		'title' => __('Meta Verification'),
		'content' => $content_about,
	) );

}

// ***************** HELP - GOOGLE ANALYTICS SETTINGS ************************************************************** //
function wpps_analytics_help(){
	$screen = get_current_screen();

	$help_sidebar = '<p><strong>' . __( 'For more information', 'wp-performance-security' ) . ':</strong></p>';
	$help_sidebar .= '<p><a href="https://wordpress.org/support/plugin/wp-performance-security">' . __( 'Plugin Support', 'wp-performance-security' ) . '</a></p>';
	$screen->set_help_sidebar( $help_sidebar );

	$content_about = '<p><a href="http://www.google.com/analytics/" rel="nofollow">Google Analytics</a> ' . __('is powerful tracking and reporting feature for websites.', 'wp-performance-security') . '</p>';
	$content_about .= '<p>' . __('These setttings allow you to embed your Google tracking code on your WordPress site. Most users will only need to know their tracking code and whether they are using the new Universal Analytics tracking code or the old classic tracking code.', 'wp-performance-security') . '</p>';
	$content_about .= '<p>' . __('Note, you must be using the Universal Analytics tracking code (on your site and set in your property within Google Analytics) before you can use the advanced features.', 'wp-performance-security') . '</p>';
	$content_about .= '<p>' . __('The Universal Tracking code looks like this:', 'wp-performance-security') . '</p>';
	$content_about .= '<pre>' . esc_html("<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-XXXX-Y', 'auto');
ga('send', 'pageview');

</script>
<!-- End Google Analytics -->") . '</pre>';

	$screen -> add_help_tab( array(
		'id' => 'analytics_help_about',
		'title' => __('About Google Analytics'),
		'content' => $content_about,
	) );

}
