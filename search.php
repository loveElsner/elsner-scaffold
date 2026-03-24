<?php
/**
 * The template for displaying search results pages.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'elsner-scaffold' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content/content', 'excerpt' ); ?>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>

	</div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
