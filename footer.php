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
				<?php 
				$sponsor_page_id = 75;
				$sponsors = get_field('sponsor', $sponsor_page_id);
				foreach ($sponsors as $sponsor):
					$sponsor_image = wp_get_attachment_image_src($sponsor['sponsor_image'], 'sponsor-logo');?>
					<div class="sponsor-logo" style="background-image: url(<?php echo $sponsor_image[0];?>)">
					</div><!--sponsor-logo-->
				<?php endforeach;?>
			</div><!--sponsor-footer-->
		</div><!--sponsor-footer-wrap-->
		<div class="footer-inner">
			<div class="copyright">© Copyright 2012 MIT Energy Club</div>
			<div class="sharing">
				<div class="stay-connected">Stay Connected</div>
				<a class="share-button facebook-button" href="#" target="_blank">Facebook</a>
				<a class="share-button twitter-button" href="#" target="_blank">Twitter</a>
				<a class="share-button linkedin-button" href="#" target="_blank">LinkedIn</a>
				<a class="share-button newsletter-button" href="#" target="_blank">Newsletter</a>
				<a class="share-button contact-button" href="#" target="_blank">Contact</a>
				<a class="share-button addthis-button" href="#" target="_blank">Share</a>
			</div><!--sharing-->
		</div><!--footer-inner-->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>