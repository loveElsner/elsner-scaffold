<?php
/**
 * Theme helper functions.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get flexible content layouts for a given field key and post ID.
 *
 * @param  string   $field_name ACF field name.
 * @param  int|null $post_id    Optional post ID.
 * @return array
 */
function elsner_scaffold_get_flexible_layouts( $field_name = 'flexible_content', $post_id = null ) {
	if ( ! function_exists( 'get_field' ) ) {
		return array();
	}

	$post_id = $post_id ? $post_id : get_the_ID();
	$rows    = get_field( $field_name, $post_id );

	return is_array( $rows ) ? $rows : array();
}

/**
 * Render flexible content layouts.
 *
 * @param string   $field_name ACF field name.
 * @param int|null $post_id    Optional post ID.
 */
function elsner_scaffold_render_flexible_content( $field_name = 'flexible_content', $post_id = null ) {
	if ( ! function_exists( 'have_rows' ) ) {
		return;
	}

	$post_id = $post_id ? $post_id : get_the_ID();

	if ( ! have_rows( $field_name, $post_id ) ) {
		return;
	}

	while ( have_rows( $field_name, $post_id ) ) :
		the_row();

		$layout    = get_row_layout();
		$part_path = 'template-parts/flexible/' . $layout;

		get_template_part( $part_path );

	endwhile;
}

/**
 * Render an ACF image field as an <img> element.
 *
 * @param  array|int $image   ACF image array or attachment ID.
 * @param  string    $size    Image size.
 * @param  array     $attrs   Additional HTML attributes.
 * @param  bool      $echo    Whether to echo or return.
 * @return string|void
 */
function elsner_scaffold_render_image( $image, $size = 'large', $attrs = array(), $echo = true ) {
	if ( empty( $image ) ) {
		return '';
	}

	$id = is_array( $image ) ? $image['ID'] : (int) $image;

	$defaults = array(
		'loading' => 'lazy',
		'class'   => 'es-img',
	);
	$attrs    = wp_parse_args( $attrs, $defaults );

	$html = wp_get_attachment_image( $id, $size, false, $attrs );

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $html;
	}
}

/**
 * Get image URL from ACF image field.
 *
 * @param  array|int $image ACF image array or attachment ID.
 * @param  string    $size  Image size.
 * @return string
 */
function elsner_scaffold_get_image_url( $image, $size = 'large' ) {
	if ( empty( $image ) ) {
		return '';
	}

	if ( is_array( $image ) ) {
		return isset( $image['sizes'][ $size ] ) ? $image['sizes'][ $size ] : $image['url'];
	}

	$src = wp_get_attachment_image_src( (int) $image, $size );
	return $src ? $src[0] : '';
}

/**
 * Render a button / CTA link from ACF link field.
 *
 * @param  array  $link   ACF link array (url, title, target).
 * @param  string $class  CSS class string.
 * @param  bool   $echo   Whether to echo or return.
 * @return string|void
 */
function elsner_scaffold_render_button( $link, $class = 'btn btn--primary', $echo = true ) {
	if ( empty( $link['url'] ) ) {
		return '';
	}

	$target = ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '"' : '';
	$rel    = '_blank' === $link['target'] ? ' rel="noopener noreferrer"' : '';
	$title  = ! empty( $link['title'] ) ? esc_html( $link['title'] ) : esc_html__( 'Learn More', 'elsner-scaffold' );

	$html = sprintf(
		'<a href="%s" class="%s"%s%s>%s</a>',
		esc_url( $link['url'] ),
		esc_attr( $class ),
		$target,
		$rel,
		$title
	);

	if ( $echo ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $html;
	}
}

/**
 * Get section CSS classes based on ACF layout settings.
 *
 * @param  array  $settings Section settings (background, spacing, etc.).
 * @param  string $base     Base class.
 * @return string
 */
function elsner_scaffold_section_classes( $settings = array(), $base = '' ) {
	$classes = array( 'es-section' );

	if ( $base ) {
		$classes[] = sanitize_html_class( $base );
	}

	if ( ! empty( $settings['background_style'] ) ) {
		$classes[] = 'es-section--bg-' . sanitize_html_class( $settings['background_style'] );
	}

	if ( ! empty( $settings['spacing'] ) ) {
		$classes[] = 'es-section--spacing-' . sanitize_html_class( $settings['spacing'] );
	}

	if ( ! empty( $settings['extra_classes'] ) ) {
		$extra = array_map( 'sanitize_html_class', explode( ' ', $settings['extra_classes'] ) );
		$classes = array_merge( $classes, $extra );
	}

	return implode( ' ', array_filter( $classes ) );
}

/**
 * Get section background style attribute.
 *
 * @param  array $settings Section settings with optional background_image.
 * @return string
 */
function elsner_scaffold_section_style( $settings = array() ) {
	$styles = array();

	if ( ! empty( $settings['background_image'] ) ) {
		$url = elsner_scaffold_get_image_url( $settings['background_image'], 'elsner-hero' );
		if ( $url ) {
			$styles[] = 'background-image: url(' . esc_url( $url ) . ')';
		}
	}

	if ( ! empty( $settings['background_color'] ) ) {
		$styles[] = 'background-color: ' . sanitize_hex_color( $settings['background_color'] );
	}

	return $styles ? ' style="' . esc_attr( implode( '; ', $styles ) ) . '"' : '';
}

/**
 * Truncate text to a specified word count.
 *
 * @param  string $text       Source text.
 * @param  int    $word_limit Word limit.
 * @param  string $more       Appended string when truncated.
 * @return string
 */
function elsner_scaffold_truncate( $text, $word_limit = 20, $more = '&hellip;' ) {
	$words = explode( ' ', wp_strip_all_tags( $text ) );

	if ( count( $words ) <= $word_limit ) {
		return $text;
	}

	return implode( ' ', array_slice( $words, 0, $word_limit ) ) . $more;
}

/**
 * Get a post's reading time estimate.
 *
 * @param  int|null $post_id Post ID.
 * @return int Minutes to read.
 */
function elsner_scaffold_reading_time( $post_id = null ) {
	$post_id  = $post_id ? $post_id : get_the_ID();
	$content  = get_post_field( 'post_content', $post_id );
	$words    = str_word_count( wp_strip_all_tags( $content ) );
	$minutes  = (int) ceil( $words / 200 );

	return max( 1, $minutes );
}

/**
 * Check whether ACF is active.
 *
 * @return bool
 */
function elsner_scaffold_has_acf() {
	return function_exists( 'get_field' );
}

/**
 * Kses-safe wrapper for outputting allowed HTML.
 *
 * @param  string $content HTML content.
 * @param  string $context 'post', 'inline', or 'block'.
 */
function elsner_scaffold_kses( $content, $context = 'post' ) {
	if ( 'inline' === $context ) {
		$allowed = array(
			'a'      => array( 'href' => true, 'title' => true, 'target' => true, 'rel' => true ),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
			'span'   => array( 'class' => true ),
		);
	} elseif ( 'block' === $context ) {
		$allowed = array(
			'p'          => array( 'class' => true ),
			'ul'         => array( 'class' => true ),
			'ol'         => array( 'class' => true ),
			'li'         => array( 'class' => true ),
			'a'          => array( 'href' => true, 'title' => true, 'target' => true, 'rel' => true, 'class' => true ),
			'br'         => array(),
			'em'         => array(),
			'strong'     => array(),
			'span'       => array( 'class' => true ),
			'h2'         => array( 'class' => true ),
			'h3'         => array( 'class' => true ),
			'h4'         => array( 'class' => true ),
			'blockquote' => array( 'class' => true ),
		);
	} else {
		$allowed = wp_kses_allowed_html( 'post' );
	}

	echo wp_kses( $content, $allowed );
}
