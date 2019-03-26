<?php
/**
 * Gutenberg setup
 *
 * @package ThemeScaffold\Core
 */

namespace TenUpScaffold\Gutenberg;

/**
 * Set up blocks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'enqueue_block_assets', $n( 'gutenberg_scripts' ) );
	add_action( 'enqueue_block_editor_assets', $n( 'gutenberg_editor_scripts' ) );
}

/**
 * Enqueue shared frontend and editor JavaScript for blocks.
 *
 * @return void
 */
function gutenberg_scripts() {

	wp_enqueue_script(
		'gutenberg',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/js/gutenberg.min.js',
		[],
		TENUP_SCAFFOLD_VERSION,
		true
	);
}


/**
 * Enqueue editor-only JavaScript/CSS for blocks.
 *
 * @return void
 */
function gutenberg_editor_scripts() {

	wp_enqueue_script(
		'gutenberg-editor',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/js/gutenberg-editor.min.js',
		[ 'wp-i18n', 'wp-element', 'wp-blocks' ],
		TENUP_SCAFFOLD_VERSION,
		false
	);

	wp_enqueue_style(
		'editor-style',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/css/editor-style.min.css',
		[],
		TENUP_SCAFFOLD_VERSION
	);

}
