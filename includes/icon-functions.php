<?php
/**
 * SVG icons related functions
 *
 * @package TenUpScaffold
 */

/**
 * An SVG template helper with robust array of options.
 *
 * Example:
 * tenupscaffold_svg_icon(
 *     array(
 *         'desc'   => 'Follow 10up on Instagram',
 *         'fill'   => '#f4428f',
 *         'height' => 24,
 *         'icon'   => 'instagram',
 *         'output' => true,
 *         'role'   => 'img',
 *         'title'  => 'Follow 10up on Instagram',
 *         'width'  => 24,
 *     ),
 * );
 *
 * @link   https://10up.github.io/Engineering-Best-Practices/markup/#svg-embedded-in-html
 * @param  array $args   The SVG options such as Aria role, dimensions, title.
 * @return html
 */
function tenupscaffold_svg_icon( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'tenupscaffold' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon name.', 'tenupscaffold' );
	}

	// Set defaults.
	$defaults = array(
		'desc'   => '',
		'fill'   => '',
		'height' => '',
		'icon'   => '',
		'output' => false,
		'role'   => 'presentation',
		'title'  => '',
		'width'  => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$block_title = ( $args['title'] ) ? $args['title'] : $args['icon'];

	// Generate random IDs for the title and description.
	$random_number  = wp_rand( 0, 99999 );
	$block_title_id = 'title-' . sanitize_title( $block_title ) . '-' . $random_number;
	$desc_id        = 'desc-' . sanitize_title( $block_title ) . '-' . $random_number;

	// Set ARIA.
	$aria_hidden     = 'true';
	$aria_labelledby = '';
	$aria_role       = ( $args['role'] ) ? $args['role'] : false;

	// If we have a title and description then let's assign appropriate Aria.
	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby=' . $block_title_id . ' ' . $desc_id;
		$aria_hidden     = '';
	}

	// Set SVG parameters.
	$fill   = ( $args['fill'] ) ? $args['fill'] : false;
	$height = ( $args['height'] ) ? $args['height'] : false;
	$width  = ( $args['width'] ) ? $args['width'] : false;

	$allowed_tags = tenupscaffold_get_post_with_svg_allowed_tags();

	// Start a buffer...
	ob_start();
	?>

	<svg class="icon icon-<?php echo esc_attr( $args['icon'] ); ?>"
	<?php
	if ( $fill ) {
		echo ' fill="' . esc_attr( $fill ) . '" ';
	}
	if ( $height ) {
		echo ' height="' . esc_attr( $height ) . '" ';
	}
	if ( $width ) {
		echo ' width="' . esc_attr( $width ) . '" ';
	}
	if ( $aria_hidden ) {
		echo ' aria-hidden="' . esc_attr( $aria_hidden ) . '" ';
	}
	if ( $aria_labelledby ) {
		echo esc_attr( $aria_labelledby );
	}
	if ( $aria_role ) {
		echo ' aria-role="' . esc_attr( $aria_role ) . '" ';
	}
	?>
	>
		<title id="<?php echo esc_attr( $block_title_id ); ?>">
			<?php echo esc_html( $block_title ); ?>
		</title>

		<?php
		// Display description if available.
		if ( $args['desc'] ) :
			?>
				<desc id="<?php echo esc_attr( $desc_id ); ?>">
					<?php echo esc_html( $args['desc'] ); ?>
				</desc>
		<?php endif; ?>

		<?php
		// Use absolute path in the Customizer so that icons show up in there.
		if ( is_customize_preview() ) :
			?>
				<use xlink:href="<?php echo esc_url( get_parent_theme_file_uri( '/dist/svg/svg-sprite.svg#icon-' . esc_html( $args['icon'] ) ) ); ?>"></use>
			<?php else : ?>
				<use xlink:href="#icon-<?php echo esc_html( $args['icon'] ); ?>"></use>
		<?php endif; ?>

	</svg>

	<?php
	// Get the buffer.
	$svg = ob_get_clean();

	// Echo result.
	if ( $args['output'] ) {
		echo wp_kses( $svg, $allowed_tags );
	}

	return $svg;
}

/**
 * Returns the list of allowed tags in order to perform
 * security checks while still allowing SVG elements.
 *
 * @return array
 */
function tenupscaffold_get_post_with_svg_allowed_tags() {
	$allowed_tags        = wp_kses_allowed_html( 'post' );
	// SVG attributes we would like to allow.
	$allowed_tags['svg'] = array(
		'aria-hidden'     => true,
		'aria-label'      => true,
		'aria-labelledby' => true,
		'fill'            => true,
		'class'           => true,
		'height'          => true,
		'id'              => true,
		'role'            => true,
		'xmlns'           => true,
		'xmlns:xlink'     => true,
		'width'           => true,
	);
	// <use> attributes we would like to allow.
	$allowed_tags['use'] = array(
		'xlink:href' => true,
	);
	// <desc> we would like to allow.
	$allowed_tags['desc'] = true;

	return $allowed_tags;
}
