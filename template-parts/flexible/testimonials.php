<?php
/**
 * Flexible content layout: Testimonials.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow       = get_sub_field( 'eyebrow' );
$heading       = get_sub_field( 'heading' );
$items         = get_sub_field( 'items' );
$display_style = get_sub_field( 'display_style' ) ?: 'grid';

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class  = elsner_scaffold_section_classes( $settings, 'es-testimonials' );
$section_class .= ' es-testimonials--' . sanitize_html_class( $display_style );
$section_style  = elsner_scaffold_section_style( $settings );

if ( ! $items ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">

		<?php if ( $eyebrow || $heading ) : ?>
			<div class="es-section-header">
				<?php if ( $eyebrow ) : ?>
					<span class="es-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="es-testimonials__wrapper<?php echo 'slider' === $display_style ? ' js-testimonials-slider' : ''; ?>"
			 <?php echo 'slider' === $display_style ? 'data-slider="testimonials"' : ''; ?>>

			<?php foreach ( $items as $item ) : ?>
				<div class="es-testimonial">

					<?php if ( ! empty( $item['rating'] ) ) : ?>
						<div class="es-testimonial__stars" aria-label="<?php /* translators: %s: rating */ printf( esc_attr__( '%s out of 5 stars', 'elsner-scaffold' ), esc_attr( $item['rating'] ) ); ?>">
							<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
								<span class="es-testimonial__star<?php echo $i <= (int) $item['rating'] ? ' es-testimonial__star--filled' : ''; ?>" aria-hidden="true">★</span>
							<?php endfor; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $item['quote'] ) ) : ?>
						<blockquote class="es-testimonial__quote">
							<p><?php echo esc_html( $item['quote'] ); ?></p>
						</blockquote>
					<?php endif; ?>

					<div class="es-testimonial__author">
						<?php if ( ! empty( $item['avatar'] ) ) : ?>
							<div class="es-testimonial__avatar">
								<?php elsner_scaffold_render_image( $item['avatar'], 'thumbnail', array( 'class' => 'es-testimonial__avatar-img' ) ); ?>
							</div>
						<?php endif; ?>

						<div class="es-testimonial__author-info">
							<?php if ( ! empty( $item['author'] ) ) : ?>
								<strong class="es-testimonial__author-name"><?php echo esc_html( $item['author'] ); ?></strong>
							<?php endif; ?>
							<?php if ( ! empty( $item['position'] ) ) : ?>
								<span class="es-testimonial__author-role"><?php echo esc_html( $item['position'] ); ?></span>
							<?php endif; ?>
						</div>
					</div>

				</div>
			<?php endforeach; ?>

		</div>

	</div>
</section>
