<?php
/**
 * Test Frontent Functionality.
 *
 * @package TenUpScaffold
 */

use WPAcceptance\Exception\ElementNotFound as ElementNotFound;

/**
 * PHPUnit test class
 */
class HeaderTest extends \WPAcceptance\PHPUnit\TestCase {

	/**
	 * @testdox The stylesheet is properly enqueued.
	 */
	public function testStylesheetEnqueued() {
		$I = $this->openBrowserPage();
		$I->moveTo( '/' );

		// Test stylesheet is enqueued.
		try {
			$element = $I->getElement( 'link#styles-css[rel="stylesheet"]' );
		} catch ( ElementNotFound $e ) {
			// If the stylesheet doesn't exist, we catch the exception and fail the test.
			$this->assertTrue( false );
		}

		$this->assertNotEmpty( $element );
	}

	/**
	 * @testdox The frontend javascript file is properly enqueued.
	 */
	public function testJavascriptEnqueued() {
		$I = $this->openBrowserPage();
		$I->moveTo( '/' );

		// Test frontend.js is enqueued.
		try {
			$element = $I->getElement( 'script[src*="frontend.js"' );
		} catch ( ElementNotFound $e ) {
			// If the script doesn't exist, we catch the exception and fail the test.
			$this->assertTrue( false );
		}

		$this->assertNotEmpty( $element );
	}

	/**
	 * @testdox Feed links are present.
	 */
	public function testAutomaticFeedLinks() {
		$I = $this->openBrowserPage();
		$I->moveTo( '/' );

		// Test feed link is present.
		try {
			$element = $I->getElement( 'link[type="application/rss+xml"' );
		} catch ( ElementNotFound $e ) {
			// If the feed doesn't exist, we catch the exception and fail the test.
			$this->assertTrue( false );
		}

		$this->assertNotEmpty( $element );
	}

	/**
	 * @testdox The body class is dynamic.
	 */
	public function testBodyClass() {
		$I = $this->openBrowserPage();
		$I->moveTo( '/' );

		$this->assertEquals( 'home blog', $I->getElementAttribute( 'body', 'class' ) );
	}
}
