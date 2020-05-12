<?php
/**
 *  Tests for callout_recurring_donation_option()
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
use function spiralWebDb\ExtendGiveWP\get_give_donation_form_id;
use function spiralWebDb\ExtendGiveWP\callout_recurring_donation_option;

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
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/support/load-assets.php';
	}

	/**
	 * Test callout_recurring_donation_option() should render donation levels label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_recurring_donation_option_label( $post_data, $expected ) {
		Functions\expect( 'get_give_donation_form_id' )->andReturn( $post_data['form_id'] );
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );

		ob_start();
		callout_recurring_donation_option( $form_id );
		$actual = ob_get_clean();

		$this->assertEquals( $expected, $actual );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'donation levels label' => [
				'post_data'     => [
					'form_id' => 17,
				],
				'expected_view' => <<<CALLOUT_RECURRING_DONATION_VIEW
<h3 class="recurring-donation-callout">Make This a Recurring Gift?</h3>

CALLOUT_RECURRING_DONATION_VIEW
				,
			],
		];
	}
}

