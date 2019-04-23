<?php
/**
 * Test standard WP functionality
 *
 * @package TenUpScaffold
 */

/**
 * PHPUnit test class
 */
class StandardTest extends \WPAcceptance\PHPUnit\TestCase {

	/**
	 * @testdox I see required HTML tags on front end.
	 */
	public function testRequiredHTMLTagsOnFrontEnd() {
		parent::_testRequiredHTMLTags();
	}

	/**
	 * @testdox I can log in.
	 */
	public function testLogin() {
		parent::_testLogin();
	}

	/**
	 * @testdox I see the admin bar
	 */
	public function testAdminBarOnFront() {
		parent::_testAdminBarOnFront();
	}

	/**
	 * @testdox I can save my profile
	 */
	public function testProfileSave() {
		parent::_testProfileSave();
	}

	/**
	 * @testdox I can install a plugin
	 */
	public function testInstallPlugin() {
		parent::_testInstallPlugin();
	}

	/**
	 * @testdox I can change the site title
	 */
	public function testChangeSiteTitle() {
		parent::_testChangeSiteTitle();
	}

	/**
	 * @testdox I can change permalinks
	 */
	public function testChangePermalinks() {
		parent::_testChangePermalinks();
	}

	/**
	 * @testdox I can see a single post with the correct permalink structure
	 */
	public function testPostShows() {
		parent::_testPostShows();
	}
}
