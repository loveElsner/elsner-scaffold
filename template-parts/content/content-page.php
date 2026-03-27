<?php
/**
 * Template part for displaying page content (fallback — no flexible content).
 *
 * Rendered inside .container--narrow > .page-entry from page.php.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-article' ); ?>>

	<header class="page-article__header entry-header">
		<?php the_title( '<h1 class="page-article__title entry-title">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="page-article__thumbnail">
			<?php
			the_post_thumbnail(
				'elsner-wide',
				array(
					'class'   => 'page-article__thumbnail-img',
					'loading' => 'eager',
					'alt'     => get_the_title(),
				)
			);
			?>
		</div>
	<?php endif; ?>

	<div class="page-article__content entry-content wysiwyg">
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

	<footer class="page-article__footer entry-footer">
		<?php
		edit_post_link(
			esc_html__( 'Edit Page', 'elsner-scaffold' ),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer>

</article>
