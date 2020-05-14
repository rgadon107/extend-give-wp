<?php
/**
 *  Tests for render_newsletter_signup_callout()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
use function spiralWebDb\ExtendGiveWP\get_give_donation_form_id;

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
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 10, has_action( 'give_payment_mode_before_gateways', 'spiralWebDb\ExtendGiveWP\render_payment_method_info_before_options' ) );
	}

	/**
	 * Test render_payment_method_info_before_options() should render option label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_recurring_donation_option_label( $form_id, $expected_view ) {
		$form_id = get_give_donation_form_id( $form_id );
		$args    = [];

		ob_start();
		do_action( 'give_donation_form_before_submit', $form_id, $args );
		$actual_view = ob_get_clean();

		$this->assertEquals( $expected_view, $actual_view );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		$form_id = $this->factory()->post->create();

		return [
			'test data is empty' => [
				'form_id'       => '',
				'expected_view' => '',
			],
			'test data is valid' => [
				'form_id'       => $form_id,
				'expected_view' => <<<NEWSLETTER_CALLOUT_VIEW
<h3 id="give-form-4-1" class="newsletter-callout">Cornerstone Newsletter</h3>

NEWSLETTER_CALLOUT_VIEW
				,
			],
		];
	}
}

