<?php
/**
 *
 * @param object post
 * @return void
 */


// * Displays footer text */
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

// --------------
// Include custom fields in search results ala https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

// home page links to dynamic latest guest artist post
// https://www.webhostinghero.com/how-to-get-the-most-recent-permalink-in-wordpress/
function davidebony_get_latest_guest_link(){
    global $post;
    $placeholder = $post;
    $args = array(
        'post_type' => 'guest_artist',
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_status'     => 'publish' );
    $sorted_posts = get_posts( $args );
    $permalink = get_permalink($sorted_posts[0]->ID);
    $title = $sorted_posts[0]->post_title;
    $post = $placeholder;
    // $latest_link_html = 'Latest Link: <a href="'.$permalink.'">'.$title.'</a>';
    return $permalink;
    // return $latest_link_html;
}

/*
 * Customize Menu Item Classes
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-which-menu-item-is-marked-active/
 *
 * @param array $classes, current menu classes
 * @param object $item, current menu item
 * @param object $args, menu arguments
 * @return array $classes
 */
function davidebony_menu_item_classes( $classes, $item, $args ) {

    if( 'primary' !== $args->theme_location )
        return $classes;

    if( ( get_post_type() == 'post' ) && 'Art Writing' == $item->attr_title )
        $classes[] = 'current-menu-item';

    if( ( get_post_type() == 'film_music' ) && 'Film Music' == $item->attr_title )
        $classes[] = 'current-menu-item';

    return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'davidebony_menu_item_classes', 10, 3 );

// exclude envira gallery post type from search results
/**
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 */
add_action( 'init', 'davidebony_update_my_custom_type', 99 );
function davidebony_update_my_custom_type() {
    global $wp_post_types;

    if ( post_type_exists( 'envira' ) ) {

        // exclude from search results
        $wp_post_types['envira']->exclude_from_search = true;
    }
}
