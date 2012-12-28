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

		

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mitec' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'mitec' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
