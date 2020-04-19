<?php
/**
 * Bootstraps the Plugin's Unit Tests.
 *
 * @since       1.0.0
 * @package     spiralWebDb\ExtendGiveWP\tests\phpunit\Unit
 * @link        https://github.com/rgadon107/starter-plugin
 * @license     GNU-2.0+
 */

namespace spiralWebDb\ExtendGiveWP\tests\phpunit\Unit;

use function spiralWebDb\ExtendGiveWP\tests\phpunit\load_composer_autoloader;

/**
 * Gets the Unit test's root directory.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_test_root_dir() {
	return __DIR__;
}

/**
 * Load the test suite's dependencies.
 *
 * @since 1.0.0
 */
function load_dependencies() {
	require_once dirname( __DIR__ ) . '/functions.php';
	load_composer_autoloader();

	require_once dirname( __DIR__ ) . '/TestCaseTrait.php';
	require_once get_test_root_dir() . '/TestCase.php';
}

load_dependencies();
