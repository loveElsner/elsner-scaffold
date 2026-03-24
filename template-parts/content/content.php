<?php
/**
 * Template part for displaying posts.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

	<?php elsner_scaffold_post_thumbnail(); ?>

	<div class="post-card__body">

		<?php
		$categories = get_the_category();
		if ( $categories ) :
			?>
			<div class="post-card__cats">
				<?php foreach ( array_slice( $categories, 0, 2 ) as $category ) : ?>
					<a class="post-card__cat-link" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
						<?php echo esc_html( $category->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title post-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>

		<div class="entry-meta post-card__meta">
			<?php elsner_scaffold_posted_on(); ?>
			<?php elsner_scaffold_reading_time_label(); ?>
		</div>

		<div class="entry-summary post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<footer class="entry-footer post-card__footer">
			<a class="btn btn--text" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read More', 'elsner-scaffold' ); ?>
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
		</footer>

	</div>

</article>
