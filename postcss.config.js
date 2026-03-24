/**
 * PostCSS Configuration
 *
 * Plugin stack (in order):
 *   1. postcss-import       — inline @import rules at build time
 *   2. postcss-nested       — CSS nesting (draft spec) → flat selectors
 *   3. postcss-preset-env   — future CSS syntax + polyfills
 *   4. autoprefixer         — vendor prefixes from browserslist
 *   5. cssnano              — minification (production only)
 *
 * @package ElsnerScaffold
 */

'use strict';

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
	plugins: [
		// 1. Inline @import — must be first
		require( 'postcss-import' )( {
			path: [ 'assets/src/css' ],
		} ),

		// 2. CSS nesting
		require( 'postcss-nested' ),

		// 3. Future CSS features
		require( 'postcss-preset-env' )( {
			stage: 2,
			features: {
				'custom-properties': false, // Keep native CSS variables at runtime
				'nesting-rules': false,     // Handled by postcss-nested above
			},
		} ),

		// 4. Autoprefixer
		require( 'autoprefixer' ),

		// 5. Minify in production
		...( isProduction
			? [
				require( 'cssnano' )( {
					preset: [
						'default',
						{
							discardComments:     { removeAll: true },
							normalizeWhitespace: true,
							colormin:            true,
							reduceIdents:        false,
						},
					],
				} ),
			]
			: [] ),
	],
};
