<?php
/**
 *  Tests for render_option_page_template()
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
use function spiralWebDb\ExtendGiveWP\Admin\render_option_page_template;

/**
 * Class Test_RenderOptionPageTemplate
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\render_option_page_template
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_RenderOptionPageTemplate extends TestCase {

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		$this->setup_common_wp_stubs();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/admin/option-settings-admin.php';
	}

	/**
	 * Test render_option_page_template() should render template for current user.
	 *
	 * @dataProvider addTestData
	 */
	public function test_option_page_template_renders_for_current_user( $title, $expected_view ) {
		Functions\expect( 'current_user_can' )
			->once()
			->with( 'manage_categories' )
			->andReturn( true );
		Functions\expect( 'get_admin_page_title' )->andReturn( $title );
		Functions\expect( 'settings_fields' )
			->once()
			->with( 'extend-give-wp' )
			->andReturnNull();
		Functions\expect( 'do_settings_sections' )
			->once()
			->with( 'extend-give-wp' )
			->andReturnNull();
		Functions\expect( 'submit_button' )
			->once()
			->with( 'Save Settings', 'primary' )
			->andReturnNull();
		Functions\expect( 'spiralWebDb\ExtendGiveWP\_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );

		ob_start();
		render_option_page_template();
		$actual_view = ob_get_clean();

		$this->assertEquals( $expected_view, $actual_view );
	}

	/**
	 * Data provider for test method.
	 */
	public function addTestData() {
		return [
			'render option page template' => [
				'expected_title' => 'Extend GiveWP -- Donation Form Option Settings',
				'expected_view'  => <<< OPTION_PAGE_TEMPLATE
<div class="wrap">
	<h1>Extend GiveWP -- Donation Form Option Settings</h1>
	<form action="options.php" method="post">
							</form>
</div>

OPTION_PAGE_TEMPLATE
				,
			]
		];
	}
}

