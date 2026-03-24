	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="site-footer__widgets">
				<div class="container">
					<div class="footer-widgets">
						<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
							<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
								<div class="footer-widgets__column">
									<?php dynamic_sidebar( 'footer-' . $i ); ?>
								</div>
							<?php endif; ?>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="site-footer__bottom">
			<div class="container">
				<div class="site-footer__bottom-inner">
					<p class="site-footer__copyright">
						<?php
						echo wp_kses_post(
							get_theme_mod(
								'elsner_scaffold_footer_copyright',
								sprintf(
									/* translators: 1: copyright symbol, 2: year, 3: site name */
									esc_html__( '%1$s %2$s %3$s. All rights reserved.', 'elsner-scaffold' ),
									'&copy;',
									gmdate( 'Y' ),
									get_bloginfo( 'name' )
								)
							)
						);
						?>
					</p>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
							'menu_class'     => 'footer-nav',
							'container'      => 'nav',
							'container_class' => 'site-footer__nav',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>

					<?php get_template_part( 'template-parts/footer/social-links' ); ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
