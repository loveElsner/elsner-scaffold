<?php
/**
 * Template part for displaying posts in search results.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<?php elsner_scaffold_post_thumbnail(); ?>
	<div class="post-card__body">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title post-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>
		<div class="entry-meta post-card__meta">
			<?php elsner_scaffold_posted_on(); ?>
		</div>
		<div class="entry-summary post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<footer class="entry-footer post-card__footer">
			<a class="btn btn--text" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read More', 'elsner-scaffold' ); ?>
			</a>
		</footer>
	</div>
</article>
