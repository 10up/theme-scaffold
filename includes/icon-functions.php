<?php
/**
 * SVG icons related functions
 *
 * @package TenUpScaffold
 */

/**
 * An svg template helper.
 *
 * Example:
 * tenupscaffold_svg_icon(
 *     'instagram',
 *     array(
 *         'role' => 'img'
 *     )
 * );
 *
 * @param  string  $name   The SVG Name.
 * @param  array   $opts   Optional. The SVG options such as Role, Class, Label and Hidden.
 * @param  boolean $output Either return or output the SVG Icon string.
 * @return html
 */
function tenupscaffold_svg_icon( $name = '', $opts = array(), $output = false ) {
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

	$class = empty( $opts['class'] ) ? 'tenup-icon tenup-icon-' . $name : 'tenup-icon ' . $opts['class'];
	$label = empty( $opts['label'] ) ? $name : $opts['label'];
	$hidden = empty( $opts['hidden'] ) ? '' : ' aria-hidden="' . esc_attr( $opts['hidden'] ) . '"';

	$allowed_tags = tenupscaffold_get_post_with_svg_allowed_tags();

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
function tenupscaffold_get_post_with_svg_allowed_tags() {
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
