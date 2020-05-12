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
	public function test_should_return_the_donation_form_id_when_given_post_id( $args, $starts_with, $ends_with ) {
		$form_id       = $this->factory()->post->create();
		$form_id       = get_give_donation_form_id( $form_id );
		$attachment_id = $this->factory()->attachment->create_object( $args );
		$post_excerpt  = get_post_field( 'post_excerpt', $attachment_id );
		wp_get_attachment_image( $attachment_id, 'large', $icon = false, $attr = [ 'class' => 'featured-image' ] );

		ob_start();
		render_form_featured_image_and_caption( $form_id, 'large' );
		$actual = ob_get_clean();

		$this->assertStringStartsWith( $starts_with, $actual );
		$this->assertStringEndsWith( $ends_with, $actual );
	}

	/**
	 *  Data provider for integration test method.
	 */
	public function addTestData() {
		return [
			'render_donation_form ' => [
				'attachment_args'  => [
					'post_title'   => '2018 Cornerstone Tour members | 1024 x 819',
					'post_excerpt' => 'Members of the Cornerstone Chorale & Brass during their 2018 tour.',
				],
				'view_starts_with' => <<<FEATURED_IMAGE_VIEW_STARTS_WITH
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-0" aria-describedby="donation-form-featured-image">
FEATURED_IMAGE_VIEW_STARTS_WITH
				,
				'view_ends_with'   => <<<FEATURED_IMAGE_VIEW_ENDS_WITH
	<figcaption id="donation-form-image-caption" class="featured-image-caption"><em>Members of the Cornerstone Chorale & Brass during their 2018 tour.</em></figcaption>
</figure>
FEATURED_IMAGE_VIEW_ENDS_WITH
				,
			],
		];
	}
}

