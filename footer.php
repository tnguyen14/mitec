<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package mitec
 * @since mitec 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="sponsor-footer-wrap">
			<div class="sponsor-footer">
				<h1>Sponsor Organizations</h1>
				<div class="sponsors">
					<?php
					$sponsors_page_id = get_field( 'sponsors_page_id', 'options' );
					$sponsors = get_field( 'sponsors', $sponsors_page_id );
					foreach ( $sponsors as $sponsor ):
						$sponsor_image = wp_get_attachment_image_src( $sponsor['sponsor_image'], 'sponsor-logo' );?>
						<div class="sponsor-logo" style="background-image: url(<?php echo $sponsor_image[0];?>)">
						</div><!--sponsor-logo-->
					<?php endforeach;?>
				</div><!-- .sponsors -->
			</div><!--sponsor-footer-->
		</div><!--sponsor-footer-wrap-->
		<div class="footer-inner">
			<div class="copyright">© Copyright 2012 MIT Energy Club</div>
			<div class="sharing">
				<div class="stay-connected">Stay Connected</div>
				<a class="share-button facebook-button" href="#" target="_blank" title="Facebook">Facebook</a>
				<a class="share-button twitter-button" href="#" target="_blank" title="Twiiter">Twitter</a>
				<a class="share-button linkedin-button" href="#" target="_blank" title="LinkedIn">LinkedIn</a>
				<a class="share-button newsletter-button" href="#" target="_blank" title="Newsletter">Newsletter</a>
				<a class="share-button contact-button" href="#" target="_blank" title="Contact">Contact</a>
				<a class="share-button addthis-button" href="#" target="_blank" title="Share">Share</a>
			</div><!--sharing-->
		</div><!--footer-inner-->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>