<?php
/**
 * ACF Block: Hero Banner Block.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow    = get_field( 'eyebrow' );
$heading    = get_field( 'heading' );
$subheading = get_field( 'subheading' );
$button     = get_field( 'button' );
$bg_image   = get_field( 'background_image' );
$alignment  = get_field( 'alignment' ) ?: 'left';

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class' => 'es-hero es-hero--large es-hero--' . sanitize_html_class( $alignment ) . ( $bg_image ? ' es-hero--has-bg' : '' ),
	)
);

$style = '';
if ( $bg_image ) {
	$bg_url = elsner_scaffold_get_image_url( $bg_image, 'elsner-hero' );
	$style  = ' style="background-image:url(' . esc_url( $bg_url ) . ')"';
}
?>
<section <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="es-hero__overlay" aria-hidden="true"></div>
	<div class="container">
		<div class="es-hero__inner">
			<div class="es-hero__content">
				<?php if ( $eyebrow ) : ?>
					<span class="es-eyebrow es-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h1 class="es-hero__heading"><?php echo esc_html( $heading ); ?></h1>
				<?php endif; ?>
				<?php if ( $subheading ) : ?>
					<p class="es-hero__subheading"><?php echo esc_html( $subheading ); ?></p>
				<?php endif; ?>
				<?php if ( $button && ! empty( $button['url'] ) ) : ?>
					<div class="es-hero__buttons">
						<?php elsner_scaffold_render_button( $button, 'btn btn--primary' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
