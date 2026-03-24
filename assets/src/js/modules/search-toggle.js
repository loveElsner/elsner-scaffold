/**
 * Header search panel toggle.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init search toggle behaviour.
 */
export function initSearchToggle() {
	const toggleBtn = document.querySelector( '.js-search-toggle' );
	const closeBtn  = document.querySelector( '.js-search-close' );
	const panel     = document.querySelector( '.js-header-search' );

	if ( ! toggleBtn || ! panel ) return;

	const searchInput = panel.querySelector( 'input[type="search"]' );

	function openSearch() {
		panel.classList.add( 'is-open' );
		panel.removeAttribute( 'aria-hidden' );
		toggleBtn.setAttribute( 'aria-expanded', 'true' );
		searchInput?.focus();
	}

	function closeSearch() {
		panel.classList.remove( 'is-open' );
		panel.setAttribute( 'aria-hidden', 'true' );
		toggleBtn.setAttribute( 'aria-expanded', 'false' );
	}

	toggleBtn.addEventListener( 'click', () => {
		const isOpen = panel.classList.contains( 'is-open' );
		isOpen ? closeSearch() : openSearch();
	} );

	closeBtn?.addEventListener( 'click', closeSearch );

	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' && panel.classList.contains( 'is-open' ) ) {
			closeSearch();
			toggleBtn.focus();
		}
	} );

	// Close on outside click
	document.addEventListener( 'click', ( e ) => {
		if ( ! toggleBtn.contains( e.target ) && ! panel.contains( e.target ) ) {
			closeSearch();
		}
	} );
}
