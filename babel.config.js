/**
 * Babel Config, .babelrc equivalent.
 *
 * @package
 * @type {{presets: [[]|string|Object]}}
 */
module.exports = {
	presets: [
		[
			'@10up/babel-preset-default',
			{
				wordpress: true,
			},
		],
	],
};
