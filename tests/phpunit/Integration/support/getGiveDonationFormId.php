<?php
/**
 *  Tests for get_give_donation_form_id()
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
 * Class Tests_GetGiveDonationFormID
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\get_give_donation_form_id
 *
 * @group   extend-give-wp
 * @group   support
 */
class Tests_GetGiveDonationFormID extends TestCase {

	/**
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 5, has_action( 'give_pre_form', 'spiralWebDb\ExtendGiveWP\get_give_donation_form_id' ) );
	}

	/**
	 *  Test get_give_donation_form_id() should return the donation form_id when given the post_id.
	 */
	public function test_should_return_the_donation_form_id_when_given_post_id() {
		$form_id = $this->factory()->post->create();

		$this->assertSame( $form_id, get_give_donation_form_id( $form_id ) );
	}
}

