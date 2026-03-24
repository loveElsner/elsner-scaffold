<?php
/**
 * Flexible content layout: Stats / Counters.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$heading = get_sub_field( 'heading' );
$items   = get_sub_field( 'items' );

$settings = array(
	'background_style' => get_sub_field( 'background_style' ),
	'background_image' => get_sub_field( 'background_image' ),
	'spacing'          => get_sub_field( 'spacing' ),
	'extra_classes'    => get_sub_field( 'extra_classes' ),
);

$section_class = elsner_scaffold_section_classes( $settings, 'es-stats' );
$section_style = elsner_scaffold_section_style( $settings );

if ( ! $items ) {
	return;
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">

		<?php if ( $heading ) : ?>
			<h2 class="es-section-title es-stats__heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="es-stats__grid">
			<?php foreach ( $items as $item ) : ?>
				<div class="es-stat js-stat-counter" data-value="<?php echo esc_attr( $item['value'] ); ?>">
					<div class="es-stat__value">
						<span class="es-stat__number js-counter-number"><?php echo esc_html( $item['value'] ); ?></span>
						<?php if ( ! empty( $item['suffix'] ) ) : ?>
							<span class="es-stat__suffix"><?php echo esc_html( $item['suffix'] ); ?></span>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $item['label'] ) ) : ?>
						<p class="es-stat__label"><?php echo esc_html( $item['label'] ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
