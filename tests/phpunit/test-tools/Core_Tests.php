<?php
namespace TenUpScaffold\Core;

/**
 * This is a very basic test case to get things started. You should probably rename this and make
 * it work for your project. You can use all the tools provided by WP Mock and Mockery to create
 * your tests. Coverage is calculated against your includes/ folder, so try to keep all of your
 * functional code self contained in there.
 *
 * References:
 *   - http://phpunit.de/manual/current/en/index.html
 *   - https://github.com/padraic/mockery
 *   - https://github.com/10up/wp_mock
 */

use TenUpScaffold as Base;

class Core_Tests extends Base\TestCase {

	protected $testFiles = [
		'core.php'
	];

	/**
	 * Test load method.
	 */
	public function test_setup() {
		// Setup
		\WP_Mock::expectActionAdded( 'after_setup_theme', 'TenUpScaffold\Core\i18n' );
		\WP_Mock::expectActionAdded( 'after_setup_theme', 'TenUpScaffold\Core\theme_setup' );

		// Act
		setup();

		// Verify
		$this->assertConditionsMet();
	}

	/**
	 * Test internationalization integration.
	 */
	public function test_i18n() {
		// Setup
		\WP_Mock::onFilter( 'theme_locale' )->with( 'en_US', 'tenup-scaffold' )->reply( 'en_US' );
		\WP_Mock::userFunction( 'load_theme_textdomain', array(
			'times' => 1,
			'args' => array( 'tenup-scaffold', 'path/languages' ),
		) );

		// Act
		i18n();

		// Verify
		$this->assertConditionsMet();
	}
}
