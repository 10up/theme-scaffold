<?php
/**
 * Gutenberg Blocks setup
 *
 * @package TenUpScaffold\Blocks\Example
 */

namespace TenUpScaffold\Blocks\Example;

/**
 * Register the block
 */
function register() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};
	// Register the block.
	register_block_type_from_metadata(
		TENUP_SCAFFOLD_BLOCK_DIR . '/example-block', // this is the directory where the block.json is found.
		[
			'render_callback' => $n( 'render_block_callback' ),
		]
	);
}

/**
 * Render callback method for the block
 *
 * @param array  $attributes The blocks attributes
 * @param string $content    Data returned from InnerBlocks.Content
 * @param array  $block      Block information such as context.
 *
 * @return string The rendered block markup.
 */
function render_block_callback( $attributes, $content, $block ) {
	ob_start();
	require TENUP_SCAFFOLD_BLOCK_DIR . 'example-block/markup.php';
	return ob_get_clean();
}
