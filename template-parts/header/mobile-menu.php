<?php
/**
 * Template part: mobile navigation drawer.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>
<div id="mobile-menu" class="mobile-menu js-mobile-menu" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'elsner-scaffold' ); ?>">
	<div class="mobile-menu__overlay js-mobile-overlay"></div>

	<div class="mobile-menu__panel">
		<div class="mobile-menu__header">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-menu__logo" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>

			<button class="mobile-menu__close js-mobile-close" aria-label="<?php esc_attr_e( 'Close menu', 'elsner-scaffold' ); ?>">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
					<path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</button>
		</div>

		<div class="mobile-menu__body">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'mobile',
					'menu_id'        => 'mobile-nav-menu',
					'menu_class'     => 'mobile-nav',
					'container'      => false,
					'walker'         => new Elsner_Scaffold_Nav_Walker(),
					'fallback_cb'    => function () {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'mobile-nav-menu',
								'menu_class'     => 'mobile-nav',
								'container'      => false,
								'walker'         => new Elsner_Scaffold_Nav_Walker(),
								'fallback_cb'    => false,
							)
						);
					},
				)
			);
			?>
		</div>
	</div>
</div>
