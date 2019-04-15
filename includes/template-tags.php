<?php
/**
 * Custom template tags for this theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with TenUpScaffold in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 * Example: `tenup_function()`
 *
 * @package TenUpScaffold\Template_Tags
 */

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

/**
 * An svg template helper.
 *
 * @param  string  $name   The SVG Name.
 * @param  array   $opts   Optional. The SVG options such as Role, Class, Label and Hidden.
 * @param  boolean $output Either return or output the SVG Icon string.
 * @return html
 */
function svg_icon( $name = '', $opts = array(), $output = false ) {
	if ( empty( $name ) ) {
		return '';
	}

	if ( is_customize_preview() ) {
		$href = TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/svg-sprite.svg#' . $name;
	} else {
		$href = '#' . $name;
	}

	$role = empty( $opts['role'] ) ? 'presentation' : $opts['role'];

	// Fix 'image'.
	if ( 'image' === $role ) {
		$role = 'img';
	}

	$class = empty( $opts['class'] ) ? 'dmsb-icon dmsb-icon-' . $name : 'dmsb-icon ' . $opts['class'];
	$label = empty( $opts['label'] ) ? $name : $opts['label'];
	$hidden = empty( $opts['hidden'] ) ? '' : ' aria-hidden="' . esc_attr( $opts['hidden'] ) . '"';

	$allowed_tags = get_post_with_svg_allowed_tags();

	$svg_icon = sprintf( '<svg role="%s" class="%s" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-label="%s"%s><use xlink:href="%s"></use></svg>', esc_attr( $role ), esc_attr( $class ), esc_attr( $label ), $hidden, esc_url( $href ) );

	if ( $output ) {
		echo wp_kses( $svg_icon, $allowed_tags );
		return;
	}
	return $svg_icon;
}

/**
 * Returns the list of allowed tags in order to perform
 * security checks while still allowing SVG elements.
 *
 * @return array
 */
function get_post_with_svg_allowed_tags() {
	$allowed_tags        = wp_kses_allowed_html( 'post' );
	$allowed_tags['svg'] = array(
		'class'       => true,
		'id'          => true,
		'aria-hidden' => true,
		'role'        => true,
		'xmlns'       => true,
		'xmlns:xlink' => true,
		'aria-label'  => true,
	);
	$allowed_tags['use'] = array(
		'xlink:href' => true,
	);
	return $allowed_tags;
}
