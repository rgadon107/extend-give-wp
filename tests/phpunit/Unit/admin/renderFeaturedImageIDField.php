<?php
/**
 *  Tests for render_featured_image_id_field()
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
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();

		$this->setup_common_wp_stubs();

		require_once EXTEND_GIVE_WP_ROOT_DIR . '/src/admin/option-settings-admin.php';
	}
}
