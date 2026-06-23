<?php
/**
 * Plugin Name:       NExT AddToAny Block Widget
 * Description:       AddToAnyプラグインのウィジェット機能をブロックエディタで使用できるようにします。
 * Version:           0.2.0
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Author:            NExT-Season - WordPress Telex
 * Author URI:        https://next-season.net/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       next-addtoany-block
 *
 * @package NextAddToAnyBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function next_addtoany_block_init() {
	register_block_type( __DIR__ . '/build/' );
}
add_action( 'init', 'next_addtoany_block_init' );

/**
 * Check if AddToAny plugin is active and show admin notice if not
 */
function next_addtoany_block_check_dependencies() {
	if ( ! class_exists( 'A2A_SHARE_SAVE_Widget' ) && current_user_can( 'activate_plugins' ) ) {
		add_action( 'admin_notices', 'next_addtoany_block_missing_plugin_notice' );
	}
}
add_action( 'admin_init', 'next_addtoany_block_check_dependencies' );

/**
 * Display admin notice when AddToAny is not active
 */
function next_addtoany_block_missing_plugin_notice() {
	?>
	<div class="notice notice-warning is-dismissible">
		<p>
			<?php
			echo wp_kses_post(
				sprintf(
					/* translators: %s: AddToAny plugin link */
					__( '<strong>NExT AddToAny Block Widget</strong> requires the <a href="%s" target="_blank">AddToAny Share Buttons</a> plugin to be installed and activated.', 'next-addtoany-block' ),
					'https://wordpress.org/plugins/add-to-any/'
				)
			);
			?>
		</p>
	</div>
	<?php
}
