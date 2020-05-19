<?php
/**
 *  Tests for render_option_page_template()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
use function spiralWebDb\ExtendGiveWP\Admin\render_option_page_template;

/**
 * Class Test_RenderNewsletterSignupCallout
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
	 * Test render_option_page_template() should render template for current user.
	 *
	 * @dataProvider addTestData
	 */
	public function test_option_page_template_renders_for_current_user( $user_data, $expected_view ) {
		$user = $this->factory()->user->create_and_get( $user_data );

		do_action( 'admin_menu', '' );

		$this->go_to( 'http://example.com//wp-admin/options-general.php?page=extend-give-wp' );

		ob_start();
		render_option_page_template();
		$actual_view = ob_get_clean(); // returns falsey (empty string)

		$this->assertEquals( $expected_view, $actual_view ); // assertion fails.
	}

	/**
	 * Data generator for test method.
	 */
	public function addTestData() {
		return [
			'render option page template' => [
				'user_data'     => [
					'role' => 'editor',
				],
				'expected_view' => <<< OPTION_PAGE_TEMPLATE
<div class="wrap">
	<h1>Extend GiveWP -- Donation Form Option Settings</h1>
	<form action="options.php" method="post">
							</form>
</div>

OPTION_PAGE_TEMPLATE
				,
			],
		];
	}
}

