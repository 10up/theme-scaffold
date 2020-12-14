<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package TenUpScaffold\Core
 */

namespace TenUpScaffold\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme', $n( 'i18n' ) );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'wp_head', $n( 'js_detection' ), 0 );
	add_action( 'wp_head', $n( 'add_manifest' ), 10 );
	add_action( 'wp_head', $n( 'js_disabled_stylesheets' ) );

	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );

	if ( ! is_admin() ) {
		add_filter( 'style_loader_tag', $n( 'style_loader_tag' ), 10, 2 );
	}

}

/**
 * Makes Theme available for translation.
 *
 * Translations can be added to the /languages directory.
 * If you're building a theme based on "tenup-scaffold", change the
 * filename of '/languages/TenUpScaffold.pot' to the name of your project.
 *
 * @return void
 */
function i18n() {
	load_theme_textdomain( 'tenup-scaffold', TENUP_SCAFFOLD_PATH . '/languages' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
		)
	);

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'tenup-scaffold' ),
		)
	);
}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	wp_enqueue_script(
		'frontend',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/js/frontend.js',
		[],
		TENUP_SCAFFOLD_VERSION,
		true
	);

	if ( is_page_template( 'templates/page-styleguide.php' ) ) {
		wp_enqueue_script(
			'styleguide',
			TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/js/styleguide.js',
			[],
			TENUP_SCAFFOLD_VERSION,
			true
		);
	}

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	wp_enqueue_style(
		'styles',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/css/style.css',
		[],
		TENUP_SCAFFOLD_VERSION
	);

	if ( is_page_template( 'templates/page-styleguide.php' ) ) {
		wp_enqueue_style(
			'styleguide',
			TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/css/styleguide-style.css',
			[],
			TENUP_SCAFFOLD_VERSION
		);
	}
}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @return void
 */
function js_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function script_loader_tag( $tag, $handle ) {
	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag;
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;
}

/**
 * Asynchronous stylesheet definitions
 *
 * Determines which stylesheets should behave
 * asynchronously on the page by storing their
 * unique handle in an array.
 *
 * @return array
 */
function get_known_handles() {
	return array( 'admin-bar', 'dashicons', 'styles', 'styleguide', 'wp-block-library' );
}

/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://developer.wordpress.org/reference/hooks/style_loader_tag/
 * @param string $html   The style html output.
 * @param string $handle The style handle.
 * @return string
 */
function style_loader_tag( $html, $handle ) {

	// Get previously defined stylesheets.
	$known_handles = get_known_handles();

	// Loop over stylesheets and replace media attribute
	foreach ( $known_handles as $known_style ) {
		if ( $known_style === $handle ) {
			$print_html = str_replace( "media='all'", "media='print' onload=\"this.media='all'\"", $html );
		}
	}

	if ( ! empty( $print_html ) ) {
		$html = $print_html . '<noscript>' . $html . '</noscript>';
	}

	return $html;
}

/**
 * Appends a link tag used to add a manifest.json to the head
 *
 * @return void
 */
function add_manifest() {
	echo "<link rel='manifest' href='" . esc_url( TENUP_SCAFFOLD_TEMPLATE_URL . '/manifest.json' ) . "' />";
}
