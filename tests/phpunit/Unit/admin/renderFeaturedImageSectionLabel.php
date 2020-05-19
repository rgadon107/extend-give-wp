<?php
/**
 *  Tests for render_featured_image_section_label()
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

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/admin/option-settings-admin.php';
	}

	/**
	 * Test render_featured_image_section_label() should render featured image section view file.
	 */
	public function test_should_render_featured_image_section_label() {
		Functions\expect( 'spiralWebDb\ExtendGiveWP\_get_plugin_dir' )->andReturn( EXTEND_GIVE_WP_ROOT_DIR );
		$expected_view = <<<FEATURED_IMAGE_SECTION_LABEL
<p class="description">The featured image settings for the donation form.</p>

FEATURED_IMAGE_SECTION_LABEL;

		ob_start();
		render_featured_image_section_label();
		$this->assertEquals( $expected_view, ob_get_clean() );
	}
}
