<?php get_header();

// https://www.webhostinghero.com/how-to-get-the-most-recent-permalink-in-wordpress/
function get_latest_guest_link(){
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

$latest_guest = get_latest_guest_link();
?>

    <div class="border-top"></div>
    <div class="border-left"></div>

    <div class="quads-container">
		<a href="/art-and-writing"><div class="top-left"><p>ART &amp; WRITING</p></div></a>
		<a href="/film-and-music"><div class="top-right"><p>FILM &amp; MUSIC</p></div></a>
		<a href="<?php echo $latest_guest; ?>"><div class="bot-left"><p>GUEST ARTIST</p></div></a>
		<a href="/shop"><div class="bot-right"><p>STOP &amp; SHOP</p></div></a>
    </div>

    <div class="border-right"></div>
    <div class="border-bot"></div>

</body>
</html>
