<?php
/**
 *  Tests for render_form_featured_image_and_caption()
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
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/support/load-assets.php';
	}

	/**
	 * Test should render form featured image and caption given $form_id and image size.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_form_featured_image_and_caption( $form_id, $attachment_id, $excerpt, $expected_view ) {
		Functions\expect( 'get_give_donation_form_id' )
			->zeroOrMoreTimes()
			->with( 'form_id' )
			->andReturn( $form_id );
		Functions\expect( 'get_option' )
			->zeroOrMoreTimes()
			->with( 'extend-give-wp', [] )
			->andReturn( $attachment_id );
		Functions\expect( 'get_post_field' )
			->zeroOrMoreTimes()
			->with( 'post_excerpt', 'attachment_id' )
			->andReturn( $excerpt );
		Functions\when( 'wp_get_attachment_image' )->justReturn();
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );
		Functions\expect( 'esc_attr' )
			->zeroOrMoreTimes()
			->with( 'attachment_id' )
			->andReturn( $attachment_id )
			->andAlsoExpectIt()
			->zeroOrMoreTimes()
			->with( 'post_excerpt' )
			->andReturn( $excerpt );

		ob_start();
		render_form_featured_image_and_caption( $form_id, 'large' );
		$actual_view = ob_get_clean();

		$this->assertSame( $expected_view, $actual_view );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'post data is empty'     => [
				'form_id'       => '',
				'attachment_id' => 0,
				'post_excerpt'  => '',
				'expected_view' => '',
			],
			'post data is non-empty' => [
				'form_id'       => 39,
				'attachment_id' => 144,
				'post_excerpt'  => 'Members of the Cornerstone Chorale & Brass during their 2018 tour.',
				'expected_view' => <<<FEATURED_IMAGE_VIEW
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-144" aria-describedby="donation-form-featured-image">
	<figcaption id="donation-form-image-caption" class="featured-image-caption"><em>Members of the Cornerstone Chorale & Brass during their 2018 tour.</em></figcaption>
</figure>
FEATURED_IMAGE_VIEW
				,
			],
		];
	}
}

