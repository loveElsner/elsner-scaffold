<?php
/**
 * The template for displaying all pages.
 *
 * Pages that carry ACF flexible content render each section full-width (every
 * block owns its own .container).  Pages without flexible content fall back to
 * a centred narrow column so content never stretches across the full viewport.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( elsner_scaffold_has_acf() && have_rows( 'flexible_content' ) ) : ?>

			<?php
			/*
			 * Flexible-content pages — each section block outputs its own
			 * .container so we render them at full <main> width.
			 */
			elsner_scaffold_render_flexible_content();
			?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="container container--narrow">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<?php
			/*
			 * Standard page (no flexible content) — constrain to a readable
			 * narrow column, add breathing room above and below.
			 */
			?>
			<div class="container container--narrow">
				<div class="page-entry">

					<?php get_template_part( 'template-parts/content/content', 'page' ); ?>

					<?php if ( comments_open() || get_comments_number() ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>

				</div><!-- .page-entry -->
			</div><!-- .container -->

		<?php endif; ?>

	<?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
