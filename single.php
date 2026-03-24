<?php
/**
 * The template for displaying all single posts.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<div class="content-area">

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

		</div>
	</div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
