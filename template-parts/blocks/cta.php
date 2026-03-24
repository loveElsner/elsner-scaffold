<?php
/**
 * ACF Block: CTA Block.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$heading    = get_field( 'heading' );
$text       = get_field( 'text' );
$button     = get_field( 'button' );
$bg_color   = get_field( 'background_color' ) ?: 'primary';
$align      = get_block_alignment();
$class_name = get_field( 'extra_classes' );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'es-cta-block es-section es-section--bg-' . sanitize_html_class( $bg_color ) . ( $class_name ? ' ' . esc_attr( $class_name ) : '' ),
	)
);
?>
<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="es-cta-banner__inner">
			<div class="es-cta-banner__content">
				<?php if ( $heading ) : ?>
					<h2 class="es-cta-banner__heading"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $text ) : ?>
					<p class="es-cta-banner__subheading"><?php echo esc_html( $text ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( $button && ! empty( $button['url'] ) ) : ?>
				<div class="es-cta-banner__actions">
					<?php elsner_scaffold_render_button( $button, 'btn btn--white' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
