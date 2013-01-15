<?php 
/**
 * SLOAN PAGE
 */
?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header sloan-carousel">
						<?php 
							$slides = get_field('carousel');
							if ($slides):
								foreach ($slides as $slide):?>
									<div class="carousel-slide">
										<h1><?php echo $slide['headline'];?></h1>
										<p><?php echo $slide['supporting_content'];?></p>
										<a href="<?php echo $slide['link'];?>">Learn More &raquo;</a>
									</div><!-- .carousel-slide -->
								<?php
								endforeach;
							endif; // end IF slides
						?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php // Volunteers Feature
							$volunteers = get_field('volunteers');
							if ($volunteers): ?>
								<div class="sloan-feature volunteers">
									<?php $volunteers_image = wp_get_attachment_image($volunteers[0]['image'], '310x120');
									if ($volunteers_image):
										echo $volunteers_image;
									endif; ?>
									<h1>Volunteers</h1>
									<p><?php echo $volunteers[0]['description'];?></p>
									<a class="cta-button" href="<?php echo esc_url($volunteers[0]['link']);?>"><?php echo $volunteers[0]['link_label'];?></a>
								</div><!-- .volunteers -->
						<?php
							endif;
						?>

						<?php // Applicants Feature
							$applicants = get_field('applicants');
							if ($applicants): ?>
								<div class="sloan-feature applicants">
									<?php $applicants_image =  wp_get_attachment_image($applicants[0]['image'], '310x120');
									if ($applicants_image):
										echo $applicants_image;
									endif; ?>
									<h1>Applicants</h1>
									<p><?php echo $applicants[0]['description'];?></p>
									<a class="cta-button" href="<?php echo esc_url($applicants[0]['link']);?>"><?php echo $applicants[0]['link_label'];?></a>
								</div><!-- .applicants -->
						<?php
							endif;
						?>

						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mitec' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'mitec' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
