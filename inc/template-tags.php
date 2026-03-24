<?php
/**
 * Custom template tags for this theme.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'elsner_scaffold_posted_on' ) ) {
	/**
	 * Print post date/time and author.
	 */
	function elsner_scaffold_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		printf(
			'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span> <span class="byline"> %4$s <a class="author-link" href="%5$s">%6$s</a></span>',
			esc_html_x( 'Posted on', 'post date', 'elsner-scaffold' ),
			esc_url( get_permalink() ),
			$time_string,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html_x( 'by', 'post author', 'elsner-scaffold' ),
			esc_url( $author_url ),
			esc_html( get_the_author() )
		);
	}
}

if ( ! function_exists( 'elsner_scaffold_entry_footer' ) ) {
	/**
	 * Print categories, tags and edit link.
	 */
	function elsner_scaffold_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$cats = get_the_category_list( esc_html__( ', ', 'elsner-scaffold' ) );
			if ( $cats ) {
				/* translators: 1: list of categories. */
				printf(
					'<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'elsner-scaffold' ) . '</span>',
					$cats // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			$tags = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'elsner-scaffold' ) );
			if ( $tags ) {
				/* translators: 1: list of tags. */
				printf(
					'<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'elsner-scaffold' ) . '</span>',
					$tags // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'elsner-scaffold' ),
					array( 'span' => array( 'class' => array() ) )
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'elsner_scaffold_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function elsner_scaffold_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'elsner-wide', array( 'class' => 'post-thumbnail__img' ) ); ?>
			</div>
			<?php
		} else {
			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'elsner-card',
					array(
						'alt'   => the_title_attribute( array( 'echo' => false ) ),
						'class' => 'post-thumbnail__img',
					)
				);
				?>
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'elsner_scaffold_comment_author_avatar' ) ) {
	/**
	 * Render comment author avatar.
	 *
	 * @param array $comment Comment data.
	 * @param int   $size    Avatar size.
	 */
	function elsner_scaffold_comment_author_avatar( $comment, $size = 56 ) {
		echo get_avatar( $comment, $size, '', '', array( 'class' => 'comment-author__avatar' ) );
	}
}

if ( ! function_exists( 'elsner_scaffold_the_breadcrumb' ) ) {
	/**
	 * Output a simple breadcrumb trail.
	 */
	function elsner_scaffold_the_breadcrumb() {
		if ( is_front_page() ) {
			return;
		}

		$sep = '<span class="breadcrumb__sep" aria-hidden="true">/</span>';

		echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'elsner-scaffold' ) . '">';
		echo '<ol class="breadcrumb__list">';

		echo '<li class="breadcrumb__item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'elsner-scaffold' ) . '</a>' . $sep . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( is_single() ) {
			$cats = get_the_category();
			if ( $cats ) {
				echo '<li class="breadcrumb__item"><a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>' . $sep . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			echo '<li class="breadcrumb__item breadcrumb__item--current" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
		} elseif ( is_page() ) {
			$ancestors = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $ancestors ) as $ancestor_id ) {
				echo '<li class="breadcrumb__item"><a href="' . esc_url( get_permalink( $ancestor_id ) ) . '">' . esc_html( get_the_title( $ancestor_id ) ) . '</a>' . $sep . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			echo '<li class="breadcrumb__item breadcrumb__item--current" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
		} elseif ( is_archive() ) {
			echo '<li class="breadcrumb__item breadcrumb__item--current" aria-current="page">' . esc_html( get_the_archive_title() ) . '</li>';
		} elseif ( is_search() ) {
			echo '<li class="breadcrumb__item breadcrumb__item--current" aria-current="page">' . esc_html__( 'Search Results', 'elsner-scaffold' ) . '</li>';
		} elseif ( is_404() ) {
			echo '<li class="breadcrumb__item breadcrumb__item--current" aria-current="page">' . esc_html__( 'Page Not Found', 'elsner-scaffold' ) . '</li>';
		}

		echo '</ol></nav>';
	}
}

if ( ! function_exists( 'elsner_scaffold_reading_time_label' ) ) {
	/**
	 * Output reading time label.
	 *
	 * @param int|null $post_id Post ID.
	 */
	function elsner_scaffold_reading_time_label( $post_id = null ) {
		$minutes = elsner_scaffold_reading_time( $post_id );

		printf(
			'<span class="reading-time">%s</span>',
			/* translators: %d: number of minutes */
			esc_html( sprintf( _n( '%d min read', '%d min read', $minutes, 'elsner-scaffold' ), $minutes ) )
		);
	}
}
