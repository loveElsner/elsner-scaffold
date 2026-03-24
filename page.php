<?php
/**
 * The template for displaying all pages.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		// Use flexible content if available.
		if ( elsner_scaffold_has_acf() && have_rows( 'flexible_content' ) ) :
			elsner_scaffold_render_flexible_content();
		else :
			get_template_part( 'template-parts/content/content', 'page' );
		endif;

		// Display page comments.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>

</main><!-- #primary -->

<?php
get_footer();
