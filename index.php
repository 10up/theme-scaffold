<?php
/**
 * The main template file
 *
 * @package TenUpScaffold
 */

 namespace TenUpScaffold\TemplateTags;

 use function TenUpScaffold\TemplateTags\icon;
 use function TenUpScaffold\TemplateTags\get_icon;
 use function TenUpScaffold\TemplateTags\get_svg_atts;

get_header(); ?>

	<?php

	/*
		Commenting this out
		echo icon( 'home' );
	*/

	?>
	<?php echo wp_kses( get_icon( 'home', 'home icon' ), get_svg_atts() ); ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer();
