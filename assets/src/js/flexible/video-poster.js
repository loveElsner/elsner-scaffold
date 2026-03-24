/**
 * Video poster — swap poster image for embedded video on play click.
 *
 * @package ElsnerScaffold
 * @since   1.0.0
 */

/**
 * Init video poster click-to-embed.
 */
export function initVideoPosters() {
	const posters = document.querySelectorAll( '.js-video-poster' );
	if ( ! posters.length ) return;

	posters.forEach( ( poster ) => {
		const btn      = poster.querySelector( '.js-video-play' );
		const videoUrl = poster.dataset.video;

		if ( ! btn || ! videoUrl ) return;

		btn.addEventListener( 'click', () => {
			const embedUrl = buildEmbedUrl( videoUrl );
			if ( ! embedUrl ) return;

			const iframe = document.createElement( 'iframe' );
			iframe.src              = embedUrl;
			iframe.allow            = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
			iframe.allowFullscreen  = true;
			iframe.loading          = 'lazy';
			iframe.style.cssText    = 'position:absolute;inset:0;width:100%;height:100%;border:0;';

			// Wrap in responsive container
			const wrapper = document.createElement( 'div' );
			wrapper.className = 'embed-responsive es-video-section__embed';
			wrapper.appendChild( iframe );

			poster.replaceWith( wrapper );
		} );
	} );
}

/**
 * Build an autoplay embed URL from a YouTube or Vimeo URL.
 *
 * @param  {string} url Source URL.
 * @return {string|null}
 */
function buildEmbedUrl( url ) {
	// YouTube
	const ytMatch = url.match( /(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/ );
	if ( ytMatch ) {
		return `https://www.youtube.com/embed/${ ytMatch[1] }?autoplay=1&rel=0`;
	}

	// Vimeo
	const vimeoMatch = url.match( /vimeo\.com\/(?:video\/)?(\d+)/ );
	if ( vimeoMatch ) {
		return `https://player.vimeo.com/video/${ vimeoMatch[1] }?autoplay=1`;
	}

	return null;
}
