<?php
/**
 * Template part for displaying page content (fallback, no flexible content).
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php elsner_scaffold_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elsner-scaffold' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit Page', 'elsner-scaffold' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>

</article>
