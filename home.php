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

				<div class="entry-content blog-list">
					<?php /* featured posts */
					$featured = new WP_Query( array(
						'post_type'		=> 'post',
						'meta_key'		=> 'mitec_blog_featured_post',
						'meta_value'	=> 1
						) );
					if ( $featured->have_posts() ) :
						while ( $featured->have_posts() ) : $featured->the_post(); ?>
							<div class="blog-post feature">
								<?php $featured_post_id = $post->ID; ?>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-featured-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php endif; ?>
								<h1 class="post-title"><?php the_title(); ?></h1>
								<p class="post-date"><?php the_date(); ?></p>
								<?php the_excerpt();?>

							</div><!-- .blog-post .feature -->
							<?php
							// only get 1 featured post
							break;
						endwhile;

					endif;
					wp_reset_postdata();
					?>

					<?php if ( have_posts() ) : ?>
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php if ( $featured_post_id != $post->ID ) : ?>
								<div class="blog-post">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="post-featured-image">
											<?php the_post_thumbnail(); ?>
										</div>
									<?php endif; ?>
									<h1 class="post-title"><?php the_title(); ?></h1>
									<p class="post-date"><?php the_date(); ?></p>
									<?php the_excerpt();?>
								</div><!-- .blog-post -->

							<?php endif; ?>

						<?php endwhile; ?>

						<?php mitec_content_nav( 'nav-below' ); ?>

					<?php else : ?>

						<p>There is no post here at the moment. Check back soon!</p>

					<?php endif; ?>
				</div><!-- .entry-content -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
</div><!--content-wrap-->
<?php get_footer(); ?>