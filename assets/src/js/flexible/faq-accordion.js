/**
 * FAQ accordion — accessible keyboard-navigable expand/collapse.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init FAQ accordion behaviour.
 */
export function initFaqAccordion() {
	const faqLists = document.querySelectorAll( '.es-faq__list' );
	if ( ! faqLists.length ) return;

	faqLists.forEach( ( list ) => {
		const items = list.querySelectorAll( '.js-faq-item' );

		items.forEach( ( item ) => {
			const btn    = item.querySelector( '.es-faq__question' );
			const answer = item.querySelector( '.es-faq__answer' );

			if ( ! btn || ! answer ) return;

			btn.addEventListener( 'click', () => {
				const isExpanded = btn.getAttribute( 'aria-expanded' ) === 'true';

				// Close other open items in the same list
				items.forEach( ( other ) => {
					if ( other !== item ) {
						const otherBtn    = other.querySelector( '.es-faq__question' );
						const otherAnswer = other.querySelector( '.es-faq__answer' );
						otherBtn?.setAttribute( 'aria-expanded', 'false' );
						otherAnswer?.setAttribute( 'hidden', '' );
						other.classList.remove( 'is-open' );
					}
				} );

				// Toggle current item
				btn.setAttribute( 'aria-expanded', String( ! isExpanded ) );
				if ( isExpanded ) {
					answer.setAttribute( 'hidden', '' );
					item.classList.remove( 'is-open' );
				} else {
					answer.removeAttribute( 'hidden' );
					item.classList.add( 'is-open' );
				}
			} );
		} );
	} );
}
