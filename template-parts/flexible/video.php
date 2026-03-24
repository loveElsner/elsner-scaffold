<?php
/**
 * Flexible content layout: Video Section.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$video_url   = get_sub_field( 'video_url' );
$poster      = get_sub_field( 'poster' );

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-video-section' );
$section_style = elsner_scaffold_section_style( $settings );

if ( ! $video_url ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">

		<?php if ( $heading || $description ) : ?>
			<div class="es-section-header">
				<?php if ( $heading ) : ?>
					<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="es-section-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="es-video-section__wrapper">
			<?php if ( $poster ) : ?>
				<div class="es-video-section__poster js-video-poster" data-video="<?php echo esc_url( $video_url ); ?>">
					<?php elsner_scaffold_render_image( $poster, 'elsner-wide', array( 'class' => 'es-video-section__poster-img' ) ); ?>
					<button class="es-video-section__play-btn js-video-play" aria-label="<?php esc_attr_e( 'Play Video', 'elsner-scaffold' ); ?>">
						<svg width="64" height="64" viewBox="0 0 24 24" fill="white" aria-hidden="true">
							<circle cx="12" cy="12" r="10" fill="rgba(0,0,0,0.6)"/>
							<polygon points="10 8 16 12 10 16 10 8"/>
						</svg>
					</button>
				</div>
			<?php else : ?>
				<div class="embed-responsive es-video-section__embed">
					<?php echo wp_oembed_get( esc_url( $video_url ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>
