<?php
/**
 * Flexible content layout: Cards Grid.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow     = get_sub_field( 'eyebrow' );
$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
$cards       = get_sub_field( 'cards' );
$columns     = get_sub_field( 'columns' ) ?: '3';

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class  = elsner_scaffold_section_classes( $settings, 'es-cards-grid' );
$section_style  = elsner_scaffold_section_style( $settings );

if ( ! $cards ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">

		<?php if ( $eyebrow || $heading || $description ) : ?>
			<div class="es-section-header">
				<?php if ( $eyebrow ) : ?>
					<span class="es-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h2 class="es-section-title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="es-section-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="es-cards-grid__grid es-cards-grid__grid--cols-<?php echo esc_attr( $columns ); ?>">
			<?php foreach ( $cards as $card ) : ?>
				<div class="es-card">
					<?php if ( ! empty( $card['icon'] ) ) : ?>
						<div class="es-card__icon">
							<?php elsner_scaffold_render_image( $card['icon'], 'thumbnail', array( 'class' => 'es-card__icon-img', 'loading' => 'lazy' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="es-card__body">
						<?php if ( ! empty( $card['title'] ) ) : ?>
							<h3 class="es-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $card['text'] ) ) : ?>
							<p class="es-card__text"><?php echo esc_html( $card['text'] ); ?></p>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $card['link']['url'] ) ) : ?>
						<div class="es-card__footer">
							<?php elsner_scaffold_render_button( $card['link'], 'btn btn--text es-card__link' ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
