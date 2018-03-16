<?php
/**
 * WP Theme constants and setup functions
 *
 * @package TenUpThemeScaffold
 * @since 0.1.0
 */

// Useful global constants.
define( 'TENUP_THEME_SCAFFOLD_VERSION',      '0.1.0' );
define( 'TENUP_THEME_SCAFFOLD_URL',          get_stylesheet_directory_uri() );
define( 'TENUP_THEME_SCAFFOLD_TEMPLATE_URL', get_template_directory_uri() );
define( 'TENUP_THEME_SCAFFOLD_PATH',         get_template_directory() . '/' );
define( 'TENUP_THEME_SCAFFOLD_INC',          TENUP_THEME_SCAFFOLD_PATH . 'includes/' );

require_once TENUP_THEME_SCAFFOLD_INC . 'core.php';
require_once TENUP_THEME_SCAFFOLD_INC . 'template-tags.php';

// Run the setup functions.
TenUpThemeScaffold\Core\setup();

// What does this do?
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}


// How to use this theme
// 1. Rename folder TenUpThemeScaffold -> your project's name
// 2. Do 3 case-sensitive search/replace:
// 		A. TenUpThemeScaffold
// 		B. TENUP_THEME_SCAFFOLD
// 		C. tenup
