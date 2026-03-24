/**
 * Babel Configuration
 *
 * @package ElsnerScaffold
 */

'use strict';

module.exports = {
	presets: [
		[
			'@babel/preset-env',
			{
				targets:     '> 0.5%, last 2 major versions, not dead',
				useBuiltIns: 'usage',
				corejs:      3,
			},
		],
	],
};
