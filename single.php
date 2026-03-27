<?php
/**
 * The template for displaying all single posts.
 *
 * Content is capped at .container--narrow (900 px) so the reading line
 * never stretches across a wide desktop viewport.  Post navigation and
 * comments share the same column.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container container--narrow">
		<div class="single-entry">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'single' );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'elsner-scaffold' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'elsner-scaffold' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>

		</div><!-- .single-entry -->
	</div><!-- .container -->
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
