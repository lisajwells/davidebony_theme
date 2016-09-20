<?php
/**
 * Shop post content template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix poop'); ?>>

	<div class="shop-image">
		<?php // check if the post has a Post Thumbnail (featured image) assigned to it.
		if ( has_post_thumbnail() ) {
			the_post_thumbnail('large');
		} ?>
	</div>

	<div class="shop-info">
		<h4>Title: <?php the_title(); ?></h4>
		<h4><?php the_field('creator_type'); ?>: <?php the_field('creator_name'); ?></h4>
		<p><?php the_field('item_info'); ?></p>
		<p><?php the_field('price'); ?></p>
		<p><?php the_field('materials'); ?></p>

		<!--   Conditional Statement -->
		<?php
			$paypal = get_field('paypal_code');

			if( get_field('sold_out') )	{
			    echo "<p>SOLD OUT</p>";

			} else {

			// mailto link here until buy button below is ready
			    echo "<p><a href='mailto:w.sokhi@gmail.com'>Email To Buy</a></p>";

			// commented for now; will replace mailto when ready
			//    echo "<p><a href='#'>BUY</a></p>";
			//    echo $paypal;
			}
		?>
	</div> <!-- /shop-info -->

	<div class="shop-description"
		<?php the_field('description'); ?>
	</div> <!-- /shop-description -->

		<?php /* wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfolio-press' ), 'after' => '</div>' ) );  */?>

</article><!-- #post-<?php the_ID(); ?> -->

