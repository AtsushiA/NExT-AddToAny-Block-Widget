<?php
/**
 * PHPUnit bootstrap file for Integration tests (loads the WordPress test suite).
 *
 * @package NextAddToAnyBlock
 */

// Composer autoloader.
require_once dirname( __DIR__, 2 ) . '/vendor/autoload.php';

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// WordPress テストライブラリの関数を読み込む.
require $_tests_dir . '/includes/functions.php';

/**
 * テスト対象プラグインを手動で読み込む.
 */
function _manually_load_plugin() {
	require dirname( __DIR__, 2 ) . '/next-addtoany-block.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// WordPress テスト環境を起動.
require $_tests_dir . '/includes/bootstrap.php';
