<?php
/**
 * Film & Music post content template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php if ( 'page' != $post->post_type ) : ?>
		<div class="entry-meta">
			<?php //echo get_the_date(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php // check if the post has a Post Thumbnail (featured image) assigned to it.
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('large');
			}
		?>

		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'portfolio-press' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfolio-press' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php //portfoliopress_footer_meta2( $post ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
