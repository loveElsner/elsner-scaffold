<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( '404', 'elsner-scaffold' ); ?></h1>
				<p class="page-subtitle"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'elsner-scaffold' ); ?></p>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'elsner-scaffold' ); ?></p>

				<?php get_search_form(); ?>

				<div class="error-404__widget-area">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( wp_count_posts()->publish >= 1 ) : ?>
						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'elsner-scaffold' ); ?></h2>
							<ul>
								<?php
								wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
								);
								?>
							</ul>
						</div>
					<?php endif; ?>
				</div>

				<p>
					<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( '&larr; Back to Home', 'elsner-scaffold' ); ?>
					</a>
				</p>
			</div>
		</section>
	</div>
</main><!-- #primary -->

<?php
get_footer();
