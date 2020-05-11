<?php
/**
 *  Tests for render_form_featured_image_and_caption()
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
use function spiralWebDb\ExtendGiveWP\render_form_featured_image_and_caption;

/**
 * Class Tests_RenderFormFeaturedImageAndCaption
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\render_form_featured_image_and_caption
 *
 * @group   extend-give-wp
 * @group   support
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Tests_RenderFormFeaturedImageAndCaption extends TestCase {

	/**
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 5, has_action( 'give_pre_form', 'spiralWebDb\ExtendGiveWP\get_give_donation_form_id' ) );
	}

	/**
	 *  Test get_give_donation_form_id() should return the donation form_id when given the post_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_return_the_donation_form_id_when_given_post_id( $option, $excerpt ) {
		$form_id       = $this->factory()->post->create();
		$form_id       = get_give_donation_form_id( $form_id );
		$options       = add_option( 'extend-give-wp', $option['featured-image-id'] );
		$attachment_id = get_option( 'extend-give-wp' );
		$post_excerpt  = get_post_field( $excerpt, $attachment_id );

		ob_start();
		echo wp_get_attachment_image( $attachment_id, $size = 'large', $icon = false, $attr = [ 'class' => 'featured-image' ] );
		render_form_featured_image_and_caption( $form_id, 'large' );
		$actual = ob_get_clean();

//		$this->assertSame( $form_id, render_form_featured_image_and_caption( $form_id, $size = 'large' ) );
	}

	public function addTestData() {
		return [
			'render_donation_form ' => [
				'option_data'  => [
					'featured-image-id' => 144
				],
				'post_excerpt' => 'Members of the Cornerstone Chorale & Brass during their 2018 tour.'
			]
		];
	}
}


