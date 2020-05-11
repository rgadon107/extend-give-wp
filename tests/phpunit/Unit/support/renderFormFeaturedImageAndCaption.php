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
	public function test_should_render_form_featured_image_and_caption( $post_data, $html, $expected_view ) {
		Functions\expect( 'get_give_donation_form_id' )
			->once()
			->with( 'form_id' )
			->andReturn( $post_data['form_id'] );
		Functions\expect( 'get_option' )
			->once()
			->with( 'extend-give-wp', [] )
			->andReturn( $post_data['attachment_id'] );
		Functions\expect( 'get_post' )
			->once()
			->with( $post_data['attachment_id'] )
			->andReturn( 'WP_Post' );
		Functions\expect( 'wp_get_attachment_image' )
			->once()
			->with( $post_data['attachment_id'], 'large', false, [ 'class' => 'featured-image' ] )
			->andReturn( $html );
		Functions\expect( '_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );

		ob_start();
		render_form_featured_image_and_caption( $post_data['form_id'], 'large' );
		$actual_view = ob_get_clean();

		$this->assertSame( $expected_view, $actual_view );
	}

	/**
	 *  Data provider for unit test method.
	 */
	public function addTestData() {
		return [
			'donation form featured image and caption' => [
				'post_data'           => [
					'form_id'       => 39,
					'attachment_id' => 144,
					'post_excerpt'  => 'Members of the Cornerstone Chorale & Brass during their 2018 tour.',
				],
				'expected_html_image' => <<<HTML_IMAGE
<img src="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" class="featured-image jetpack-lazy-image jetpack-lazy-image--handled" alt="tour members of the 2018 cornerstone chorale and brass" data-attachment-id="1411" data-permalink="https://cornerstonechorale.org/2018-cornerstone-tour-members-1024-x-819/" data-orig-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" data-orig-size="1024,819" data-comments-opened="0" data-image-meta=“{“aperture”:”0”,”credit”:””,”camera”:””,”caption”:””,”created_timestamp”:”0”,”copyright”:””,”focal_length”:”0”,”iso”:”0”,”shutter_speed”:”0”,”title”:””,”orientation”:”1”}” data-image-title="2018 Cornerstone Tour members | 1024 x 819" data-image-description="" data-medium-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=300%2C240&&ssl=1" data-large-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" srcset="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?w=1024&&ssl=1 1024w, https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?resize=300%2C240&&ssl=1 300w, https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?resize=768%2C614&&ssl=1 768w" data-lazy-loaded="1" sizes="(max-width: 1000px) 100vw, 1000px" width="1024" height="819">
HTML_IMAGE
				,
				'expected_view'       => <<<FEATURED_IMAGE_VIEW
<figure id="donation-form-featured-image" class="donate-page-featured-image attachment-144" aria-describedby="donation-form-featured-image">
	<img src="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" class="featured-image jetpack-lazy-image jetpack-lazy-image--handled" alt="tour members of the 2018 cornerstone chorale and brass" data-attachment-id="1411" data-permalink="https://cornerstonechorale.org/2018-cornerstone-tour-members-1024-x-819/" data-orig-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" data-orig-size="1024,819" data-comments-opened="0" data-image-meta=“{“aperture”:”0”,”credit”:””,”camera”:””,”caption”:””,”created_timestamp”:”0”,”copyright”:””,”focal_length”:”0”,”iso”:”0”,”shutter_speed”:”0”,”title”:””,”orientation”:”1”}” data-image-title="2018 Cornerstone Tour members | 1024 x 819" data-image-description="" data-medium-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=300%2C240&&ssl=1" data-large-file="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?fit=1024%2C819&&ssl=1" srcset="https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?w=1024&&ssl=1 1024w, https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?resize=300%2C240&&ssl=1 300w, https://i2.wp.com/cornerstonechorale.org/wp-content/uploads/2019/11/2018-Cornerstone-Tour-members-1024-x-819.jpg?resize=768%2C614&&ssl=1 768w" data-lazy-loaded="1" sizes="(max-width: 1000px) 100vw, 1000px" width="1024" height="819">
	<figcaption id="donation-form-image-caption" class="featured-image-caption"><em>Members of the Cornerstone Chorale & Brass during their 2018 tour.</em></figcaption>
</figure>
FEATURED_IMAGE_VIEW
				,
			],
		];
	}
}

