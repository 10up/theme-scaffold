const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

const blockStyle = {
	backgroundColor: '#900',
	color: '#fff',
	padding: '20px',
};

registerBlockType( 'tenup-theme-scaffold/static-block', {
	title: __( 'Static Block', '10up-theme-scaffold' ),
	icon: 'universal-access-alt',
	category: 'layout',

	/**
	 *  Edit markup
	 */
	edit() {
		return <div style={ blockStyle }>Basic example with JSX! (editor)</div>;
	},

	/**
	 *  Save markup
	 */
	save() {
		return <div style={ blockStyle }>Basic example with JSX! (front)</div>;
	},
} );
