/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { TextControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { editPropsShape } from './props-shape';

/**
 * Edit component.
 * See https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-edit-save/#edit
 *
 * @param {Object} props The block props
 * @return {Function} Render the edit screen
 */
const ExampleBockEdit = (props) => {
	const {
		attributes: { customTitle },
		className,
		setAttributes,
		isSelected,
	} = props;

	if (isSelected) {
		return (
			<div className={className}>
				<TextControl
					id="example-block-text-field"
					label={__('Custom Title')}
					value={customTitle}
					onChange={(title) => setAttributes({ customTitle: title })}
				/>
			</div>
		);
	}
	return <h2 className="example-block-title">{customTitle}</h2>;
};
// Set the propTypes
ExampleBockEdit.propTypes = {
	...editPropsShape,
};
export default ExampleBockEdit;
