/**
 * Babel Config, .babelrc equivalent.
 *
 * @package
 * @type {{presets: [[]|string|Object]}}
 */
module.exports = {
	presets: [
		[
			/**
			 * @see https://babeljs.io/docs/en/babel-preset-env#corejs
			 */
			'@babel/preset-env',
			{
				useBuiltIns: 'usage',
				corejs: {
					version: 3,
					proposals: true,
				},
			},
		],
		'@babel/preset-react',
		'@wordpress/default',
	],
};
