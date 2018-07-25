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
 * @package ThemeScaffold\Template_Tags
 */


// Extract colors from a CSS or Sass file
// Extract colors from a CSS or Sass file
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists(  $dir . $path  ) ) {
		$css_vars = file_get_contents( $dir . $path );
		preg_match_all(' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

// Adjust the brightness of a color (HEX)
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) === 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;

}

function render_icons( $asset_path ) {

	$dir = get_stylesheet_directory();
	$path = get_template_directory_uri();
	$output = '';

	if ( $handle = opendir( $dir . $asset_path ) ) {
		while ( false !== ( $entry = readdir( $handle ) ) ) {
			if ( $entry != "." && $entry != ".." ) {
				$entry_clean = str_replace( '.svg', '', $entry );
				$entry_very_clean = str_replace( '-', ' ', $entry_clean );
				$entry_slug = str_replace( 'icon-', '', $entry_clean );

				if ( strpos( $entry, '.svg' ) !== false ) {
					$output .= '<div class="icon">';
					$output .= '<div class="inner">';
					$output .= TENUP_SCAFFOLD_PATH\Helpers\svg_icon( $entry_slug, ['height' => '30', 'width' => '30'] );
					$output .= '<p class="label">' . $entry_very_clean . '</p>';
					$output .= '</div>';
					$output .= '</div>';
				}
			}
		}
	}

	closedir( $handle );

	return $output;

}
?>
