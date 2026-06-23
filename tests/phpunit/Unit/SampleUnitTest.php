<?php
/**
 * @package NextAddToAnyBlock
 */

namespace NextAddToAnyBlock\Tests\Unit;

use Yoast\WPTestUtils\BrainMonkey\TestCase;

/**
 * 基本的な Unit テスト（WordPress 非依存）。
 */
class SampleUnitTest extends TestCase {

	/**
	 * メインプラグインファイルが存在することを確認する。
	 */
	public function test_main_plugin_file_exists(): void {
		$this->assertFileExists( dirname( __DIR__, 3 ) . '/next-addtoany-block.php' );
	}

	/**
	 * build/block.json が存在することを確認する。
	 */
	public function test_build_block_json_exists(): void {
		$this->assertFileExists( dirname( __DIR__, 3 ) . '/build/block.json' );
	}
}
