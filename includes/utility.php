<?php
/**
 * Utility functions for the theme.
 *
 * This file is for custom helper functions.
 * These should not be confused with WordPress template
 * tags. Template tags typically use prefixing, as opposed
 * to Namespaces.
 *
 * @link https://developer.wordpress.org/themes/basics/template-tags/
 * @package TenUpScaffold
 */

namespace TenUpScaffold\Utility;

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists( $dir . $path ) ) {
		$css_vars = file_get_contents( $dir . $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		preg_match_all( ' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;

}
