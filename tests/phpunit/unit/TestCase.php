<?php
/**
 * Test Case for the Plugin's Unit Tests.
 *
 * @since       1.0.0
 * @package     spiralWebDb\ExtendGiveWP\Tests\PHP\Unit
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\PHP\Unit;

use Brain\Monkey;
use spiralWebDb\ExtendGiveWP\Tests\PHP\TestCaseTrait;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Unit Tests' Test Case.
 *
 * @package spiralWebDb\ExtendGiveWP\Tests\PHP\Unit
 */
abstract class TestCase extends BaseTestCase {
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
	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Setup the stubs for the common WordPress escaping and internationalization functions.
	 */
	protected function setup_common_wp_stubs() {
		// Common escaping functions.
		Monkey\Functions\stubs(
			[
				'esc_attr',
				'esc_html',
				'esc_textarea',
				'esc_url',
				'wp_kses_post',
			]
		);

		// Common internationalization functions.
		Monkey\Functions\stubs(
			[
				'__',
				'esc_html__',
				'esc_html_x',
				'esc_attr_x',
			]
		);

		foreach ( [ 'esc_attr_e', 'esc_html_e', '_e' ] as $wp_function ) {
			Monkey\Functions\when( $wp_function )->echoArg();
		}
	}
}
