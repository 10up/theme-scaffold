<?php
/**
 * WP Theme constants and setup functions
 *
 * @package ThemeScaffold
 */

// Useful global constants.
define( 'TENUP_SCAFFOLD_VERSION', '0.1.0' );
define( 'TENUP_SCAFFOLD_TEMPLATE_URL', get_template_directory_uri() );
define( 'TENUP_SCAFFOLD_PATH', get_template_directory() . '/' );
define( 'TENUP_SCAFFOLD_INC', TENUP_SCAFFOLD_PATH . 'includes/' );

require_once TENUP_SCAFFOLD_INC . 'core.php';
require_once TENUP_SCAFFOLD_INC . 'template-tags.php';

// Run the setup functions.
TenUpScaffold\Core\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}
