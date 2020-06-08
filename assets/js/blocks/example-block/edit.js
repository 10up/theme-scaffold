/* eslint-disable react/prop-types */

const { __ } = wp.i18n;
const { RichText } = wp.blockEditor;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;

/**
 * Edit Function
 *
 * @return {void}
 */
const ExampleBlock = ({ attributes, setAttributes }) => {
	const { name, label } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody>
					<TextControl
						label={__('ARIA Label')}
						onChange={(value) => setAttributes({ label: value })}
						placeholder={__('Enter an accessible label.')}
						value={label}
					/>
				</PanelBody>
			</InspectorControls>

			<div className="example-block">
				<RichText
					aria-label={label}
					placeholder={__('Add Text')}
					value={name}
					onChange={(value) => setAttributes({ name: value })}
					tagName="a"
				/>
			</div>
		</>
	);
};

export default ExampleBlock;
