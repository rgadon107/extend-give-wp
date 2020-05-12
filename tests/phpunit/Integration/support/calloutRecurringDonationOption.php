<?php
/**
 *  Tests for callout_recurring_donation_option()
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
 * Class Tests_CalloutRecurringDonationOption
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\callout_recurring_donation_option
 *
 * @group   extend-give-wp
 * @group   support
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Tests_CalloutRecurringDonationOption extends TestCase {

	/**
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 1, has_action( 'give_after_donation_levels', 'spiralWebDb\ExtendGiveWP\callout_recurring_donation_option' ) );
	}

	/**
	 * Test callout_recurring_donation_option() should render option label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_recurring_donation_option_label( $expected ) {
		$form_id = $this->factory()->post->create();
		$form_id = get_give_donation_form_id( $form_id );
		$args    = [];

		ob_start();
		do_action( 'give_after_donation_levels', $form_id, $args );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'donation view' => [
				'expected_view' => <<<CALLOUT_RECURRING_DONATION_VIEW
<h3 class="recurring-donation-callout">Make This a Recurring Gift?</h3>

CALLOUT_RECURRING_DONATION_VIEW
				,
			],
		];
	}
}

