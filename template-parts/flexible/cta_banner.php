<?php
/**
 * Flexible content layout: CTA Banner.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$heading          = get_sub_field( 'heading' );
$subheading       = get_sub_field( 'subheading' );
$primary_button   = get_sub_field( 'primary_button' );
$secondary_button = get_sub_field( 'secondary_button' );

$settings = array(
	'background_style' => get_sub_field( 'background_style' ) ?: 'primary',
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-cta-banner' );
$section_style = elsner_scaffold_section_style( $settings );

if ( ! $heading ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="es-cta-banner__overlay" aria-hidden="true"></div>
	<div class="container">
		<div class="es-cta-banner__inner">

			<div class="es-cta-banner__content">
				<h2 class="es-cta-banner__heading"><?php echo esc_html( $heading ); ?></h2>

				<?php if ( $subheading ) : ?>
					<p class="es-cta-banner__subheading"><?php echo esc_html( $subheading ); ?></p>
				<?php endif; ?>
			</div>

			<div class="es-cta-banner__actions">
				<?php if ( $primary_button && ! empty( $primary_button['url'] ) ) : ?>
					<?php elsner_scaffold_render_button( $primary_button, 'btn btn--white' ); ?>
				<?php endif; ?>

				<?php if ( $secondary_button && ! empty( $secondary_button['url'] ) ) : ?>
					<?php elsner_scaffold_render_button( $secondary_button, 'btn btn--outline-white' ); ?>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
