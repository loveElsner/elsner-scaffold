<?php
/**
 * Flexible content layout: Text Block.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow    = get_sub_field( 'eyebrow' );
$heading    = get_sub_field( 'heading' );
$content    = get_sub_field( 'content' );
$width      = get_sub_field( 'width' ) ?: 'wide';
$text_align = get_sub_field( 'text_align' ) ?: 'left';

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-text-block' );
$section_class .= ' es-text-block--' . sanitize_html_class( $text_align );
$section_style  = elsner_scaffold_section_style( $settings );
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="es-text-block__inner es-text-block__inner--<?php echo esc_attr( $width ); ?>">

			<?php if ( $eyebrow ) : ?>
				<span class="es-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
			<?php endif; ?>

			<?php if ( $heading ) : ?>
				<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="es-text-block__content wysiwyg-content">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
