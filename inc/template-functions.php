<?php
/**
 * Functions that modify WordPress template behaviour.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add custom classes to the array of body classes.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function elsner_scaffold_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add has-flexible-content when using ACF flexible content.
	if ( is_singular() && elsner_scaffold_has_acf() && have_rows( 'flexible_content' ) ) {
		$classes[] = 'has-flexible-content';
	}

	return $classes;
}
add_filter( 'body_class', 'elsner_scaffold_body_classes' );

/**
 * Add a pingback URL auto-discovery header for single posts, pages, or attachments.
 */
function elsner_scaffold_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'elsner_scaffold_pingback_header' );

/**
 * Add custom post excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function elsner_scaffold_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 25;
}
add_filter( 'excerpt_length', 'elsner_scaffold_excerpt_length', 999 );

/**
 * Modify excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string
 */
function elsner_scaffold_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
}
add_filter( 'excerpt_more', 'elsner_scaffold_excerpt_more' );

/**
 * Wrap oEmbed output in a responsive container.
 *
 * @param  string $html oEmbed HTML.
 * @param  string $url  The URL.
 * @param  array  $attr oEmbed attributes.
 * @return string
 */
function elsner_scaffold_embed_wrap( $html, $url, $attr ) {
	return '<div class="embed-responsive">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'elsner_scaffold_embed_wrap', 10, 3 );

/**
 * Add SVG support to allowed mime types.
 *
 * @param  array $mimes Allowed mime types.
 * @return array
 */
function elsner_scaffold_allow_svg( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'elsner_scaffold_allow_svg' );

/**
 * Fix SVG display in media library.
 *
 * @param array $response   Attachment data response.
 * @param object $attachment Attachment WP_Post object.
 * @return array
 */
function elsner_scaffold_fix_svg_thumb( $response, $attachment ) {
	if ( 'image/svg+xml' === $response['mime'] && empty( $response['sizes'] ) ) {
		$response['sizes'] = array(
			'full' => array(
				'url'         => $response['url'],
				'width'       => 600,
				'height'      => 600,
				'orientation' => 'landscape',
			),
		);
	}
	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'elsner_scaffold_fix_svg_thumb', 10, 2 );

/**
 * Add aria-label to nav elements that lack one.
 *
 * @param string $nav_menu Nav menu HTML.
 * @param object $args     Nav menu arguments.
 * @return string
 */
function elsner_scaffold_nav_aria_label( $nav_menu, $args ) {
	if ( empty( $args->container_aria_label ) ) {
		$label    = $args->theme_location ? ucwords( str_replace( '-', ' ', $args->theme_location ) ) . ' ' : '';
		$label   .= __( 'Navigation', 'elsner-scaffold' );
		$nav_menu = str_replace( '<nav ', '<nav aria-label="' . esc_attr( $label ) . '" ', $nav_menu );
	}
	return $nav_menu;
}
add_filter( 'wp_nav_menu', 'elsner_scaffold_nav_aria_label', 10, 2 );

/**
 * Move the Yoast SEO metabox to the bottom.
 */
function elsner_scaffold_move_yoast_below() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'elsner_scaffold_move_yoast_below' );
