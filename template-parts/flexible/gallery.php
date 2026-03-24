<?php
/**
 * Flexible content layout: Gallery.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$heading = get_sub_field( 'heading' );
$images  = get_sub_field( 'images' );
$columns = get_sub_field( 'columns' ) ?: '3';

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-gallery' );
$section_style = elsner_scaffold_section_style( $settings );

if ( ! $images ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">

		<?php if ( $heading ) : ?>
			<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="es-gallery__grid es-gallery__grid--cols-<?php echo esc_attr( $columns ); ?>">
			<?php foreach ( $images as $image ) : ?>
				<figure class="es-gallery__item">
					<a class="es-gallery__link js-gallery-link"
					   href="<?php echo esc_url( $image['url'] ); ?>"
					   data-caption="<?php echo esc_attr( $image['caption'] ); ?>"
					   aria-label="<?php echo esc_attr( $image['alt'] ?: $image['title'] ); ?>">
						<?php
						echo wp_get_attachment_image(
							$image['ID'],
							'elsner-card',
							false,
							array(
								'class'   => 'es-gallery__img',
								'loading' => 'lazy',
								'alt'     => $image['alt'],
							)
						);
						?>
					</a>
					<?php if ( $image['caption'] ) : ?>
						<figcaption class="es-gallery__caption"><?php echo esc_html( $image['caption'] ); ?></figcaption>
					<?php endif; ?>
				</figure>
			<?php endforeach; ?>
		</div>

	</div>
</section>
