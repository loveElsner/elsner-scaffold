<?php
/**
 * Flexible content layout: Hero Banner.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

if ( ! elsner_scaffold_has_acf() ) {
	return;
}

$eyebrow    = get_sub_field( 'eyebrow' );
$heading    = get_sub_field( 'heading' );
$subheading = get_sub_field( 'subheading' );
$buttons    = get_sub_field( 'buttons' );
$image      = get_sub_field( 'image' );
$bg_image   = get_sub_field( 'background_image' );
$alignment  = get_sub_field( 'alignment' ) ?: 'left';
$height     = get_sub_field( 'height' ) ?: 'large';

$section_classes = 'es-section es-hero es-hero--' . sanitize_html_class( $alignment ) . ' es-hero--' . sanitize_html_class( $height );
$style           = '';

if ( $bg_image ) {
	$bg_url  = elsner_scaffold_get_image_url( $bg_image, 'elsner-hero' );
	$style   = ' style="background-image: url(' . esc_url( $bg_url ) . ')"';
	$section_classes .= ' es-hero--has-bg';
}
?>

<section class="<?php echo esc_attr( $section_classes ); ?>"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
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

				<?php if ( $buttons ) : ?>
					<div class="es-hero__buttons">
						<?php foreach ( $buttons as $btn ) : ?>
							<?php if ( ! empty( $btn['link']['url'] ) ) : ?>
								<?php
								$btn_class = 'btn btn--' . sanitize_html_class( $btn['style'] ?? 'primary' );
								elsner_scaffold_render_button( $btn['link'], $btn_class );
								?>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</div>

			<?php if ( $image ) : ?>
				<div class="es-hero__media">
					<?php elsner_scaffold_render_image( $image, 'elsner-hero', array( 'class' => 'es-hero__img', 'loading' => 'eager' ) ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
