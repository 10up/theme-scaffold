<?php

namespace TenUpScaffold\Blocks\StaticBlock;

class StaticBlock {
	public $namespace = '10up-theme-scaffold';
	public $block_name = 'static-block';

	public function init() {
		if ( ! function_exists( 'register_block_type' ) ) {
			// Gutenberg is not active.
			return;
		}

		wp_register_script(
			$this->block_name . '-script',
			get_template_directory_uri() . '/dist/js/blocks.min.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
			filemtime( get_template_directory() . '/dist/js/blocks.min.js' )
		);

		register_block_type( $this->namespace . '/' . $this->block_name, array(
			'editor_script' => $this->block_name . '-script',
		) );
	}

	private function enqueue_script() {
		wp_enqueue_script( $this->block_name . '-script' );
	}
}
