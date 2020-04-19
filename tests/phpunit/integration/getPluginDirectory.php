<?php
/**
 * Tests _get_plugin_directory().
 *
 * @package     spiralWebDb\ExtendGiveWP\Tests\PHP\Integration
 * @since       1.0.0
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\PHP\Integration;

use function spiralWebDb\ExtendGiveWP\_get_plugin_dir;
use function spiralWebDb\ExtendGiveWP\Tests\PHP\get_plugin_root_dir;

/**
 * Class Tests_GetPluginDirectory
 *
 * @package spiralWebDb\ExtendGiveWP\Tests\PHP\Integration
 */
class Tests_GetPluginDirectory extends TestCase {

	/**
	 * Test _get_plugin_directory() should return the plugin's root directory.
	 */
	public function test__get_plugin_directory_should_run_plugin_directory() {
		$this->assertStringEndsWith( 'extend-give-wp', _get_plugin_dir() );
		$this->assertSame( rtrim( get_plugin_root_dir(), DIRECTORY_SEPARATOR ), _get_plugin_dir() );
	}
}
