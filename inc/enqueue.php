<?php
/**
 * Scripts and styles enqueue.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
function elsner_scaffold_scripts() {

	// Main stylesheet (compiled from PostCSS).
	wp_enqueue_style(
		'elsner-scaffold-style',
		ELSNER_SCAFFOLD_ASSETS . '/css/main.css',
		array(),
		ELSNER_SCAFFOLD_VERSION
	);

	// Print stylesheet.
	wp_enqueue_style(
		'elsner-scaffold-print',
		ELSNER_SCAFFOLD_ASSETS . '/css/print.css',
		array( 'elsner-scaffold-style' ),
		ELSNER_SCAFFOLD_VERSION,
		'print'
	);

	// Main JS bundle.
	wp_enqueue_script(
		'elsner-scaffold-main',
		ELSNER_SCAFFOLD_ASSETS . '/js/main.js',
		array(),
		ELSNER_SCAFFOLD_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);

	// Inline JS config — pass PHP data to JS.
	wp_localize_script(
		'elsner-scaffold-main',
		'ElsnerScaffold',
		array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'elsner_scaffold_nonce' ),
			'siteUrl'   => get_site_url(),
			'themeUrl'  => ELSNER_SCAFFOLD_URI,
			'isLoggedIn' => is_user_logged_in(),
			'i18n'      => array(
				'menuToggle'   => esc_html__( 'Toggle Menu', 'elsner-scaffold' ),
				'menuClose'    => esc_html__( 'Close Menu', 'elsner-scaffold' ),
				'searchToggle' => esc_html__( 'Toggle Search', 'elsner-scaffold' ),
				'readMore'     => esc_html__( 'Read More', 'elsner-scaffold' ),
			),
		)
	);

	// Comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elsner_scaffold_scripts' );

/**
 * Enqueue admin scripts and styles.
 *
 * @param string $hook_suffix Current admin page hook suffix.
 */
function elsner_scaffold_admin_scripts( $hook_suffix ) {
	wp_enqueue_style(
		'elsner-scaffold-admin',
		ELSNER_SCAFFOLD_ASSETS . '/css/admin.css',
		array(),
		ELSNER_SCAFFOLD_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'elsner_scaffold_admin_scripts' );

/**
 * Preload key assets for performance.
 */
function elsner_scaffold_preload_assets() {
	echo '<link rel="preload" href="' . esc_url( ELSNER_SCAFFOLD_ASSETS . '/css/main.css' ) . '" as="style">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'elsner_scaffold_preload_assets', 1 );

/**
 * Remove unnecessary WordPress head items.
 */
function elsner_scaffold_clean_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'elsner_scaffold_clean_head' );
