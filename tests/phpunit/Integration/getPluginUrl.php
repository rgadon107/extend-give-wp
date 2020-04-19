<?php
/**
 * Tests _get_plugin_url().
 *
 * @package     spiralWebDb\ExtendGiveWP\tests\phpunit\Integration
 * @since       1.0.0
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\tests\phpunit\Integration;

use function spiralWebDb\ExtendGiveWP\_get_plugin_url;

/**
 * Class Tests_GetPluginUrl
 *
 * @package spiralWebDb\ExtendGiveWP\tests\phpunit\Integration
 */
class Tests_GetPluginUrl extends TestCase {

	/**
	 * Test _get_plugin_url() should return the plugin's URL.
	 */
	public function test__get_plugin_url_should_run_plugin_url() {
		$this->assertStringEndsWith( 'plugins/extend-give-wp', _get_plugin_url() );
	}
}
