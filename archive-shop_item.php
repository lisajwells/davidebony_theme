<?php
/**
 * The template for displaying shop items
 *
 * @package Portfolio Press
 */

get_header(); ?>


	<div id="primary">
		<div id="content" role="main">



		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content-shop', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php portfoliopress_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>