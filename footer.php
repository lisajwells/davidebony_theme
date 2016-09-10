<?php
/**
 * Footer template
 *
 * @package Portfolio Press
 */
?>
	</div>
	</div><!-- #main -->

</div><!-- #page -->

<footer id="colophon">
	<div class="col-width">

    <?php if ( is_active_sidebar('footer-1') ||
		is_active_sidebar('footer-2') ||
		is_active_sidebar('footer-3') ||
		is_active_sidebar('footer-4') ) : ?>

		<div id="footer-widgets">

			<?php $i = 0; while ( $i <= 4 ) : $i++; ?>
				<?php if ( is_active_sidebar('footer-'.$i) ) { ?>

			<div class="block footer-widget-<?php echo $i; ?>">
	        	<?php dynamic_sidebar('footer-'.$i); ?>
			</div>

		        <?php } ?>
			<?php endwhile; ?>

			<div class="clear"></div>

		</div><!-- #footer-widgets  -->

    <?php endif; ?>
    
    <p>&copy; <?php echo date('Y') ?> David Ebony. All rights reserved.</p>
    


	</div>

</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>