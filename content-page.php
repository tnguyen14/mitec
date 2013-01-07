<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package mitec
 * @since mitec 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php /* Presentations - Communities page */
		if (get_field('presentations_subheadline')):?>
			<h2>Presentations</h2>
			<p><?php the_field('presentations_subheadline');?></p>
			<?php if (get_field('presentations')):
				$presentations = get_field('presentations');
				foreach ($presentations as $prez):?>
					<div class="presentation">
						<h1><?php echo $prez['title'];?></h1>
						<p><?php echo $prez['description'];?></p>
						<?php if ($prez['link']):?>
							<a class="cta-button" href="<?php echo esc_url($prez['link']);?>">View Presentation</a>
						<?php endif;?>
					</div><!-- .presentation-->
				<?php endforeach; 
			else:?>
				<p>There is currently no presentation.</p>
			<?php endif; // end IF get_field('presentations;) ?>
		<?php endif; ?>


		<?php /* Calendar page */
		if (is_page('Calendar')):?>
			<div style="display:none">
				<?php
				echo do_shortcode( '[energyfolks_searchbar type=calendar-agenda]' );?>
			</div>
			<?php 
			echo do_shortcode( '[energyfolks type="calendar-agenda" customcss=1 setcolor="B1931C"]' ); 
		endif; // end IF Calendar page ?>

		<?php /* Bulletings Page */
		if (is_page('Bulletins')):
			echo do_shortcode( '[energyfolks type=bulletins-stream customcss=1]' );
		endif; // end IF Bulletins page ?>

		<?php /* Blog Page */
		if (is_page('Blog')):
			echo do_shortcode( '[energyfolks type=blog]' );
		endif; // end IF Blog page ?>

		<?php /* Jobs Page */
		if (is_page('Jobs')):
			echo do_shortcode( '[energyfolks type=jobs restricttothread=21]' );
		endif; // end IF Jobs page ?>

		<?php /* Membership List Page */
		if (is_page('Membership List')):
			echo do_shortcode( '[energyfolks type=users restricttothread=21]' );
		endif; // end IF Membership List page ?>



		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mitec' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'mitec' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
