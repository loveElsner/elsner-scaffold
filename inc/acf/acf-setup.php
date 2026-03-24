<?php
/**
 * ACF setup and configuration.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Configure ACF options page.
 */
function elsner_scaffold_acf_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => esc_html__( 'Theme Settings', 'elsner-scaffold' ),
			'menu_title' => esc_html__( 'Theme Settings', 'elsner-scaffold' ),
			'menu_slug'  => 'theme-settings',
			'capability' => 'manage_options',
			'icon_url'   => 'dashicons-admin-generic',
			'position'   => 59,
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => esc_html__( 'Header Settings', 'elsner-scaffold' ),
			'menu_title'  => esc_html__( 'Header', 'elsner-scaffold' ),
			'parent_slug' => 'theme-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => esc_html__( 'Footer Settings', 'elsner-scaffold' ),
			'menu_title'  => esc_html__( 'Footer', 'elsner-scaffold' ),
			'parent_slug' => 'theme-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => esc_html__( 'Social Media', 'elsner-scaffold' ),
			'menu_title'  => esc_html__( 'Social Media', 'elsner-scaffold' ),
			'parent_slug' => 'theme-settings',
		)
	);
}
add_action( 'acf/init', 'elsner_scaffold_acf_options_page' );

/**
 * Load ACF JSON save point.
 *
 * @param string $path Current save path.
 * @return string
 */
function elsner_scaffold_acf_json_save_point( $path ) {
	return ELSNER_SCAFFOLD_DIR . '/inc/acf/json';
}
add_filter( 'acf/settings/save_json', 'elsner_scaffold_acf_json_save_point' );

/**
 * Load ACF JSON load point.
 *
 * @param array $paths Existing load paths.
 * @return array
 */
function elsner_scaffold_acf_json_load_point( $paths ) {
	$paths[] = ELSNER_SCAFFOLD_DIR . '/inc/acf/json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'elsner_scaffold_acf_json_load_point' );

/**
 * Disable ACF admin menu in production (optional).
 */
function elsner_scaffold_acf_settings( $show ) {
	// Uncomment below to hide ACF menu on production.
	// return defined( 'WP_DEBUG' ) && WP_DEBUG;
	return $show;
}
add_filter( 'acf/settings/show_admin', 'elsner_scaffold_acf_settings' );

/**
 * Register ACF block category.
 *
 * @param  array $categories Existing block categories.
 * @return array
 */
function elsner_scaffold_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'elsner-scaffold',
				'title' => esc_html__( 'Elsner Scaffold', 'elsner-scaffold' ),
				'icon'  => 'admin-site-alt3',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'elsner_scaffold_block_categories' );
