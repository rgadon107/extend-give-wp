<?php
/**
 *  Tests for initialize_option_settings()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
use function spiralWebDb\ExtendGiveWP\Admin\initialize_option_settings;

/**
 * Class Test_InitializeOptionSettings
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\Admin\initialize_option_settings
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_InitializeOptionSettings extends TestCase {

	/*
	 * Test initialize_option_settings() is registered to the 'admin_init' hook and returns the expected priority.
	 */
	public function test_callback_is_registered_to_action_event_and_returns_expected_priority() {
		$this->assertEquals( 10, has_action( 'admin_init', 'spiralWebDb\ExtendGiveWP\Admin\initialize_option_settings' ) );
	}

	/**
	 * Test initialize_option_settings() initializes option settings.
	 */
	public function test_function_initializes_options_settings() {
		$this->assertNull( initialize_option_settings() );
	}
}

