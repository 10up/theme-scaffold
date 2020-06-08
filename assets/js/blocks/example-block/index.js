/**
 * Example Block Content
 */
import attributes from './attributes';
import edit from './edit';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

/**
 * Register the block
 */
registerBlockType('example-block', {
	title: __('Example Block'),
	description: __('Example block helper text.'),
	category: 'common',
	attributes,
	edit,
	save: () => {
		return null;
	},
});
