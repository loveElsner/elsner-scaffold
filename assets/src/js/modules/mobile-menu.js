/**
 * Mobile menu drawer with focus trap and ARIA management.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init mobile menu behaviour.
 */
export function initMobileMenu() {
	const menu   = document.getElementById( 'mobile-menu' );
	const toggle = document.querySelector( '.js-nav-toggle' );
	const close  = menu?.querySelector( '.js-mobile-close' );
	const overlay = menu?.querySelector( '.js-mobile-overlay' );

	if ( ! menu || ! toggle ) return;

	toggle.addEventListener( 'click', () => openMenu() );
	close?.addEventListener( 'click', () => closeMenu() );
	overlay?.addEventListener( 'click', () => closeMenu() );

	// Keyboard handling
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' && menu.classList.contains( 'is-open' ) ) {
			closeMenu();
			toggle.focus();
		}
		if ( e.key === 'Tab' && menu.classList.contains( 'is-open' ) ) {
			trapFocus( e, menu );
		}
	} );

	// Accordion for sub-menus inside mobile drawer
	const parentItems = menu.querySelectorAll( '.nav__item--has-children' );
	parentItems.forEach( ( item ) => {
		const link     = item.querySelector( ':scope > .nav__link' );
		const dropdown = item.querySelector( ':scope > .nav__dropdown' );

		if ( ! link || ! dropdown ) return;

		link.addEventListener( 'click', ( e ) => {
			if ( link.getAttribute( 'href' ) === '#' || ! link.getAttribute( 'href' ) ) {
				e.preventDefault();
			}
			const isOpen = item.classList.contains( 'is-open' );
			// Close siblings
			parentItems.forEach( ( sibling ) => {
				if ( sibling !== item ) {
					sibling.classList.remove( 'is-open' );
					sibling.querySelector( ':scope > .nav__link' )?.setAttribute( 'aria-expanded', 'false' );
				}
			} );
			item.classList.toggle( 'is-open', ! isOpen );
			link.setAttribute( 'aria-expanded', String( ! isOpen ) );
		} );
	} );

	// -----------------------------------------------------------------------
	// Helpers
	// -----------------------------------------------------------------------
	function openMenu() {
		menu.classList.add( 'is-open' );
		menu.removeAttribute( 'aria-hidden' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
		close?.focus();
	}

	function closeMenu() {
		menu.classList.remove( 'is-open' );
		menu.setAttribute( 'aria-hidden', 'true' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	/**
	 * Trap keyboard focus inside the menu panel.
	 *
	 * @param {KeyboardEvent} e    Key event.
	 * @param {HTMLElement}   trap Container to trap focus within.
	 */
	function trapFocus( e, trap ) {
		const focusable = Array.from(
			trap.querySelectorAll( 'a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])' )
		).filter( ( el ) => el.offsetParent !== null );

		if ( ! focusable.length ) return;

		const first = focusable[0];
		const last  = focusable[ focusable.length - 1 ];

		if ( e.shiftKey ) {
			if ( document.activeElement === first ) {
				e.preventDefault();
				last.focus();
			}
		} else {
			if ( document.activeElement === last ) {
				e.preventDefault();
				first.focus();
			}
		}
	}
}
