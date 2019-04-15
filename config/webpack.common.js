/* global process, module, require */

const path = require( 'path' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );
const merge = require( 'webpack-merge' );

const isProduction = 'production' === process.env.NODE_ENV;

// Config files.
const settings = require( './webpack.settings.js' );

/**
 * Configure CSS entries.
 */
const configureEntriesCss = () => {
	const entries = {};

	for ( const [ key, value ] of Object.entries( settings.entries.css ) ) {
		entries[ key ] = path.resolve( process.cwd(), value );
	}

	return entries;
};

/**
 * Configure JS entries.
 */
const configureEntriesJs = () => {
	const entries = {};

	for ( const [ key, value ] of Object.entries( settings.entries.js ) ) {
		entries[ key ] = path.resolve( process.cwd(), value );
	}

	return entries;
};

const rules = {
	lintjs: {
		test: /\.js$/,
		enforce: 'pre',
		loader: 'eslint-loader',
		options: {
			fix: true
		}
	},
	scripts: {
		test: /\.js$/,
		exclude: /node_modules/,
		use: [
			{
				loader: 'babel-loader',
				options: {
					presets: [ '@babel/preset-env' ],
					cacheDirectory: true,
					sourceMap: ! isProduction,
				},
			},
		],
	},
	styles: {
		test: /\.css$/,
		include: path.resolve( process.cwd(), settings.paths.src.css ),
		use: [
			{
				loader: MiniCssExtractPlugin.loader,
			},
			{
				loader: 'css-loader',
				options: {
					sourceMap: ! isProduction,
					// We copy fonts etc. using CopyWebpackPlugin.
					url: false,
				},
			},
			{
				loader: 'postcss-loader',
				options: {
					sourceMap: ! isProduction,
				},
			},
		],
	},
};

const defaults = {
	output: {
		path: path.resolve( process.cwd(), settings.paths.dist.base ),
		filename: settings.filename.js,
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: settings.stats,

	// External objects.
	externals: {
		jquery: 'jQuery',
	},

	// Performance settings.
	performance: {
		maxAssetSize: settings.performance.maxAssetSize,
	},

	// Build rules to handle asset files.
	module: {
		rules: [
			// Lint JS.
			rules.lintjs,

			// Scripts.
			rules.scripts
		],
	},

	plugins: [

		// Remove the extra JS files Webpack creates for CSS entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin( {
			silent: true,
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: settings.filename.css,
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `dist` folder.
		new CopyWebpackPlugin( [
			{
				from: settings.copyWebpackConfig.from,
				to: settings.copyWebpackConfig.to,
				context: path.resolve( process.cwd(), settings.paths.src.base ),
			},
		] ),

		// Lint CSS.
		new StyleLintPlugin( {
			context: path.resolve( process.cwd(), settings.paths.src.css ),
			files: '**/*.css',
		} ),

		// Fancy WebpackBar.
		new WebpackBar(),
	],
};

const es5 = merge.smart( defaults, {
	name: 'es5',
	entry: Object.assign( {},
		configureEntriesJs()
	),
	output: {
		filename: settings.filename.es5,
	},
	module: {
		rules: [
			// Scripts.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [ [
								'@babel/preset-env', {
									targets: {
										esmodules: false
									}
								}
							] ],
						},
					},
				],
			},
		]
	}
} );

const es6 = merge.smart( defaults, {
	name: 'es6',
	entry: Object.assign( {},
		configureEntriesJs(),
		configureEntriesCss()
	),
	module: {
		rules: [
			// Scripts.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [ [
								'@babel/preset-env', {
									targets: {
										edge: '16',
										firefox: '60',
										chrome: '61',
										safari: '11',
										opera: '48',
										ios: '11'
									}
								}
							] ],
						},
					},
				],
			},

			// Styles
			rules.styles,
		]
	},
	plugins: [
		// Clean the `dist` folder on build.
		new CleanWebpackPlugin(),
	]
} );

module.exports = [
	es5,
	es6
];
