<?php
/**
 * The template for displaying Team Members page.
 *
 * @package mitec
 * @since mitec 1.0
 */

get_header(); ?>
<div class="cover-photo">
		<?php // Use post thumbnail of page 26 - About page
		if ( has_post_thumbnail( 26 ) ) {
			echo get_the_post_thumbnail( 26, 'cover-photo' );
		} ?>
</div><!--cover-photo-->
<div class="content-wrap">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article class="page team_members-archive hentry ">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php
						/*
						$term = get_term_by('slug', 'executive-team', 'teams');
						if ($term) {
							echo $term->name;
						}
						*/
						?>
						Executive Committee
					</h1><!-- .entry-title -->
				</header><!-- .entry-header -->
				<div class="entry-content team-members">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php //get_template_part( 'content', 'page' );

						?>
						<div class="team-member">
							<?php // set up
							$email = get_field('email');
							$name = get_the_title();
							$position = get_field('position');
							$image = get_field('picture');
							$default = 'mm';
							$size = 120;
							// get gravatar
							$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . '?d=' . $default . '&s='  . $size;
							if (!$image) : ?>
								<img src="<?php echo $grav_url; ?>" alt="<?php echo $name;?>" title=<?php echo $name;?> width="120" height="120" />
							<?php
							else :
								wp_get_attachment_image($image, 'team-member');
							endif;?>
							<div class="member-description">
								<h1><?php echo $name. ', '.$position;?></h1>
								<?php the_content();?>
							</div><!-- .member-description -->
						</div><!-- .team-member -->

					<?php endwhile; // end of the loop. ?>
				</div><!-- .entry-content -->
			</article>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

	<?php get_sidebar(); ?>
</div><!--content-wrap-->

<?php get_footer(); ?>