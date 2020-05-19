<?php
/**
 *  Tests for add_option_settings_page()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
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
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 10, has_action( 'admin_menu', 'spiralWebDb\ExtendGiveWP\Admin\add_option_settings_page' ) );
	}

	/**
	 * Test add_option_settings_page() should add option settings page to admin.
	 */
	public function test_should_add_option_settings_page_and_return_hookname() {
		// Add user with admin capability to access submenu admin page.
		$user = $this->factory()->user->create_and_get( [ 'role' => 'editor' ] );
		$post = $this->factory()->post->create_and_get();

		$hookname = add_submenu_page(
			'options-general.php',
			'Extend GiveWP -- Donation Form Option Settings',
			'Extend GiveWP',
			'manage_categories',
			'extend-give-wp',
			'spiralWebDb\ExtendGiveWP\Admin\render_option_page_template'
		);

		$this->go_to( 'http://example.org/wp-admin/options-general.php?page=extend-give-wp' );

		do_action( 'admin_menu', '' );
		var_dump( $hookname ); // false
		var_dump( add_option_settings_page() ); // false
	}
}

