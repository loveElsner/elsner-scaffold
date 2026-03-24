/**
 * Webpack Configuration
 *
 * Bundles JavaScript source files from assets/src/js → assets/dist/js
 *
 * @package ElsnerScaffold
 */

'use strict';

const path    = require( 'path' );
const webpack = require( 'webpack' );

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
	mode: isProduction ? 'production' : 'development',

	entry: {
		main:       './assets/src/js/main.js',
		customizer: './assets/src/js/customizer.js',
	},

	output: {
		path:          path.resolve( __dirname, 'assets/dist/js' ),
		filename:      '[name].js',
		clean:         true,
	},

	devtool: isProduction ? false : 'source-map',

	module: {
		rules: [
			{
				test:    /\.js$/,
				exclude: /node_modules/,
				use:     {
					loader:  'babel-loader',
					options: {
						presets: [
							[
								'@babel/preset-env',
								{
									targets:    '> 0.5%, last 2 major versions, not dead',
									useBuiltIns: 'usage',
									corejs:     3,
								},
							],
						],
					},
				},
			},
		],
	},

	optimization: {
		minimize: isProduction,
	},

	plugins: [
		new webpack.DefinePlugin( {
			'process.env.NODE_ENV': JSON.stringify( process.env.NODE_ENV || 'development' ),
		} ),
	],

	resolve: {
		extensions: [ '.js' ],
	},
};
