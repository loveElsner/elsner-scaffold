/**
 * Header search panel toggle.
 *
 * The search panel (#header-search-panel / .js-header-search) is a direct
 * child of <header#masthead>, placed OUTSIDE .container. This guarantees
 * it can span the full header width via position: absolute + left/right: 0.
 *
 * Accessibility:
 *  - Toggle button carries aria-expanded + aria-controls → panel id.
 *  - Panel carries role="search" + aria-hidden (toggled here).
 *  - Escape key closes the panel and returns focus to the toggle button.
 *  - Click outside closes the panel.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Initialise the header search toggle behaviour.
 *
 * @return {void}
 */
export function initSearchToggle() {
	/** @type {HTMLButtonElement|null} */
	const toggleBtn = document.querySelector( '.js-search-toggle' );

	/** @type {HTMLElement|null} */
	const panel = document.querySelector( '.js-header-search' );

	// Bail early — elements may not exist on every page (e.g. custom templates).
	if ( ! toggleBtn || ! panel ) return;

	/** @type {HTMLButtonElement|null} */
	const closeBtn = panel.querySelector( '.js-search-close' );

	/** @type {HTMLInputElement|null} */
	const searchInput = panel.querySelector( 'input[type="search"]' );

	// -------------------------------------------------------------------------
	// Helpers
	// -------------------------------------------------------------------------

	/**
	 * Open the search panel and focus the input field.
	 *
	 * Dispatches a custom event so other UI modules (e.g. mobile menu) can
	 * close themselves before the search panel takes the stage.
	 *
	 * @return {void}
	 */
	function openSearch() {
		// Signal other components (mobile menu, etc.) to close first.
		document.dispatchEvent( new CustomEvent( 'elsner:searchopen' ) );

		panel.classList.add( 'is-open' );
		panel.removeAttribute( 'aria-hidden' );
		toggleBtn.setAttribute( 'aria-expanded', 'true' );

		// Small delay lets the CSS transition start before focus triggers
		// any scroll-into-view behaviour.
		requestAnimationFrame( () => searchInput?.focus() );
	}

	/**
	 * Close the search panel.
	 *
	 * @param {boolean} [returnFocus=false] — Whether to move focus back to the toggle.
	 * @return {void}
	 */
	function closeSearch( returnFocus = false ) {
		panel.classList.remove( 'is-open' );
		panel.setAttribute( 'aria-hidden', 'true' );
		toggleBtn.setAttribute( 'aria-expanded', 'false' );

		if ( returnFocus ) {
			toggleBtn.focus();
		}
	}

	// Close search if the mobile menu opens.
	document.addEventListener( 'elsner:mobilemenuopen', () => closeSearch( false ) );

	/**
	 * Returns true when the search panel is currently open.
	 *
	 * @return {boolean}
	 */
	function isOpen() {
		return panel.classList.contains( 'is-open' );
	}

	// -------------------------------------------------------------------------
	// Event listeners
	// -------------------------------------------------------------------------

	// Toggle button — opens / closes on each click.
	toggleBtn.addEventListener( 'click', () => {
		isOpen() ? closeSearch( true ) : openSearch();
	} );

	// Explicit close button inside the panel.
	closeBtn?.addEventListener( 'click', () => closeSearch( true ) );

	// Escape key — close & return focus so keyboard navigation is preserved.
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' && isOpen() ) {
			closeSearch( true );
		}
	} );

	// Click outside — close without returning focus (user chose another target).
	document.addEventListener( 'click', ( e ) => {
		if ( isOpen() && ! toggleBtn.contains( e.target ) && ! panel.contains( e.target ) ) {
			closeSearch( false );
		}
	} );
}
