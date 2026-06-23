<?php
/**
 * @package NextAddToAnyBlock
 */

namespace NextAddToAnyBlock\Tests\Integration;

use WP_Block_Type_Registry;
use WP_UnitTestCase;

/**
 * ブロックが正しく登録されることを検証する Integration テスト。
 */
class BlockRegistrationTest extends WP_UnitTestCase {

	/**
	 * 初期化用コールバックが定義されている。
	 */
	public function test_init_callback_is_registered(): void {
		$this->assertTrue( function_exists( 'next_addtoany_block_init' ) );
		$this->assertGreaterThan(
			0,
			has_action( 'init', 'next_addtoany_block_init' )
		);
	}

	/**
	 * ブロックタイプ next/addtoany-block が登録されている。
	 */
	public function test_block_type_is_registered(): void {
		$registry = WP_Block_Type_Registry::get_instance();
		$this->assertTrue(
			$registry->is_registered( 'next/addtoany-block' ),
			'ブロック next/addtoany-block が登録されていません。build/block.json を確認してください。'
		);
	}
}
