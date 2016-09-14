<?php get_header();


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
