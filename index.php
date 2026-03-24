<?php
/**
 * The main template file.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			?>

			<div class="posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;
				?>
			</div>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>
	</div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
