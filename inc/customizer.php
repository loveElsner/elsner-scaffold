<?php
/**
 * Theme Customizer.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elsner_scaffold_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => function () {
					bloginfo( 'name' );
				},
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => function () {
					bloginfo( 'description' );
				},
			)
		);
	}

	// -------------------------------------------------------------------------
	// Theme Options Panel
	// -------------------------------------------------------------------------
	$wp_customize->add_panel(
		'elsner_scaffold_options',
		array(
			'title'    => esc_html__( 'Theme Options', 'elsner-scaffold' ),
			'priority' => 130,
		)
	);

	// -------------------------------------------------------------------------
	// Header Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'elsner_scaffold_header',
		array(
			'title'    => esc_html__( 'Header', 'elsner-scaffold' ),
			'panel'    => 'elsner_scaffold_options',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'elsner_scaffold_sticky_header',
		array(
			'default'           => true,
			'sanitize_callback' => 'elsner_scaffold_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'elsner_scaffold_sticky_header',
		array(
			'label'   => esc_html__( 'Sticky Header', 'elsner-scaffold' ),
			'section' => 'elsner_scaffold_header',
			'type'    => 'checkbox',
		)
	);

	// -------------------------------------------------------------------------
	// Footer Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'elsner_scaffold_footer',
		array(
			'title'    => esc_html__( 'Footer', 'elsner-scaffold' ),
			'panel'    => 'elsner_scaffold_options',
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'elsner_scaffold_footer_copyright',
		array(
			'default'           => sprintf(
				/* translators: %s: year and site name */
				esc_html__( '&copy; %s. All rights reserved.', 'elsner-scaffold' ),
				gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' )
			),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'elsner_scaffold_footer_copyright',
		array(
			'label'   => esc_html__( 'Copyright Text', 'elsner-scaffold' ),
			'section' => 'elsner_scaffold_footer',
			'type'    => 'textarea',
		)
	);

	// -------------------------------------------------------------------------
	// Colours Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'elsner_scaffold_colors',
		array(
			'title'    => esc_html__( 'Brand Colours', 'elsner-scaffold' ),
			'panel'    => 'elsner_scaffold_options',
			'priority' => 30,
		)
	);

	$color_settings = array(
		'primary'   => array( '#0071e3', esc_html__( 'Primary Colour', 'elsner-scaffold' ) ),
		'secondary' => array( '#1d1d1f', esc_html__( 'Secondary Colour', 'elsner-scaffold' ) ),
		'accent'    => array( '#ff6b35', esc_html__( 'Accent Colour', 'elsner-scaffold' ) ),
	);

	foreach ( $color_settings as $key => $data ) {
		$wp_customize->add_setting(
			'elsner_scaffold_color_' . $key,
			array(
				'default'           => $data[0],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'elsner_scaffold_color_' . $key,
				array(
					'label'   => $data[1],
					'section' => 'elsner_scaffold_colors',
				)
			)
		);
	}
}
add_action( 'customize_register', 'elsner_scaffold_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elsner_scaffold_customize_preview_js() {
	wp_enqueue_script(
		'elsner-scaffold-customizer',
		ELSNER_SCAFFOLD_ASSETS . '/js/customizer.js',
		array( 'customize-preview' ),
		ELSNER_SCAFFOLD_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'elsner_scaffold_customize_preview_js' );

/**
 * Output dynamic CSS from Customizer settings.
 */
function elsner_scaffold_customizer_css() {
	$primary   = get_theme_mod( 'elsner_scaffold_color_primary', '#0071e3' );
	$secondary = get_theme_mod( 'elsner_scaffold_color_secondary', '#1d1d1f' );
	$accent    = get_theme_mod( 'elsner_scaffold_color_accent', '#ff6b35' );
	?>
	<style id="elsner-scaffold-customizer-css">
		:root {
			--color-primary: <?php echo esc_attr( $primary ); ?>;
			--color-secondary: <?php echo esc_attr( $secondary ); ?>;
			--color-accent: <?php echo esc_attr( $accent ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'elsner_scaffold_customizer_css' );

// -------------------------------------------------------------------------
// Sanitize callbacks
// -------------------------------------------------------------------------

/**
 * Sanitize checkbox value.
 *
 * @param  bool $value Input value.
 * @return bool
 */
function elsner_scaffold_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Sanitize select value against allowed choices.
 *
 * @param  string               $value   Input value.
 * @param  \WP_Customize_Setting $setting Customizer setting object.
 * @return string
 */
function elsner_scaffold_sanitize_select( $value, $setting ) {
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $value, $choices ) ) ? $value : $setting->default;
}
