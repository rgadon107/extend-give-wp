<?php
/**
 *  Tests for render_payment_method_info_before_options()
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
use function spiralWebDb\ExtendGiveWP\render_payment_method_info_before_options;

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
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/support/load-assets.php';
	}

	/**
	 * Test render_payment_method_info_before_options() should render donation levels label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_recurring_donation_option_label( $expected_view ) {
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );

		ob_start();
		render_payment_method_info_before_options();
		$actual_view = ob_get_clean();

		$this->assertEquals( $expected_view, $actual_view );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'payment info label' => [
				'expected_view' => <<<PAYMENT_INFO_LABEL
<div class="donation-form-display-content-before-payment-options">
	<p>Extend your donation, and reduce the cost to Cornerstone of processing your gift.  Payment options include:</p>
	<ol>
		<li><strong><em>Credit card</em></strong> — pay the transaction fees by clicking the checkbox above; <strong>OR</strong></li>
		<li><strong><em>Bank Account</em></strong> - donate directly from your bank account. Fees are typically less than 1%, with a cap of $5.00; <strong>OR</strong></li>
		<li><strong><em>Offline Donation</em></strong> - make a pledge by completing the form. Please follow the directions below to fulfill your pledge.
		</li>
	</ol>
</div>

PAYMENT_INFO_LABEL
				,
			],
		];
	}
}

