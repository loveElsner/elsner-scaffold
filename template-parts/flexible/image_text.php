<?php
/**
 * Flexible content layout: Image + Text.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$image          = get_sub_field( 'image' );
$eyebrow        = get_sub_field( 'eyebrow' );
$heading        = get_sub_field( 'heading' );
$content        = get_sub_field( 'content' );
$cta            = get_sub_field( 'cta' );
$image_position = get_sub_field( 'image_position' ) ?: 'left';

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class  = elsner_scaffold_section_classes( $settings, 'es-image-text' );
$section_class .= ' es-image-text--img-' . sanitize_html_class( $image_position );
$section_style  = elsner_scaffold_section_style( $settings );
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="es-image-text__grid">

			<div class="es-image-text__media">
				<?php if ( $image ) : ?>
					<?php elsner_scaffold_render_image( $image, 'elsner-card', array( 'class' => 'es-image-text__img' ) ); ?>
				<?php endif; ?>
			</div>

			<div class="es-image-text__content">

				<?php if ( $eyebrow ) : ?>
					<span class="es-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<div class="wysiwyg-content">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $cta && ! empty( $cta['url'] ) ) : ?>
					<div class="es-image-text__cta">
						<?php elsner_scaffold_render_button( $cta, 'btn btn--primary' ); ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</div>
</section>
