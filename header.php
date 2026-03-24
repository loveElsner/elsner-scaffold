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

		<?php get_template_part( 'template-parts/header/mobile-menu' ); ?>
	</header><!-- #masthead -->
