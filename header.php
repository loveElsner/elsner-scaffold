<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'elsner-scaffold' ); ?>
	</a>

	<header id="masthead" class="site-header<?php echo get_theme_mod( 'elsner_scaffold_sticky_header', true ) ? ' site-header--sticky' : ''; ?>" role="banner">
		<div class="container">
			<div class="site-header__inner">

				<?php get_template_part( 'template-parts/header/site-branding' ); ?>

				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'elsner-scaffold' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'menu_class'      => 'nav nav--primary',
							'container'       => false,
							'walker'          => new Elsner_Scaffold_Nav_Walker(),
							'fallback_cb'     => false,
						)
					);
					?>
				</nav>

				<div class="site-header__actions">
					<?php get_template_part( 'template-parts/header/header-actions' ); ?>

					<button class="nav-toggle js-nav-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'elsner-scaffold' ); ?>">
						<span class="nav-toggle__bar"></span>
						<span class="nav-toggle__bar"></span>
						<span class="nav-toggle__bar"></span>
					</button>
				</div>

			</div><!-- .site-header__inner -->
		</div><!-- .container -->

		<?php
		/**
		 * Header search panel — direct child of <header>, outside .container.
		 * Being a sibling of .container (not nested inside .site-header__actions)
		 * guarantees that:
		 *  - position: absolute references #masthead as the containing block.
		 *  - left: 0 / right: 0 stretch to the full header width, not the
		 *    narrow right-side actions column.
		 *  - No flex / overflow context can clip or re-anchor the panel.
		 *
		 * NOTE: The mobile-menu (#mobile-menu) is intentionally placed OUTSIDE
		 * <header> (see below). Keeping it inside would trap it in the header's
		 * stacking context and — when backdrop-filter is active on .is-scrolled —
		 * make its position:fixed behave relative to the header box rather than
		 * the viewport, breaking the full-screen overlay and body-scroll lock.
		 */
		?>
		<div
			id="header-search-panel"
			class="header-search js-header-search"
			role="search"
			aria-hidden="true"
			aria-label="<?php esc_attr_e( 'Site search', 'elsner-scaffold' ); ?>"
		>
			<div class="container">
				<?php get_search_form(); ?>
				<button
					class="header-search__close js-search-close"
					aria-label="<?php esc_attr_e( 'Close search', 'elsner-scaffold' ); ?>"
				>
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
						<path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
			</div>
		</div><!-- .header-search -->

	</header><!-- #masthead -->

	<?php
	/**
	 * Mobile navigation drawer — rendered OUTSIDE <header#masthead>.
	 *
	 * IMPORTANT: Do NOT move this back inside <header>.
	 *
	 * When backdrop-filter is applied to a sticky/positioned ancestor, CSS
	 * promotes that ancestor into a containing block for position:fixed
	 * descendants (per the CSS Transforms / Filters spec).  Placing the
	 * mobile drawer inside the header would therefore anchor its
	 * position:fixed; inset:0 overlay to the header's own bounding box
	 * instead of the viewport, causing two distinct bugs:
	 *
	 *   1. The dark backdrop only covers the header strip, not the page.
	 *   2. document.body overflow:hidden stops scrolling the body but the
	 *      drawer panel itself becomes un-scrollable because its scroll
	 *      container is clipped to the misplaced fixed rect.
	 *
	 * Keeping the drawer as a direct child of #page (a plain block/flex
	 * container with no filter or transform) guarantees inset:0 always
	 * maps to the viewport.
	 */
	get_template_part( 'template-parts/header/mobile-menu' );
	?>
