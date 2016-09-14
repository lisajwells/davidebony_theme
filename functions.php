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

// Mark (highlight) custom post type parent (archive) as active item in Wordpress Navigation
  add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

    function add_current_nav_class($classes, $item) {

        // Getting the current post details
        global $post;

        // Get post ID, if nothing found set to NULL
        $id = ( isset( $post->ID ) ? get_the_ID() : NULL );

        // Checking if post ID exist...
        if (isset( $id )){
            // Getting the post type of the current post
            $current_post_type = get_post_type_object(get_post_type($post->ID));
            $current_post_type_slug = $current_post_type->rewrite['slug'];

            // Getting the URL of the menu item
            $menu_slug = strtolower(trim($item->url));

            // If the menu item URL contains the current post types slug add the current-menu-item class
            if (strpos($menu_slug,$current_post_type_slug) !== false) {

               $classes[] = 'current-menu-item';

            }
        }
        // Return the corrected set of classes to be added to the menu item
        return $classes;
    }
