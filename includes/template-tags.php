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

namespace TenUpScaffold\TemplateTags;

/**
 * Go get the SVG icon directly
 *
 * @param string $file_name the file name of the icon
 * @param string $label the name of the icon
 */
function get_icon( $file_name, $label ) {
	// ob_start();
	// include TENUP_SCAFFOLD_PATH . 'dist/svg/' . $name . '.svg';
	$svg = file_get_contents( TENUP_SCAFFOLD_PATH . 'dist/svg/' . $file_name . '.svg' );
	return $svg;
	// return ob_get_clean();
}

/**
 * Set all the allowed SVG elements and attributes
 */
function get_svg_atts() {
	return array(
		'svg' => array(
			'aria-hidden' => true,
			'aria-labelledby' => true,
			'aria-label' => true,
			'aria-controls' => true,
			'class' => true,
			'crossorigin' => true,
			'focusable' => true,
			'height' => true,
			'href' => true,
			'id' => true,
			'lang' => true,
			'preserveAspectRatio' => true,
			'requiredFeatures' => true,
			'requiredExtensions' => true,
			'role' => true,
			'style' => true,
			'systemLanguage' => true,
			'tabindex' => true,
			'transform' => true,
			'viewbox' => true,
			'viewBox' => true,
			'width' => true,
			'x' => true,
			'xlink:href' => true,
			'xml:lang' => true,
			'xml:space' => true,
			'xmlns' => true,
			'xmlns:prefix' => true,
			'y' => true,
		),
		'g' => array(
			'fill' => true,
		),
		'title' => array(
			'aria-labelledby' => true,
			'aria-label' => true,
			'id' => true,
			'title' => true,
		),
		'path'  => array(
			'aria-labelledby' => true,
			'aria-label' => true,
			'd' => true,
			'fill' => true,
			'id' => true,
			'class' => true,
		),
		'circle' => array(
			'cx' => true,
			'cy' => true,
			'r' => true,
		),
		'ellipse' => array(
			'cx' => true,
			'cy' => true,
			'rx' => true,
			'ry' => true,
		),
		'line' => array(
			'x1' => true,
			'y1' => true,
			'x2' => true,
			'y2' => true,
		),
		'polygon' => array(
			'points' => true,
		),
		'polyline' => array(
			'points' => true,
		),
		'rect' => array(
			'x' => true,
			'y' => true,
			'height' => true,
			'width' => true,
			'rx' => true,
			'ry' => true,
		),
		'mesh' => array(
			'x' => true,
			'y' => true,
		),
		'text' => array(
			'x' => true,
			'y' => true,
			'dx' => true,
			'dy' => true,
			'rotate' => true,
			'textLength' => true,
			'lengthAdjust' => true,
		),
		'textPath' => array(
			'xlink:href' => true,
			'href' => true,
			'startOffset' => true,
			'method' => true,
			'spacing' => true,
			'side' => true,
			'path' => true,
		),
		'defs' => array(),
		'g' => array(),
		'image' => array(
			'xlink:href' => true,
			'href' => true,
			'x' => true,
			'y' => true,
			'height' => true,
			'width' => true,
			'preserveAspectRatio' => true,
			'externalResourcesRequired' => true,
			'crossorigin' => true,
		),
		'svg' => array(
			'xlink:href' => true,
			'href' => true,
			'x' => true,
			'y' => true,
			'height' => true,
			'width' => true,
			'viewBox' => true,
			'preserveAspectRatio' => true,
		),
		'switch' => array(),
		'symbol' => array(
			'x' => true,
			'y' => true,
			'refX' => true,
			'refY' => true,
			'height' => true,
			'width' => true,
			'viewBox' => true,
			'preserveAspectRatio' => true,
		),
		'use' => array(
			'x' => true,
			'y' => true,
			'height' => true,
			'width' => true,
			'xlink:href' => true,
			'href' => true,
		),
		'view' => array(
			'viewBox' => true,
			'preserveAspectRatio' => true,
			'viewTarget' => true,
		),
	);
}
