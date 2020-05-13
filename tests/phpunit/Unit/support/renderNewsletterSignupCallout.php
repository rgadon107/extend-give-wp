<?php
/**
 *  Tests for render_newsletter_signup_callout()
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
use function spiralWebDb\ExtendGiveWP\render_newsletter_signup_callout;

/**
 * Class Test_RenderNewsletterSignupCallout
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\render_newsletter_signup_callout
 *
 * @group   extend-give-wp
 * @group   support
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_RenderNewsletterSignupCallout extends TestCase {

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/support/load-assets.php';
	}

	/**
	 * Test render_newsletter_signup_callout() should render donation levels label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_recurring_donation_option_label( $post_data, $expected ) {
		Functions\expect( 'get_give_donation_form_id' )
			->zeroOrMoreTimes()
			->with( 'form_id' )
			->andReturn( $post_data['form_id'] );
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );
		Functions\when( 'esc_attr' )->justEcho( $post_data['form_id'] );

		ob_start();
		render_newsletter_signup_callout( $post_data['form_id'] );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'newsletter callout view' => [
				'post_data'     => [
					'form_id' => 33,
				],
				'expected_view' => <<<NEWSLETTER_CALLOUT_VIEW
<h3 id="give-form-33-1" class="newsletter-callout">Cornerstone Newsletter</h3>

NEWSLETTER_CALLOUT_VIEW
				,
			],
		];
	}
}

