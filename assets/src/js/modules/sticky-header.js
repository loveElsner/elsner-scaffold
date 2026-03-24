/**
 * Sticky header — adds scrolled class for shadow/backdrop effects.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init sticky header behaviour.
 */
export function initStickyHeader() {
	const header = document.getElementById( 'masthead' );
	if ( ! header ) return;

	const scrollThreshold = 10;

	const handleScroll = () => {
		header.classList.toggle( 'is-scrolled', window.scrollY > scrollThreshold );
	};

	// Passive listener for performance
	window.addEventListener( 'scroll', handleScroll, { passive: true } );

	// Run once on load in case page is already scrolled
	handleScroll();
}
