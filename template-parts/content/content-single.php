<?php
/**
 * Template part for displaying single post content.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

	<?php elsner_scaffold_the_breadcrumb(); ?>

	<header class="entry-header single-post__header">

		<div class="single-post__meta entry-meta">
			<?php elsner_scaffold_posted_on(); ?>
			<?php elsner_scaffold_reading_time_label(); ?>
		</div>

		<?php the_title( '<h1 class="entry-title single-post__title">', '</h1>' ); ?>

	</header>

	<?php elsner_scaffold_post_thumbnail(); ?>

	<div class="entry-content single-post__content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'elsner-scaffold' ),
					array( 'span' => array( 'class' => array() ) )
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elsner-scaffold' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer single-post__footer">
		<?php elsner_scaffold_entry_footer(); ?>
	</footer>

</article>
