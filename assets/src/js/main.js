/**
 * Elsner Scaffold — Main JS Entry Point
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

import { initNavigation } from './modules/navigation';
import { initMobileMenu } from './modules/mobile-menu';
import { initStickyHeader } from './modules/sticky-header';
import { initSearchToggle } from './modules/search-toggle';
import { initFaqAccordion } from './flexible/faq-accordion';
import { initStatsCounter } from './flexible/stats-counter';
import { initAnimations } from './modules/animations';
import { initVideoPosters } from './flexible/video-poster';

/**
 * Bootstrap when DOM is ready.
 */
document.addEventListener( 'DOMContentLoaded', () => {
	initNavigation();
	initMobileMenu();
	initStickyHeader();
	initSearchToggle();
	initFaqAccordion();
	initStatsCounter();
	initAnimations();
	initVideoPosters();
} );
