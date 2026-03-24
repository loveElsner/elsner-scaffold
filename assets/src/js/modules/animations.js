/**
 * Intersection Observer — reveal animations on scroll.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init scroll-triggered animations.
 */
export function initAnimations() {
	if ( ! ( 'IntersectionObserver' in window ) ) return;

	// Respect reduced motion preference
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) return;

	const targets = document.querySelectorAll( '.js-animate, .js-animate-fade' );
	if ( ! targets.length ) return;

	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-visible' );
					observer.unobserve( entry.target );
				}
			} );
		},
		{
			threshold: 0.1,
			rootMargin: '0px 0px -40px 0px',
		}
	);

	targets.forEach( ( el ) => observer.observe( el ) );
}
