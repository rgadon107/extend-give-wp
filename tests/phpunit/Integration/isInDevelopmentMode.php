<?php
/**
 * Tests _is_in_development_mode().
 *
 * @package     spiralWebDb\ExtendGiveWP\tests\phpunit\Integration
 * @since       1.0.0
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\tests\phpunit\Integration;

use function spiralWebDb\ExtendGiveWP\_is_in_development_mode;
use function spiralWebDb\ExtendGiveWP\tests\phpunit\get_plugin_root_dir;

/**
 * Class Tests_IsInDevelopmentMode
 *
 * @package spiralWebDb\StarterPlugin\tests\phpunit\Integration
 */
class Tests_IsInDevelopmentMode extends TestCase {

	/**
	 * Test _is_in_development_mode() should return false when not in development mode.
	 */
	public function test__is_in_development_mode_should_return_false_when_not_in_dev_mode() {
		$this->assertFalse( _is_in_development_mode() );
	}

	/**
	 * Test _is_in_development_mode() should return true when in development mode.
	 */
	public function test__is_in_development_mode_should_return_true_when_in_dev_mode() {
		// If defined, skip this test.
		if ( defined( 'WP_DEBUG' ) ) {
			$this->assertTrue( true );
			return;
		}

		define( 'WP_DEBUG', true );
		$this->assertTrue( _is_in_development_mode() );
	}
}
