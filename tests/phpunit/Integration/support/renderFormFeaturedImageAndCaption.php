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
	 * Clean up the test environment after each test.
	 */
	public function tearDown() {
		parent::tearDown();

		// Database cleanup.
		delete_option( 'extend-give-wp' );
	}

	/**
	 *  Test should check callback registered to action hook has expected priority.
	 */
	public function test_callback_registered_to_action_hook_has_expected_priority() {
		$this->assertEquals( 10, has_action( 'give_pre_form', 'spiralWebDb\ExtendGiveWP\render_form_featured_image_and_caption' ) );
	}

	/**
	 *  Test get_give_donation_form_id() should return the donation form_id when given the post_id.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_return_the_donation_form_id_when_given_post_id( $option, $excerpt, $starts_with, $ends_with ) {
		$form_id = $this->factory()->post->create();
		$form_id = get_give_donation_form_id( $form_id );

		// Add option to database so it can be called.
		add_option( 'extend-give-wp', $option );
		$options = get_option( 'extend-give-wp', [] );

		// Test that the option was added and returns the expected value.
		$this->assertTrue( isset( $options ) );
		$this->assertTrue( isset( $option ) );

		$attachment_id = isset( $options['featured-image-id'] ) ? (int) $options['featured-image-id'] : 0;

		// Create and update an attachment fixture for the test method.
		$args       = [
			'ID'           => $attachment_id,
			'post_excerpt' => $excerpt,
			'post_parent'  => $form_id,
			'post_type'    => 'attachment',
		];
		$attachment = $this->factory()->attachment->create_object( $args );
		// Note: use of core function `wp_update_post` failed to update post_excerpt of attachment object.
		// Note: use of core function `wp_insert_attachment` returned 0. Failed to update attachment object.
		// Note: use of factory method for $attachment property returned 0. Failed to update attachment object.
		// Question: How can the attachment (featured image) object be updated to include both the $attachment_id AND the 'post_excerpt'?

		// Note: This returns falsey (empty string). How to access the 'post_excerpt' from the attachment object?
		$post_excerpt = get_post_field( 'post_excerpt', $attachment_id );

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
			'featured image is not empty' => [
				'option'           => [
					'featured-image-id' => 144,
				],
				'post_excerpt'     => 'Members of the Cornerstone Chorale & Brass during their 2018 tour.',
				'view_starts_with' => <<<FEATURED_IMAGE_VIEW_STARTS_WITH
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-144" aria-describedby="donation-form-featured-image">
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

