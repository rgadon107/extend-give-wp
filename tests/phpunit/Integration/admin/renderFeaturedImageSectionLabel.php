<?php
/**
 *  Tests for render_featured_image_section_label()
 *
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @package    spiralWebDb\ExtendGiveWP\Tests\Integration
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\ExtendGiveWP\Tests\Integration;

use spiralWebDb\ExtendGiveWP\tests\phpunit\Integration\TestCase;
use function spiralWebDb\ExtendGiveWP\Admin\render_featured_image_section_label;

/**
 * Class Test_RenderFeaturedImageSectionLabel
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\Admin\render_featured_image_section_label
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_RenderFeaturedImageSectionLabel extends TestCase {

	/*
 * Test render_featured_image_section_label() should render featured image section view file.
 */
	public function test_should_render_featured_image_section_label() {
		$expected_view = <<<FEATURED_IMAGE_SECTION_LABEL
<p class="description">The featured image settings for the donation form.</p>

FEATURED_IMAGE_SECTION_LABEL;

		ob_start();
		render_featured_image_section_label();
		$this->assertEquals( $expected_view, ob_get_clean() );
	}
}

