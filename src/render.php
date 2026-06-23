<?php
/**
 * Server-side rendering of the next/addtoany-block block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @package NextAddToAnyBlock
 */

defined( 'ABSPATH' ) || exit;

// Check if the AddToAny plugin is active.
if ( ! class_exists( 'A2A_SHARE_SAVE_Widget' ) ) {
	?>
	<div <?php echo get_block_wrapper_attributes(); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_block_wrapper_attributes() returns an escaped attribute string. */ ?>>
		<p style="padding: 1em; background: #fff3cd; border: 1px solid #ffc107; border-radius: 4px;">
			<?php esc_html_e( 'AddToAnyプラグインが有効化されていません。このブロックを表示するには、AddToAnyプラグインをインストールして有効化してください。', 'next-addtoany-block' ); ?>
		</p>
	</div>
	<?php
	return;
}

$button_size  = isset( $attributes['buttonSize'] ) ? absint( $attributes['buttonSize'] ) : 32;
$button_style = isset( $attributes['buttonStyle'] ) ? sanitize_text_field( $attributes['buttonStyle'] ) : 'default';

// Build the AddToAny widget instance.
$instance = array(
	'title' => '',
);

// Apply the button size.
if ( 32 !== $button_size ) {
	$instance['button_size'] = $button_size;
}

// Apply the button style.
if ( 'default' !== $button_style ) {
	$instance['button_style'] = $button_style;
}

?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'addtoany-share-buttons' ) ); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_block_wrapper_attributes() returns an escaped attribute string. */ ?>>
	<?php
	// Create an instance of the AddToAny widget.
	$widget = new A2A_SHARE_SAVE_Widget();

	// Output the widget.
	$widget->widget(
		array(
			'before_widget' => '<div class="addtoany-widget-container">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		),
		$instance
	);
	?>
</div>
