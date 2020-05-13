<?php
/**
 *  Tests for render_payment_method_info_before_options()
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
 * Class Tests_RenderPaymentMethodInfoBeforeOptions
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\render_payment_method_info_before_options
 *
 * @group   extend-give-wp
 * @group   support
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Tests_RenderPaymentMethodInfoBeforeOptions extends TestCase {

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
	public function test_should_render_recurring_donation_option_label( $expected ) {
		$form_id = $this->factory()->post->create();
		$form_id = get_give_donation_form_id( $form_id );
		$args    = [];

		ob_start();
		do_action( 'give_payment_mode_before_gateways', $form_id, $args );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'payment info view' => [
				'expected_view' => <<<PAYMENT_INFO_VIEW
<div class="donation-form-display-content-before-payment-options">
	<p>Extend your donation, and reduce the cost to Cornerstone of processing your gift.  Payment options include:</p>
	<ol>
		<li><strong><em>Credit card</em></strong> — pay the transaction fees by clicking the checkbox above; <strong>OR</strong></li>
		<li><strong><em>Bank Account</em></strong> - donate directly from your bank account. Fees are typically less than 1%, with a cap of $5.00; <strong>OR</strong></li>
		<li><strong><em>Offline Donation</em></strong> - make a pledge by completing the form. Please follow the directions below to fulfill your pledge.
		</li>
	</ol>
</div>

PAYMENT_INFO_VIEW
				,
			],
		];
	}
}

