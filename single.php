<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mitec
 * @since mitec 1.0
 */

get_header(); ?>
<div class="cover-photo">
		<?php
		// Get the blog page ID
		$blog_page = get_page_by_title( 'Blog' );
		$blog_id = $blog_page->ID;

		if (has_post_thumbnail( $blog_id )) {
			echo get_the_post_thumbnail( $blog_id, 'cover-photo' );
		}?>
</div><!--cover-photo-->
<div class="content-wrap">

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<header class="entry-header">
					<h1 class="entry-title">Blog</h1>
				</header><!-- .entry-header -->

				<div class="entry-content single-post">

					<?php if ( have_posts() ) : ?>
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<h1 class="post-title"><?php the_title(); ?></h1>
							<p class="post-date"><?php the_date(); ?></p>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-featured-image">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php endif; ?>

							<?php the_content();?>

							<?php comments_template(); ?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'no-results', 'index' ); ?>

					<?php endif; ?>
				</div><!-- .entry-content -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
</div><!--content-wrap-->
<?php get_footer(); ?>