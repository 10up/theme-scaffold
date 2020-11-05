/**
 * Example-block
 * Custom title block -- feel free to delete
 */

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';
import json from './block.json';

const { name } = json;

/**
 * Register block
 */
export default registerBlockType(name, {
	title: __('Example Block'),
	description: __('An Example Block'),
	edit,
	save,
});
