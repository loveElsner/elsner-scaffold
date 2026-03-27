<?php
/**
 * Theme setup.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'elsner_scaffold_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function elsner_scaffold_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'elsner-scaffold', ELSNER_SCAFFOLD_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Custom image sizes.
		add_image_size( 'elsner-hero', 1920, 800, true );
		add_image_size( 'elsner-card', 600, 400, true );
		add_image_size( 'elsner-thumbnail', 400, 300, true );
		add_image_size( 'elsner-wide', 1200, 630, true );

		// Register nav menus.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary Navigation', 'elsner-scaffold' ),
				'secondary' => esc_html__( 'Secondary Navigation', 'elsner-scaffold' ),
				'footer'    => esc_html__( 'Footer Navigation', 'elsner-scaffold' ),
				'mobile'    => esc_html__( 'Mobile Navigation', 'elsner-scaffold' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'elsner_scaffold_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 200,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Wide & full alignment support for Gutenberg.
		add_theme_support( 'align-wide' );

		// Responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Editor styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/dist/css/editor.css' );

		// Block editor colour palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Primary', 'elsner-scaffold' ),
					'slug'  => 'primary',
					'color' => '#0071e3',
				),
				array(
					'name'  => esc_html__( 'Secondary', 'elsner-scaffold' ),
					'slug'  => 'secondary',
					'color' => '#1d1d1f',
				),
				array(
					'name'  => esc_html__( 'Accent', 'elsner-scaffold' ),
					'slug'  => 'accent',
					'color' => '#ff6b35',
				),
				array(
					'name'  => esc_html__( 'Light', 'elsner-scaffold' ),
					'slug'  => 'light',
					'color' => '#f5f5f7',
				),
				array(
					'name'  => esc_html__( 'White', 'elsner-scaffold' ),
					'slug'  => 'white',
					'color' => '#ffffff',
				),
			)
		);

		// Block editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__( 'Small', 'elsner-scaffold' ),
					'size' => 14,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'elsner-scaffold' ),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Large', 'elsner-scaffold' ),
					'size' => 20,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'elsner-scaffold' ),
					'size' => 30,
					'slug' => 'huge',
				),
			)
		);

		// Disable custom colors in Gutenberg.
		// add_theme_support( 'disable-custom-colors' );

		// Post formats.
		add_theme_support(
			'post-formats',
			array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio' )
		);
	}
}
add_action( 'after_setup_theme', 'elsner_scaffold_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elsner_scaffold_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elsner_scaffold_content_width', 1200 );
}
add_action( 'after_setup_theme', 'elsner_scaffold_content_width', 0 );

/**
 * Register widget areas.
 */
function elsner_scaffold_widgets_init() {
	$sidebars = array(
		array(
			'name'          => esc_html__( 'Sidebar', 'elsner-scaffold' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'elsner-scaffold' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
		array(
			'name'          => esc_html__( 'Footer — Column 1', 'elsner-scaffold' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'First footer column.', 'elsner-scaffold' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
		array(
			'name'          => esc_html__( 'Footer — Column 2', 'elsner-scaffold' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Second footer column.', 'elsner-scaffold' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
		array(
			'name'          => esc_html__( 'Footer — Column 3', 'elsner-scaffold' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Third footer column.', 'elsner-scaffold' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
		array(
			'name'          => esc_html__( 'Footer — Column 4', 'elsner-scaffold' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Fourth footer column.', 'elsner-scaffold' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		),
	);

	foreach ( $sidebars as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
add_action( 'widgets_init', 'elsner_scaffold_widgets_init' );

/**
 * Remove the search form from the WordPress admin bar on the front-end.
 *
 * Logged-in users would otherwise see two search UIs: the admin bar's
 * built-in search and the theme's own header search panel.  Keeping only
 * the theme search gives a consistent experience for every visitor.
 */
function elsner_scaffold_clean_admin_bar() {
	if ( is_admin() ) {
		return;
	}

	global $wp_admin_bar;

	// Remove the magnifying-glass search node from the front-end toolbar.
	$wp_admin_bar->remove_node( 'search' );
}
add_action( 'wp_before_admin_bar_render', 'elsner_scaffold_clean_admin_bar', 20 );
