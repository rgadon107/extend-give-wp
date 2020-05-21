<?php
/**
 *  Tests for initialize_option_settings()
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
use function spiralWebDb\ExtendGiveWP\Admin\initialize_option_settings;

/**
 * Class Test_RenderOptionPageTemplate
 *
 * @covers ::\spiralWebDb\ExtendGiveWP\Admin\initialize_option_settings
 *
 * @group   extend-give-wp
 * @group   admin
 *
 * phpcs:disable Squiz.Commenting.FunctionComment.MissingParamTag
 */
class Test_RenderOptionPageTemplate extends TestCase {

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/admin/option-settings-admin.php';
	}

	/**
	 * Test initialize_option_settings() initializes option settings.
	 */
	public function test_function_initializes_options_settings() {
		Functions\expect( 'register_setting' )
			->once()
			->with( 'extend-give-wp', 'extend-give-wp' )
			->andReturnNull();
		Functions\expect( 'add_settings_section' )
			->once()
			->with(
				'featured-image-section',
				'Featured Image',
				'spiralWebDb\ExtendGiveWP\Admin\render_featured_image_section_label',
				'extend-give-wp'
			)
			->andReturnNull();
		Functions\expect( 'add_settings_field' )
			->once()
			->with(
				'featured-image-id',
				'Featured Image ID',
				'spiralWebDb\ExtendGiveWP\Admin\render_featured_image_id_field',
				'extend-give-wp',
				'featured-image-section',
				[
					'label_for' => 'featured-image-id',
					'class'     => 'featured-image-id',
				]
			)
			->andReturnNull();

		$this->assertNull( initialize_option_settings() );
	}
}

