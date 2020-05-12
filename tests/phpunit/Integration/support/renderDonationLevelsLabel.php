<?php
/**
 *  Tests for render_donation_levels_label()
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
use function spiralWebDb\ExtendGiveWP\render_donation_levels_label;

/**
 * Class Tests_RenderDonationLevelsLabel
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\render_donation_levels_label
 *
 * @group   extend-give-wp
 * @group   support
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Tests_RenderDonationLevelsLabel extends TestCase {

	/**
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 20, has_action( 'give_pre_form', 'spiralWebDb\ExtendGiveWP\render_donation_levels_label' ) );
	}

	/**
	 * Test render_donation_levels_label() should render donation levels label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_donation_levels_label( $expected ) {
		$form_id = $this->factory()->post->create();
		$form_id = get_give_donation_form_id( $form_id );

		ob_start();
		render_donation_levels_label( $form_id );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'donation levels label' => [
				'expected_view' => <<<DONATION_LEVELS_LABEL_VIEW
<div class="donation-levels-label-wrap">
	<h3 class="donation-levels-label">Donation Amount</h3>
	<p>Select the field to enter a custom amount, or choose a donation level below.</p>
</div>

DONATION_LEVELS_LABEL_VIEW
				,
			],
		];
	}
}
