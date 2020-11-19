<?php
/**
 * Gutenberg Blocks setup
 *
 * @package TenUpScaffold\Core
 */

namespace TenUpScaffold\Blocks;

use TenUpScaffold\Blocks\Example;


/**
 * Set up blocks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'enqueue_block_editor_assets', $n( 'blocks_editor_styles' ) );

	add_filter( 'block_categories', $n( 'blocks_categories' ), 10, 2 );

	/*
	Uncomment to register the Example block

	add_action(
		'init',
		function() {
			// Filter the plugins URL to allow us to have blocks in themes with linked assets. i.e editorScripts
			add_filter( 'plugins_url', __NAMESPACE__ . '\filter_plugins_url', 10, 2 );

			// Require custom blocks.
			require_once TENUP_SCAFFOLD_BLOCK_DIR . '/example-block/register.php';

			// Call block register functions for each block.
			Example\register();

			// Remove the filter after we register the blocks
			remove_filter( 'plugins_url', __NAMESPACE__ . '\filter_plugins_url', 10, 2 );
		}
	);
	*/
}

/**
 * Filter the plugins_url to allow us to use assets from theme.
 *
 * @param string $url  The plugins url
 * @param string $path The path to the asset.
 *
 * @return string The overridden url to the block asset.
 */
function filter_plugins_url( $url, $path ) {
	$file = preg_replace( '/\.\.\//', '', $path );
	return trailingslashit( get_stylesheet_directory_uri() ) . $file;
}

/**
 * Enqueue shared frontend and editor JavaScript for blocks.
 *
 * @return void
 */
function blocks_scripts() {

	wp_enqueue_script(
		'blocks',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/js/blocks.js',
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
function blocks_editor_styles() {
	wp_enqueue_style(
		'editor-style',
		TENUP_SCAFFOLD_TEMPLATE_URL . '/dist/css/editor-style.css',
		[],
		TENUP_SCAFFOLD_VERSION
	);

}

/**
 * Filters the registered block categories.
 *
 * @param array  $categories Registered categories.
 * @param object $post       The post object.
 *
 * @return array Filtered categories.
 */
function blocks_categories( $categories, $post ) {
	if ( ! in_array( $post->post_type, array( 'post', 'page' ), true ) ) {
		return $categories;
	}

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'tenup-scaffold-blocks',
				'title' => __( 'Custom Blocks', 'tenup-scaffold' ),
			),
		)
	);
}
