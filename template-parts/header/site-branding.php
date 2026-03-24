<?php
/**
 * Template part: site branding.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>
<div class="site-branding">
	<?php
	if ( has_custom_logo() ) :
		the_custom_logo();
	else :
		?>
		<a class="site-branding__name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
	<?php endif; ?>
</div>
