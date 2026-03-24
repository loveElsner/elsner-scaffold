<?php
/**
 * ACF Gutenberg block registration.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register ACF blocks.
 */
function elsner_scaffold_register_acf_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$blocks = array(
		array(
			'name'            => 'elsner-cta',
			'title'           => esc_html__( 'CTA Block', 'elsner-scaffold' ),
			'description'     => esc_html__( 'A call to action block with heading, text, and button.', 'elsner-scaffold' ),
			'render_template' => 'template-parts/blocks/cta.php',
			'category'        => 'elsner-scaffold',
			'icon'            => 'megaphone',
			'keywords'        => array( 'cta', 'call to action', 'button' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
				'mode'   => true,
			),
		),
		array(
			'name'            => 'elsner-hero-banner',
			'title'           => esc_html__( 'Hero Banner Block', 'elsner-scaffold' ),
			'description'     => esc_html__( 'A full-width hero banner block.', 'elsner-scaffold' ),
			'render_template' => 'template-parts/blocks/hero.php',
			'category'        => 'elsner-scaffold',
			'icon'            => 'format-image',
			'keywords'        => array( 'hero', 'banner', 'header' ),
			'supports'        => array(
				'align'  => array( 'full' ),
				'anchor' => true,
				'mode'   => true,
			),
		),
	);

	foreach ( $blocks as $block ) {
		acf_register_block_type( $block );
	}
}
add_action( 'acf/init', 'elsner_scaffold_register_acf_blocks' );
