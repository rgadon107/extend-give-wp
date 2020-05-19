<?php
/**
 *  Tests for render_featured_image_id_field()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
use function spiralWebDb\ExtendGiveWP\Admin\render_featured_image_id_field;

/**
 * Class Test_RenderFeaturedImageIDField
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\Admin\render_featured_image_id_field
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_RenderFeaturedImageIDField extends TestCase {

	/**
	 * Test render_featured_image_id_field() should render featured image ID field.
	 *
	 * @dataProvider addTestData
	 */
	public function test_should_render_featured_image_id_field( $option, $expected_view ) {
		$options       = get_option( 'extend-give-wp', $option );
		$attachment_id = isset( $option['featured-image-id'] ) ? (int) $option['featured-image-id'] : 0;

		ob_start();
		render_featured_image_id_field();
		$actual_view = ob_get_clean();

		$this->assertEquals( $expected_view, $actual_view );
	}

	/**
	 * Data provider for test method.
	 */
	public function addTestData() {
		return [
			'empty data set'     => [
				'option_data'   => [
					'featured-image-id' => 0,
				],
				'expected_view' => '',
			],
			'non-empty data set' => [
				'option_data'   => [
					'featured-image-id' => 144,
				],
				'expected_view' => <<<FEATURED_IMAGE_ID_FIELD
<label>
	<input id="featured-image-id" class="normal-text" name="extend-give-wp[featured-image-id]" type="number" min="1" aria-describedby="featured-image-attachment-id" value="144">
	<p id="featured-image-input-label" class="description">Enter the image ID for the donation form featured image in the field above.</p>
	<p id="featured-image-input-label" class="description">Get the ID by opening the Media Library, and select the featured image.</p>
	<p id="featured-image-input-label" class="description">View the permalink on the ‘Attachment Details’ page. The ID is the value of the ‘?item=‘ parameter in the permalink.</p>
</label>

FEATURED_IMAGE_ID_FIELD
				,
			],
		];
	}
}

