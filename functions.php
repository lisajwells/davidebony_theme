<?php
/**
 * Displays footer text
 *
 * @param object post
 * @return void
 */



if ( ! function_exists( 'portfoliopress_footer_meta2' ) ):
function portfoliopress_footer_meta2( $post ) {

	$post_type = $post->post_type;
	if ( !in_array( $post_type, array( 'post', 'portfolio' ) ) )
		return;
	?>

	<footer class="entry-meta">

	<?php if ( 'portfolio' == $post_type ) {

		$format = 'image';
		$cat_list = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
		$tag_list = get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' );
		$format_link = get_post_type_archive_link( $post_type );

	} else {

		$format = get_post_format( $post );
		if ( false === $format ) {
			$format = 'standard';
		}
		$format_link = get_post_format_link( $format);
		$cat_list = get_the_term_list( $post->ID, 'category', '', ', ', '' );
		$tag_list = get_the_term_list( $post->ID, 'post_tag', '', ', ', '' );
	} ?>



	<?php if ( $cat_list ) : ?>
	<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in: ', 'portfolio-press' ); ?></span><?php echo $cat_list; ?></span>
	<?php endif; ?>

	<?php if ( $cat_list && $tag_list ) : ?>
		<span class="meta-sep"> | </span>
	<?php endif; ?>

	<?php if ( $tag_list ) : ?>
	<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links"><?php _e( 'Tagged: ', 'portfolio-press' ); ?></span><?php echo $tag_list; ?></span>
	<?php endif; ?>


	</footer><!-- .entry-meta -->

<?php }
endif;



//Enqueue scripts and styles.
function davidebony_scripts() {
	wp_enqueue_style('portfolio-press', get_template_directory_uri() .'/style.css');

	//wp_enqueue_style( 'davidebony-style', get_stylesheet_uri() );

	wp_enqueue_style( 'davidebony-google-fonts', 'https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i' );
}
add_action( 'wp_enqueue_scripts', 'davidebony_scripts' );

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');
