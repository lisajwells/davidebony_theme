<?php
/**
 * Template for displaying a single post
 *
 * @package Portfolio Press
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php echo get_the_date(); ?>
							<?php //portfoliopress_postby_meta(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php portfoliopress_display_image(); ?>
						<?php //conditional show only if publication is there.
							if ( get_field('publication') ) {?>

								<div class="publication">
									<h4>Published in <?php the_field('publication'); ?></h4>
									<!-- <p><a href="<?php the_field('url_of_link') ?>" target="_blank">Visit publication website</a></p> -->
								</div>
						<?php }?>
						
						<?php the_content(); ?>



						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfolio-press' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<?php //portfoliopress_footer_meta( $post ); ?>

				</article><!-- #post-<?php the_ID(); ?> -->
					<?php //portfoliopress_post_nav(); ?>

				<div class="prev-next-post">
	 				<span class="prev-post"><?php previous_post_link(); ?></span>
					<span class="next-post"><?php next_post_link(); ?></span>
				</div>

				<div class="publication-website">
					<?php //conditional show only if publication is there.
						if ( get_field('publication') ) {?>

							<div class="publication">
								<p><a href="<?php the_field('url_of_link') ?>" target="_blank">visit publication website</a></p>
							</div>
					<?php }?>
				</div>				

				<?php if ( comments_open() ) {
					comments_template( '', true );
                } ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
