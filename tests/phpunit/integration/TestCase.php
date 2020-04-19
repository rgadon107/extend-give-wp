<?php
/**
 * Test Case for the Plugin's PHP\Integration Tests.
 *
 * @since       1.0.0
 * @package     spiralWebDb\ExtendGiveWP\Tests\PHP\Integration
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\PHP\Integration;

use Brain\Monkey;
use spiralWebDb\ExtendGiveWP\Tests\PHP\TestCaseTrait;
use WP_UnitTestCase;

/**
 * Integration Tests' Test Case.
 *
 * @package spiralWebDb\StarterPlugin\Tests\PHP\Integration
 */
abstract class TestCase extends WP_UnitTestCase {
	use TestCaseTrait;

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		$this->test_root_dir = get_test_root_dir() . DIRECTORY_SEPARATOR;
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}
}
