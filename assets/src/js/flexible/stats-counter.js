/**
 * Stats counter — animated number count-up on scroll-into-view.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init animated stat counters.
 */
export function initStatsCounter() {
	const stats = document.querySelectorAll( '.js-stat-counter' );
	if ( ! stats.length ) return;

	if ( ! ( 'IntersectionObserver' in window ) ) return;

	// Respect reduced motion
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) return;

	const observer = new IntersectionObserver(
		( entries, obs ) => {
			entries.forEach( ( entry ) => {
				if ( ! entry.isIntersecting ) return;

				const el     = entry.target;
				const target = parseFloat( el.dataset.value ) || 0;
				const number = el.querySelector( '.js-counter-number' );

				if ( number ) {
					animateCounter( number, 0, target, 2000 );
				}

				obs.unobserve( el );
			} );
		},
		{ threshold: 0.5 }
	);

	stats.forEach( ( el ) => observer.observe( el ) );
}

/**
 * Animate a number element from start to end over a given duration.
 *
 * @param {HTMLElement} el       Target element.
 * @param {number}      start    Starting value.
 * @param {number}      end      Ending value.
 * @param {number}      duration Animation duration in ms.
 */
function animateCounter( el, start, end, duration ) {
	const isFloat   = ! Number.isInteger( end );
	const decimals  = isFloat ? String( end ).split( '.' )[1]?.length || 0 : 0;
	const startTime = performance.now();

	const easeOutQuart = ( t ) => 1 - Math.pow( 1 - t, 4 );

	function step( currentTime ) {
		const elapsed  = currentTime - startTime;
		const progress = Math.min( elapsed / duration, 1 );
		const value    = start + ( end - start ) * easeOutQuart( progress );

		el.textContent = isFloat ? value.toFixed( decimals ) : Math.floor( value ).toLocaleString();

		if ( progress < 1 ) {
			requestAnimationFrame( step );
		} else {
			el.textContent = isFloat ? end.toFixed( decimals ) : end.toLocaleString();
		}
	}

	requestAnimationFrame( step );
}
