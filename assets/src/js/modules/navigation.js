/**
 * Desktop navigation — dropdown accessibility & keyboard nav.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init navigation behaviour.
 */
export function initNavigation() {
	const nav = document.querySelector( '.main-navigation' );
	if ( ! nav ) return;

	const parentItems = nav.querySelectorAll( '.nav__item--has-children' );

	parentItems.forEach( ( item ) => {
		const link    = item.querySelector( ':scope > .nav__link' );
		const dropdown = item.querySelector( ':scope > .nav__dropdown' );

		if ( ! link || ! dropdown ) return;

		// ---------------------------------------------------------------
		// Keyboard: open on Enter / Space when focused
		// ---------------------------------------------------------------
		link.addEventListener( 'keydown', ( e ) => {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				const isExpanded = link.getAttribute( 'aria-expanded' ) === 'true';
				closeAllDropdowns( nav );
				if ( ! isExpanded ) {
					openDropdown( item, link );
				}
			}
			if ( e.key === 'Escape' ) {
				closeDropdown( item, link );
				link.focus();
			}
		} );

		// Arrow keys inside dropdown
		dropdown.addEventListener( 'keydown', ( e ) => {
			const links = Array.from( dropdown.querySelectorAll( '.nav__link' ) );
			const idx   = links.indexOf( document.activeElement );

			if ( e.key === 'ArrowDown' ) {
				e.preventDefault();
				links[ ( idx + 1 ) % links.length ]?.focus();
			}
			if ( e.key === 'ArrowUp' ) {
				e.preventDefault();
				links[ ( idx - 1 + links.length ) % links.length ]?.focus();
			}
			if ( e.key === 'Escape' ) {
				closeDropdown( item, link );
				link.focus();
			}
		} );
	} );

	// Close dropdowns when clicking outside
	document.addEventListener( 'click', ( e ) => {
		if ( ! nav.contains( e.target ) ) {
			closeAllDropdowns( nav );
		}
	} );
}

/**
 * Open a single dropdown.
 *
 * @param {HTMLElement} item Parent <li>.
 * @param {HTMLElement} link Trigger <a>.
 */
function openDropdown( item, link ) {
	item.classList.add( 'is-open' );
	link.setAttribute( 'aria-expanded', 'true' );
}

/**
 * Close a single dropdown.
 *
 * @param {HTMLElement} item Parent <li>.
 * @param {HTMLElement} link Trigger <a>.
 */
function closeDropdown( item, link ) {
	item.classList.remove( 'is-open' );
	link.setAttribute( 'aria-expanded', 'false' );
}

/**
 * Close all open dropdowns within a nav element.
 *
 * @param {HTMLElement} nav Navigation container.
 */
function closeAllDropdowns( nav ) {
	nav.querySelectorAll( '.nav__item--has-children.is-open' ).forEach( ( item ) => {
		const link = item.querySelector( ':scope > .nav__link' );
		closeDropdown( item, link );
	} );
}
