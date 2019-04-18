<?php
/**
 * Custom template tags for this theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with TenUpScaffold in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 * Example: `tenup_function()`
 *
 * @package TenUpScaffold\Template_Tags
 */

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists( $dir . $path ) ) {
		$css_vars = file_get_contents( $dir . $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		preg_match_all( ' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;

}

/**
 * Content for the test page.
 */
function unit_test_content() {

	$content = '';

	// Just some descriptive helper text.
	$content .= '
		<div style="color: orange; padding: 1em;">
			<p>This is for prototyping and testing <em>only</em>.</p>
			<p>If you need to modify or update this then please do so in <pre><code>templates/template-unit-test.php</code></pre></p>
			<p>This page and its contents are created programmatically. Therefore, in order to update it you must edit the template, and then completely delete (e.g. "Trash" and "Empty Trash") the page.</p>
		</div>
	';

	// Here we begin our blocks unit test.
	$content .= '
		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Donec id elit non mi porta gravida at eget metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla.', 'block-unit-test' ) . '</p>
		<!-- /wp:paragraph -->
		<!-- wp:more -->
		<!--more-->
		<!-- /wp:more -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":1} -->
		<h1>' . esc_html__( 'Heading One', 'block-unit-test' ) . '</h1>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Heading Two', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":3} -->
		<h3>' . esc_html__( 'Heading Three', 'block-unit-test' ) . '</h3>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":4} -->
		<h4>' . esc_html__( 'Heading Four', 'block-unit-test' ) . '</h4>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":5} -->
		<h5>' . esc_html__( 'Heading Five', 'block-unit-test' ) . '</h5>
		<!-- /wp:heading -->

		<!-- wp:heading {"level":6} -->
		<h6>' . esc_html__( 'Heading Six', 'block-unit-test' ) . '</h6>
		<!-- /wp:heading -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>Preformatted Block</h2>
		<!-- /wp:heading -->

		<!-- wp:preformatted -->
		<pre class="wp-block-preformatted"><strong>The Road Not Taken</strong>, <em>by Robert Frost</em><br/><br/>Two roads diverged in a yellow wood,<br/>And sorry I could not travel both<br/>And be one traveler, long I stood <br/>And looked down one as far as I could<br/>To where it bent in the undergrowth;<br/>Then took the other, as just as fair,<br/>And having perhaps the better claim,<br/>Because it was grassy and wanted wear;<br/>Though as for that the passing there<br/>Had worn them really about the same,<br/>And both that morning equally lay<br/>In leaves no step had trodden black.<br/>Oh, I kept the first for another day!<br/>Yet knowing how way leads on to way,<br/>I doubted if I should ever come back.<br/>I shall be telling this with a sigh<br/>Somewhere ages and ages hence:<br/>Two roads diverged in a wood, and I—<br/>I took the one less traveled by,<br/>And that has made all the difference.<br/><br/>...and heres a line of some really, really, really, really long text, just to see how it is handled and to find out how it overflows;</pre>
		<!-- /wp:preformatted -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>Ordered List</h2>
		<!-- /wp:heading -->

		<!-- wp:list {"ordered":true} -->
		<ol>
			<li>Nullam id dolor id nibh ultricies vehicula ut id elit.</li>
			<li>Donec ullamcorper nulla non metus auctor fringilla.
				<ol>
					<li>Condimentum euismod aenean.</li>
					<li>Purus commodo ridiculus.</li>
					<li>Nibh commodo vestibulum.</li>
				</ol>
			</li>
			<li>Cras justo odio, dapibus ac facilisis in.</li>
		</ol>
		<!-- /wp:list -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Unordered List', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:list -->
		<ul>
			<li>Nullam id dolor id nibh ultricies vehicula ut id elit.</li>
			<li>Donec ullamcorper nulla non metus auctor fringilla.
				<ul>
					<li>Nibh commodo vestibulum.</li>
					<li>Aenean eu leo quam.</li>
					<li>Pellentesque ornare sem lacinia.</li>
				</ul>
			</li>
			<li>Cras justo odio, dapibus ac facilisis in.</li>
		</ul>
		<!-- /wp:list -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Verse', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'This is an example of the core Gutenberg verse block.', 'block-unit-test' ) . '</p>
		<!-- /wp:paragraph -->

		<!-- wp:verse -->
		<pre class="wp-block-verse">A block for haiku? <br/>Why not? <br/>Blocks for all the things!</pre>
		<!-- /wp:verse -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Separator', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Here are examples of the three separator styles of the core Gutenberg separator block.', 'block-unit-test' ) . '</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator {"className":""} -->
		<hr class="wp-block-separator"/>
		<!-- /wp:separator -->

		<!-- wp:separator {"className":" is-style-wide"} -->
		<hr class="wp-block-separator  is-style-wide"/>
		<!-- /wp:separator -->

		<!-- wp:separator {"className":"is-style-dots"} -->
		<hr class="wp-block-separator is-style-dots"/>
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Table', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Here is an example of the core Gutenberg table block. </p>
		<!-- /wp:paragraph -->

		<!-- wp:table -->
		<table class="wp-block-table"><tbody><tr><td>Employee</td><td>Salary</td><td>Position</td></tr><tr><td>Jane Doe<br></td><td>$100k</td><td>CEO</td></tr><tr><td>John Doe</td><td>$100k</td><td>CTO</td></tr><tr><td>Jane Bloggs</td><td>$100k</td><td>Engineering</td></tr><tr><td>Fred Bloggs</td><td>$100k</td><td>Marketing</td></tr></tbody></table>
		<!-- /wp:table -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Latest Posts, List View', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras justo odio, dapibus ac facilisis in, egestas eget quam. </p>
		<!-- /wp:paragraph -->

		<!-- wp:latest-posts /-->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Latest Posts, Grid View', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>And now for the Grid View. The Latest Posts block also displays at wide and full width alignments, so be sure to check those styles as well.</p>
		<!-- /wp:paragraph -->

		<!-- wp:latest-posts {"postLayout":"grid","columns":2} /-->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Blockquote', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna sed diam ed diam eget risus varius eget.</p>
		<!-- /wp:paragraph -->

		<!-- wp:quote {"align":"left"} -->
		<blockquote class="wp-block-quote" style="text-align:left">
			<p>Donec sed odio dui. Maecenas faucibus mollis interdum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio.</p><cite>Eva Jones</cite></blockquote>
		<!-- /wp:quote -->

		<!-- wp:paragraph -->
		<p>Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna sed diam ed diam eget risus varius eget.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading -->
		<h2>' . esc_html__( 'Alternate Blockquote', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>The alternate block quote style can be tarageted using the <strong>.wp-block-quote.is-large</strong>. CSS selector. Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		<!-- /wp:paragraph -->

		<!-- wp:quote {"align":"left","style":2} -->
		<blockquote class="wp-block-quote is-large" style="text-align:left">
			<p>Donec sed odio dui. Maecenas faucibus mollis interdum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p><cite>Eva Jones</cite></blockquote>
		<!-- /wp:quote -->

		<!-- wp:paragraph -->
		<p>Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas sed diam eget risus varius blandit sit amet non magna sed diam ed diam eget risus varius eget.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Audio', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Donec sed odio dui. Aenean lacinia bibendum nulla sed consectetur. Nullam id dolor id nibh ultricies vehicula ut id elit. <strong>Center aligned</strong>:</p>
		<!-- /wp:paragraph -->

		<!-- wp:audio {"align":"center"} -->
		<figure class="wp-block-audio aligncenter"><audio controls src="https://example.com"></audio>
			<figcaption>An example of an Audio Block caption</figcaption>
		</figure>
		<!-- /wp:audio -->

		<!-- wp:paragraph -->
		<p>Curabitur blandit tempus porttitor. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Curabitur blandit tempus porttitor.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Buttons', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Donec sed odio dui. Aenean lacinia bibendum nulla sed consectetur. Nullam id dolor id nibh ultricies vehicula ut id elit. <strong>Center aligned</strong>: </p>
		<!-- /wp:paragraph -->

		<!-- wp:button {"align":"center"} -->
		<div class="wp-block-button aligncenter"><a class="wp-block-button__link" href="https://10up.com">Center Aligned Button</a></div>
		<!-- /wp:button -->

		<!-- wp:paragraph -->
		<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. </p>
		<!-- /wp:paragraph -->

		<!-- wp:button {"align":"left"} -->
		<div class="wp-block-button alignleft"><a class="wp-block-button__link" href="https://10up.com">Left Aligned Button</a></div>
		<!-- /wp:button -->

		<!-- wp:paragraph -->
		<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius.</p>
		<!-- /wp:paragraph -->

		<!-- wp:button {"align":"right"} -->
		<div class="wp-block-button alignright"><a class="wp-block-button__link">Right Aligned Button</a></div>
		<!-- /wp:button -->

		<!-- wp:paragraph -->
		<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Categories', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:categories {"showPostCounts":true,"showHierarchy":true,"align":"center"} /-->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Archives', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:archives {"showPostCounts":true} /-->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Columns', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:columns -->
		<div class="wp-block-columns has-2-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->

		<!-- wp:separator -->
		<hr class="wp-block-separator"/>
		<!-- /wp:separator -->

		<!-- wp:columns {"columns":3} -->
		<div class="wp-block-columns has-3-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->

		<!-- wp:separator -->
		<hr class="wp-block-separator"/>
		<!-- /wp:separator -->

		<!-- wp:columns {"columns":4} -->
		<div class="wp-block-columns has-4-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condim entum nibh.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condim entum nibh.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condim entum nibh.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condim entum nibh.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Pull Quotes', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Here is an example of the core pull quote block, set to display centered. Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		<!-- /wp:paragraph -->

		<!-- wp:pullquote {"align":"center"} -->
		<blockquote class="wp-block-pullquote aligncenter">
			<p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere est at lobortis.</p><cite>Eva Jones, 10up.com</cite></blockquote>
		<!-- /wp:pullquote -->

		<!-- wp:heading {"level":3} -->
		<h3>' . esc_html__( 'Wide aligned', 'block-unit-test' ) . '</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Here is an example of the core pull quote block, set to display with the wide-aligned attribute, if the theme allows it. Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		<!-- /wp:paragraph -->
	';

	if ( get_theme_support( 'align-wide' ) ) {
		$content .= '
			<!-- wp:pullquote {"align":"wide"} -->
			<blockquote class="wp-block-pullquote alignwide">
				<p>Nulla vitae elit libero, a pharetra augue. Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed ibendum nulla sed consectetur. </p><cite>Eva Jones, Founder at 10up.com</cite></blockquote>
			<!-- /wp:pullquote -->

			<!-- wp:heading {"level":3} -->
			<h3>' . esc_html__( 'Full width', 'block-unit-test' ) . '</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>And finally, here is an example of the core pull quote block, set to display with the full-aligned attribute, if the theme allows it. Nulla vitae elit libero, a pharetra augue. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
			<!-- /wp:paragraph -->

			<!-- wp:pullquote {"align":"full"} -->
			<blockquote class="wp-block-pullquote alignfull">
				<p>Etiam porta sem malesuada magna mollis euismod. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p><cite>Eva Jones, Founder at 10up.com</cite></blockquote>
			<!-- /wp:pullquote -->

			<!-- wp:paragraph -->
			<p>Etiam porta sem malesuada magna mollis euismod. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec sed odio dui. Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
			<!-- /wp:paragraph -->
		';
	}

	$content .= '
		<!-- wp:pullquote {"align":"left"} -->
		<blockquote class="wp-block-pullquote alignleft">
			<p>Here we have a left-aligned pullquote.</p><cite>Eva Jones</cite></blockquote>
		<!-- /wp:pullquote -->

		<!-- wp:paragraph -->
		<p>Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod semper.</p>
		<!-- /wp:paragraph -->

		<!-- wp:pullquote {"align":"right"} -->
		<blockquote class="wp-block-pullquote alignright">
			<p>Here we have a right-aligned pullquote.</p><cite>Eva Jones</cite></blockquote>
		<!-- /wp:pullquote -->

		<!-- wp:paragraph -->
		<p>Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>Image Block</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas faucibus mollis interdum.</p>
		<!-- /wp:paragraph -->

		<!-- wp:image {"id":2117,"align":"center"} -->
			<figure class="wp-block-image aligncenter"><img src="https://via.placeholder.com/960x540.png" alt="" class="wp-image-2117" /></figure>
		<!-- /wp:image -->

		<!-- wp:image {"id":2117,"align":"center"} -->
			<figure class="wp-block-image aligncenter"><img src="https://via.placeholder.com/960x540.png" alt="" class="wp-image-2117" />
				<figcaption>And an image with a caption</figcaption>
			</figure>
		<!-- /wp:image -->
	';

	if ( get_theme_support( 'align-wide' ) ) {
		$content .= '
			<!-- wp:heading {"level":3} -->
			<h3>' . esc_html__( 'Wide aligned', 'block-unit-test' ) . '</h3>
			<!-- /wp:heading -->

			<!-- wp:image {"id":2117,"align":"wide"} -->
			<figure class="wp-block-image alignwide"><img src="https://via.placeholder.com/960x540.png" alt="" class="wp-image-2117" /></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3>' . esc_html__( 'Full Width', 'block-unit-test' ) . '</h3>
			<!-- /wp:heading -->

			<!-- wp:image {"id":2117,"align":"full"} -->
			<figure class="wp-block-image alignfull"><img src="https://via.placeholder.com/960x540.png" alt="" class="wp-image-2117" />
				<figcaption>Here is an example of an image block caption</figcaption>
			</figure>
			<!-- /wp:image -->
		';
	}

	$content .= '
		<!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
		<!-- /wp:paragraph -->

		<!-- wp:image {"id":2117,"align":"left","width":275,"height":196} -->
		<figure class="wp-block-image alignleft is-resized"><img src="https://via.placeholder.com/275x196.png" alt="" class="wp-image-2117" width="275" height="196" /></figure>
		<!-- /wp:image -->

		<!-- wp:paragraph -->
		<p><strong>Left aligned:</strong> dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. </p>
		<!-- /wp:paragraph -->

		<!-- wp:image {"id":2117,"align":"right","width":281,"height":200} -->
		<figure class="wp-block-image alignright is-resized"><img src="https://via.placeholder.com/281x200.png" alt="" class="wp-image-2117" width="281" height="200" />
			<figcaption>This one is captioned</figcaption>
		</figure>
		<!-- /wp:image -->

		<!-- wp:paragraph -->
		<p>Nullam quis risus eget urna mollis ornare vel eu leo. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Maecenas faucibus mollis interdum. Vestibulum id ligula porta felis euismod semper. Nullam quis risus.</p>
		<!-- /wp:paragraph -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->

		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Video Block', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Lets check out the positioning and styling of the video core block. We will check the wide and full alignments too.</p>
		<!-- /wp:paragraph -->
	';

	if ( get_theme_support( 'align-wide' ) ) {
		$content .= '
			<!-- wp:heading {"level":3} -->
			<h3>' . esc_html__( 'Wide aligned', 'block-unit-test' ) . '</h3>
			<!-- /wp:heading -->

			<!-- wp:core-embed/vimeo {"url":"https://vimeo.com/259230327","align":"wide","type":"video","providerNameSlug":"vimeo"} -->
			<figure class="wp-block-embed-vimeo wp-block-embed alignwide is-type-video is-provider-vimeo">
				https://vimeo.com/259230327
				<figcaption>Videos can have captions too!</figcaption>
			</figure>
			<!-- /wp:core-embed/vimeo -->

			<!-- wp:heading {"level":3} -->
			<h3>Full Width</h3>
			<!-- /wp:heading -->

			<!-- wp:core-embed/vimeo {"url":"https://vimeo.com/243191812","align":"full","type":"video","providerNameSlug":"vimeo"} -->
			<figure class="wp-block-embed-vimeo wp-block-embed alignfull is-type-video is-provider-vimeo">
				https://vimeo.com/243191812
			</figure>
			<!-- /wp:core-embed/vimeo -->
		';
	}

	$content .= '
		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Cover Image Block', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Check out the positioning and styling of the cover image core block. We will check the wide and full alignments, as well as left/right.</p>
		<!-- /wp:paragraph -->

	';

	if ( get_theme_support( 'align-wide' ) ) {
		$content .= '
			<!-- wp:heading {"level":3} -->
			<h3>' . esc_html__( 'Wide aligned', 'block-unit-test' ) . '</h3>
			<!-- /wp:heading -->

			<!-- wp:cover-image {"url":"https://via.placeholder.com/960x540.png","align":"wide","id":2117} -->
			<div class="wp-block-cover-image has-background-dim alignwide" style="background-image:url(https://via.placeholder.com/960x540.png)">
				<p class="wp-block-cover-image-text">' . esc_html__( 'Wide Cover Image Block', 'block-unit-test' ) . '</p>
			</div>
			<!-- /wp:cover-image -->

			<!-- wp:heading {"level":3} -->
			<h3>Full Width</h3>
			<!-- /wp:heading -->

			<!-- wp:cover-image {"url":"https://via.placeholder.com/960x540.png","align":"full","id":2117} -->
			<div class="wp-block-cover-image has-background-dim alignfull" style="background-image:url(https://via.placeholder.com/960x540.png)">
				<p class="wp-block-cover-image-text">' . esc_html__( 'Full Width Cover Image', 'block-unit-test' ) . '</p>
			</div>
			<!-- /wp:cover-image -->

			<!-- wp:paragraph -->
			<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
			<!-- /wp:paragraph -->
		';
	}

	$content .= '
		<!-- wp:cover-image {"url":"https://via.placeholder.com/960x540.png","align":"left","id":2117} -->
		<div class="wp-block-cover-image has-background-dim alignleft" style="background-image:url(https://via.placeholder.com/960x540.png)">
			<p class="wp-block-cover-image-text">' . esc_html__( 'Left Aligned Cover Image', 'block-unit-test' ) . '</p>
		</div>
		<!-- /wp:cover-image -->

		<!-- wp:paragraph -->
		<p><strong>Left aligned:</strong> dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
		<!-- /wp:paragraph -->

		<!-- wp:cover-image {"url":"https://via.placeholder.com/960x540.png","align":"right","id":2117} -->
		<div class="wp-block-cover-image has-background-dim alignright" style="background-image:url(https://via.placeholder.com/960x540.png)">
			<p class="wp-block-cover-image-text">' . esc_html__( 'Right Aligned Cover Image', 'block-unit-test' ) . '</p>
		</div>
		<!-- /wp:cover-image -->

		<!-- wp:paragraph -->
		<p><strong>Right aligned:</strong> scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. </p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit. Vel scelerisque nisl consectetur et. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. ﻿<strong>Center aligned:</strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:cover-image {"url":"https://via.placeholder.com/960x540.png","align":"center","id":2117} -->
		<div class="wp-block-cover-image has-background-dim aligncenter" style="background-image:url(https://via.placeholder.com/960x540.png)">
			<p class="wp-block-cover-image-text">' . esc_html__( 'Center Aligned Cover Image', 'block-unit-test' ) . '</p>
		</div>
		<!-- /wp:cover-image -->

		<!-- wp:separator -->
		<hr class="wp-block-separator" />
		<!-- /wp:separator -->
	';

	$content .= '
		<!-- wp:heading {"level":2} -->
		<h2>' . esc_html__( 'Gallery Blocks', 'block-unit-test' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Let us check out the positioning and styling of the gallery blocks.</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Two Column Gallery</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Below we have a Gallery Block inserted with two columns and two images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery -->
			<ul class="wp-block-gallery alignnone columns-2 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
				</li>
			</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Three Column</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Below we have a Gallery Block inserted with three columns and three images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery -->
		<ul class="wp-block-gallery alignnone columns-3 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Four Column</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Below we have a Gallery Block inserted with four columns and four images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery {"columns":4} -->
		<ul class="wp-block-gallery alignnone columns-4 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Five Column</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Below we have a Gallery Block inserted with five columns and five images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery {"columns":5} -->
		<ul class="wp-block-gallery alignnone columns-5 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Four Column, Five Images</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Let us switch things up a bit. Now we have a Gallery Block inserted with four columns and five images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery {"columns":4} -->
		<ul class="wp-block-gallery alignnone columns-4 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Three Column, Five Images</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Now we have a Gallery Block inserted with three columns and five images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery {"columns":3} -->
		<ul class="wp-block-gallery alignnone columns-3 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:paragraph -->
		<p>Below you will find a Gallery Block inserted with two columns and five images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Two Column, Five Images</h3>
		<!-- /wp:heading -->

		<!-- wp:gallery {"columns":2} -->
		<ul class="wp-block-gallery alignnone columns-2 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->

		<!-- wp:heading {"level":3} -->
		<h3>Three Column, Four Images</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Below you will find a Gallery Block inserted with three columns and four images.</p>
		<!-- /wp:paragraph -->

		<!-- wp:gallery {"columns":3} -->
		<ul class="wp-block-gallery alignnone columns-3 is-cropped">
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
			</li>
			<li class="blocks-gallery-item">
				<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
			</li>
		</ul>
		<!-- /wp:gallery -->
	';

	if ( get_theme_support( 'align-wide' ) ) {
		$content .= '
			<!-- wp:heading {"level":2} -->
			<h2>Wide aligned Gallery Blocks</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Let us check out the positioning and styling of the gallery blocks..</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3>Two Column Gallery</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below we have a Gallery Block inserted with two columns and two images. It is set to display with the new Wide alignment (if the theme supports it).</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide"} -->
			<ul class="wp-block-gallery alignwide columns-2 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" />
						<figcaption>Captions for Gallery Images</figcaption>
					</figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Three Column</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below we have a Gallery Block inserted with three columns and three images. It is also set to display with the new Wide alignment.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide"} -->
			<ul class="wp-block-gallery alignwide columns-3 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2121" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Four Column</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below we have a Gallery Block inserted with four columns and four images. It is also set to display with the new Wide alignment.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":4} -->
			<ul class="wp-block-gallery alignwide columns-4 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Five Column</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below we have a Gallery Block inserted with five columns and five images. It is also set to display with the new Wide alignment.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":5} -->
			<ul class="wp-block-gallery alignwide columns-5 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2121" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Four Column, Five Images</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Let us switch things up a bit. Now we have a Gallery Block inserted with four columns and five images, also displayed with the new Wide alignment option.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":4} -->
			<ul class="wp-block-gallery alignwide columns-4 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2121" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Three Column, Five Images</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Now we have a Gallery Block inserted with three columns and five images displayed with the new Wide alignment option.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":3} -->
			<ul class="wp-block-gallery alignwide columns-3 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2121" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Two Column, Five Images</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below you will find a Gallery Block inserted with two columns and five images also displayed with the new Wide alignment option.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":2} -->
			<ul class="wp-block-gallery alignwide columns-2 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2121" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Three Column, Four Images</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below you will find a Gallery Block inserted with three columns and four images, also displayed with the new Wide alignment option.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"wide","columns":3} -->
			<ul class="wp-block-gallery alignwide columns-3 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" /></figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading {"level":3} -->
			<h3>Full Width Gallery Block</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Below you will find a Gallery Block inserted with three columns and four images, also displayed with the new Wide alignment option.</p>
			<!-- /wp:paragraph -->

			<!-- wp:gallery {"align":"full","columns":3} -->
			<ul class="wp-block-gallery alignfull columns-3 is-cropped">
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2124" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2125" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2117" /></figure>
				</li>
				<li class="blocks-gallery-item">
					<figure><img src="https://via.placeholder.com/960x540.png" alt="" data-id="2119" />
						<figcaption>Captions for Gallery Images</figcaption>
					</figure>
				</li>
			</ul>
			<!-- /wp:gallery -->

			<!-- wp:heading -->
			<h2>Media &amp; Text</h2>
			<!-- /wp:heading -->

			<!-- wp:media-text -->
			<div class="wp-block-media-text alignwide"><figure class="wp-block-media-text__media"></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"Content…","fontSize":"large"} -->
			<p class="has-large-font-size">Large text</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>This is part of the InnerBlocks text for the Media &amp; Text block.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:media-text -->
		';
	}
	return apply_filters( 'block_unit_test_content', $content );
}
