<?php
/**
 * Main plugin file
 *
 * @package    WordPress
 * @subpackage Analytics_Without_Cookies
 * @version    1.1.0
 * @license    GPL-3.0+
 * @link       https://github.com/barryceelen/wp-analytics-without-cookies
 * @copyright  2016 Barry Ceelen
 */

/*
 * Plugin Name:       Analytics Without Cookies
 * Plugin URI:        https://github.com/barryceelen/wp-analytics-without-cookies
 * Description:       Use basic Google Analytics 'universal' tracking without having to show a cookie consent banner in Europe. Uses browser fingerprinting via fingerprint2.js.
 * Author:            Barry Ceelen
 * Author URI:        https://github.com/barryceelen
 * Version:           1.1.0
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/barryceelen/wp-analytics-without-cookies
 */

add_action( 'wp_enqueue_scripts', 'analytics_without_cookies_enqueue_script' );

/**
 * Enqueue fingerprint script and add inline tracking script.
 *
 * @since 1.0.0
 */
function analytics_without_cookies_enqueue_script() {

	/**
	 * Track logged in users?.
	 *
	 * @since 1.0.0
	 */
	if ( apply_filters( 'analytics_without_cookies_ignore_logged_in_users', true ) ) {
		if ( is_user_logged_in() ) {
			return;
		}
	}

	/**
	 * Add your own Google Analytics tracking code via this filter.
	 *
	 * @since 1.0.0
	 */
	$tracking_id = apply_filters( 'analytics_without_cookies_tracking_id', '' );

	if ( ! empty( $tracking_id ) ) {

		wp_enqueue_script(
			'fingerprint2',
			plugins_url( "js/fingerprint2.min.js", __FILE__ ),
			array(),
			'1.5.1',
			true
		);

		/**
		 * Anonymize IP?
		 *
		 * @since 1.0.0
		 */
		$anonymize_ip = apply_filters( 'analytics_without_cookies_anonymize_ip', true );
		$anonymize_ip = $anonymize_ip ? "ga('set', 'anonymizeIp', true);" : '';

		$script = sprintf(
			"var fp = new Fingerprint2();fp.get(function(result) {(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', '%s', {'storage': 'none','clientId': result});%sga('send', 'pageview');});",
			esc_js( $tracking_id ),
			$anonymize_ip
		);

		wp_add_inline_script( 'fingerprint2', $script );
	}
}
