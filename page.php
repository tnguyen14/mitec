<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package mitec
 * @since mitec 1.0
 */

get_header(); ?>
<div class="cover-photo">
		<?php if (has_post_thumbnail()) {
			the_post_thumbnail('cover-photo');
		}?>
</div><!--cover-photo-->
<div class="content-wrap">
	
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				if (is_page('Sloan')):
					get_template_part('content', 'sloan');
				else:
					get_template_part( 'content', 'page' ); 
				endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
</div><!--content-wrap-->

<?php get_footer(); ?>