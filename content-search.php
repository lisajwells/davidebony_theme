<?php
/**
 * General post content template (art&writing)
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ($post->post_type == "shop_item") { ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>">Title: <?php the_title(); ?></a></h1>
		<?php } else { ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php } ?>
		<?php if ( 'page' != $post->post_type ) : ?>
			<div class="entry-meta">
				<?php echo get_the_date(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php // check if the post has a Post Thumbnail (featured image) assigned to it.
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('large');
			}
		?>

		<?php //conditional show only if publication is there.
		if ( get_field('publication') ) {?>
			<div class="publication">
				<h4>Published in <?php the_field('publication'); ?></h4>
				<!--<p><a href="<?php the_field('url_of_link'); ?>" target="_blank">View article <?php the_field('url_of_link'); ?></a></p>-->
			</div>
		<?php }?>
		<!-- Shop search results -->
		<?php //conditional show only if creator_type and creator_name is there.
		if ( get_field('creator_type') && get_field('creator_name') ) {?>
			<div class="creator_type">
				<p><?php the_field('creator_type'); ?>: <?php the_field('creator_name'); ?></p>
			</div>
		<?php }?>
		<?php //conditional show only if item_info is there.
		if ( get_field('item_info') ) {?>
			<div class="item_info">
				<p><?php the_field('item_info'); ?></p>
			</div>
		<?php }?>
		<?php //conditional show only if description is there.
		if ( get_field('description') ) {?>
			<div class="description">
				<p><?php the_field('description'); ?></p>
			</div>
		<?php }?>
		<?php //conditional show only if materials is there.
		if ( get_field('materials') ) {?>
			<div class="materials">
				<p><?php the_field('materials'); ?></p>
			</div>
		<?php }?>
		<?php
			if( get_field('sold_out') )	{
			    echo "<p>SOLD OUT</p>";
		}?>


		<!-- the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'portfolio-press' ) );  -->
		<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'portfolio-press' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfolio-press' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php portfoliopress_footer_meta2( $post ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
