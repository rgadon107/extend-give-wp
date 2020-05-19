<?php
/**
 *  Tests for add_option_settings_page()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Unit
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\ExtendGiveWP\tests\phpunit\Unit\TestCase;
use function spiralWebDb\ExtendGiveWP\Admin\add_option_settings_page;

/**
 * Class Tests_AddOptionSettingsPage
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\add_option_settings_page
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Tests_AddOptionSettingsPage extends TestCase {

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/admin/option-settings-admin.php';
	}

	/**
	 * Test add_option_settings_page() should add option settings page to admin.
	 */
	public function test_should_add_option_settings_page() {
		// String returned by add_submenu_page() on success.
		$hookname = 'settings_page_extend-give-wp';

		Functions\expect( 'add_submenu_page' )
			->once()
			->with(
				'options-general.php',
				'Extend GiveWP -- Donation Form Option Settings',
				'Extend GiveWP',
				'manage_categories',
				'extend-give-wp',
				'spiralWebDb\ExtendGiveWP\Admin\render_option_page_template'
			)
			->andReturn( $hookname );

		$this->assertEquals( $hookname, add_option_settings_page() );
	}
}

