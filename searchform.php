<?php
/**
 * Custom search form template.
 *
 * Overrides WordPress's default get_search_form() output so we have
 * full control over markup, classes, and accessibility attributes.
 * The label uses .screen-reader-text so it is announced by screen
 * readers but never painted on screen.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

$unique_id = wp_unique_id( 'search-form-' );
?>
<form
	role="search"
	method="get"
	class="search-form"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
>
	<label class="screen-reader-text" for="<?php echo esc_attr( $unique_id ); ?>">
		<?php esc_html_e( 'Search for:', 'elsner-scaffold' ); ?>
	</label>

	<input
		type="search"
		id="<?php echo esc_attr( $unique_id ); ?>"
		class="search-field"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php echo esc_attr_x( 'Search…', 'placeholder', 'elsner-scaffold' ); ?>"
		autocomplete="off"
		spellcheck="false"
		aria-label="<?php esc_attr_e( 'Search this site', 'elsner-scaffold' ); ?>"
	>

	<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Submit search', 'elsner-scaffold' ); ?>">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
			<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
			<path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'elsner-scaffold' ); ?></span>
	</button>
</form>
