<?php
/**
 * Template part: header action buttons (search, CTA, etc.).
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */
?>
<div class="header-actions">
	<button class="header-actions__search-toggle js-search-toggle" aria-label="<?php esc_attr_e( 'Search', 'elsner-scaffold' ); ?>" aria-expanded="false">
		<svg class="icon icon--search" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
			<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
			<path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
	</button>

	<?php
	// Optional: ACF-driven header CTA button (from Theme Settings options page).
	if ( elsner_scaffold_has_acf() ) :
		$header_cta = get_field( 'header_cta_button', 'option' );
		if ( $header_cta ) :
			elsner_scaffold_render_button( $header_cta, 'btn btn--primary btn--sm' );
		endif;
	endif;
	?>
</div>

<div class="header-search js-header-search" role="search" aria-hidden="true">
	<?php get_search_form(); ?>
	<button class="header-search__close js-search-close" aria-label="<?php esc_attr_e( 'Close search', 'elsner-scaffold' ); ?>">
		<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
			<path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
	</button>
</div>
