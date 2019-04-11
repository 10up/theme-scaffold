<?php
/**
 * The template for displaying search results pages.
 *
 * @package TenUpScaffold
 */

get_header(); ?>

	<section itemscope itemtype="https://schema.org/SearchResultsPage">
		<?php if ( have_posts() ) : ?>
			<h1>
				<?php printf( esc_html__( 'Search Results for: %s', 'tenup' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
			</h1>

			<ul>
			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<li>
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
				</li>

			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</section>

<?php
get_footer();
