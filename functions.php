<?php
/**
 * Elsner Scaffold functions and definitions.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Theme constants.
 */
define( 'ELSNER_SCAFFOLD_VERSION', '1.0.0' );
define( 'ELSNER_SCAFFOLD_DIR', get_template_directory() );
define( 'ELSNER_SCAFFOLD_URI', get_template_directory_uri() );
define( 'ELSNER_SCAFFOLD_INC', ELSNER_SCAFFOLD_DIR . '/inc/' );
define( 'ELSNER_SCAFFOLD_ASSETS', ELSNER_SCAFFOLD_URI . '/assets/dist' );

/**
 * Load required files.
 */
$elsner_scaffold_includes = array(
	'inc/setup.php',
	'inc/enqueue.php',
	'inc/template-tags.php',
	'inc/template-functions.php',
	'inc/customizer.php',
	'inc/helpers.php',
	'inc/walker-nav.php',
	'inc/acf/acf-setup.php',
	'inc/acf/flexible-content.php',
	'inc/blocks/block-registration.php',
);

foreach ( $elsner_scaffold_includes as $file ) {
	$filepath = ELSNER_SCAFFOLD_DIR . '/' . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}
