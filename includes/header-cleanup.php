<?php
/**
 * Header cleanup.
 *
 * @package TenUpScaffold
 */

namespace TenUpScaffold\HeaderCleanup;

/**
 * Remove likely unused functionality that WordPress core enables
 * by default.
 *
 * @return void
 */
function remove() {
	// Remove the Emoji detection script.
	// https://developer.wordpress.org/reference/functions/print_emoji_detection_script/
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	// Remove inline Emoji detection script.
	// https://developer.wordpress.org/reference/functions/print_emoji_detection_script/
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	// Remove Emoji-related styles from front end.
	// https://developer.wordpress.org/reference/functions/print_emoji_styles/
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	// Remove Emoji-related styles from back end.
	// https://developer.wordpress.org/reference/functions/print_emoji_styles/
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	// Remove Emoji-to-static-img conversion.
	// https://developer.wordpress.org/reference/functions/wp_staticize_emoji/
	// https://developer.wordpress.org/reference/functions/wp_staticize_emoji_for_email/
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	// Remove WordPress generator meta.
	// https://developer.wordpress.org/reference/functions/wp_generator/
	remove_action( 'wp_head', 'wp_generator' );
	// Remove Windows Live Writer manifest link.
	// https://developer.wordpress.org/reference/functions/wlwmanifest_link/
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Remove the link to Really Simple Discovery service endpoint.
	// https://developer.wordpress.org/reference/functions/rsd_link/
	remove_action( 'wp_head', 'rsd_link' );

	add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', __NAMESPACE__ . '\disable_emojis_remove_dns_prefetch', 10, 2 );
}

/**
 * Filter function used to remove the TinyMCE emoji plugin.
 *
 * @link https://developer.wordpress.org/reference/hooks/tiny_mce_plugins/
 * @param array $plugins TinyMCE plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @link https://developer.wordpress.org/reference/hooks/emoji_svg_url/
 * @param array  $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}
