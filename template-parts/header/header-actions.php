<?php
/**
 * Template part: header action buttons (search toggle, CTA, etc.).
 *
 * NOTE: The actual search panel (.header-search) lives in header.php as a
 * direct child of <header#masthead>, OUTSIDE .container, so that it can
 * span the full header width without any containing-block interference.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>
<div class="header-actions">

	<button
		class="header-actions__search-toggle js-search-toggle"
		aria-label="<?php esc_attr_e( 'Open search', 'elsner-scaffold' ); ?>"
		aria-expanded="false"
		aria-controls="header-search-panel"
	>
		<svg class="icon icon--search" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
			<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
			<path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
	</button>

	<?php
	// Optional: ACF-driven header CTA button (from Theme Settings options page).
	if ( elsner_scaffold_has_acf() ) :
		$header_cta = get_field( 'header_cta_button', 'option' );
		if ( ! empty( $header_cta ) ) :
			elsner_scaffold_render_button( $header_cta, 'btn btn--primary btn--sm' );
		endif;
	endif;
	?>

</div>
