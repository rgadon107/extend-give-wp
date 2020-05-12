<?php
/**
 *  Tests for render_donation_levels_label()
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
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/support/load-assets.php';
	}

	/**
	 * Test render_donation_levels_label() should render donation levels label given $form_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_donation_levels_label( $post_data, $expected ) {
		Functions\expect( 'get_give_donation_form_id' )->andReturn( $post_data['form_id'] );
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );

		ob_start();
		render_donation_levels_label( $post_data['form_id'] );
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
					'form_id' => 42,
				],
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

