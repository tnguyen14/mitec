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
		if ( get_field( 'presentations_subheadline' ) ):?>
		<section class="presentations">
			<h1>Presentations</h1>
			<p><?php the_field( 'presentations_subheadline' );?></p>
			<?php if ( get_field( 'presentations' ) ):
				$presentations = get_field( 'presentations' );
				foreach ( $presentations as $prez ):?>
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
		</section><!-- .presentations -->
		<?php endif; ?>


		<?php /* Calendar page */
		if ( is_page( 'Calendar' ) ):
			// the display:none div is required to show the top search bar ?>
			<div style="display:none">
				<?php
				echo do_shortcode( '[energyfolks_searchbar type=calendar-agenda]' );?>
			</div>
			<?php
			echo do_shortcode( '[energyfolks type="calendar-agenda" customcss=1 setcolor="B1931C"]' );
		endif; // end IF Calendar page ?>

		<?php /* Bulletings Page */
		if ( is_page( 'Bulletins' ) ):
			// the display:none div is required to show the top search bar ?>
			<div style="display:none">
				<?php
				echo do_shortcode( '[energyfolks_searchbar type=bulletins-stream]' );?>
			</div>
			<?php echo do_shortcode( '[energyfolks type=bulletins-stream customcss=1]' );
		endif; // end IF Bulletins page ?>

		<?php /* Blog Page */
		if ( is_page( 'Blog' ) ):
			echo do_shortcode( '[energyfolks type=blog]' );
		endif; // end IF Blog page ?>

		<?php /* Jobs Page */
		if ( is_page( 'Jobs' ) ):
			// the display:none div is required to show the top search bar ?>
			<div style="display:none">
				<?php
				echo do_shortcode( '[energyfolks_searchbar type=jobs]' );?>
			</div>
			<?php echo do_shortcode( '[energyfolks type=jobs]' );
		endif; // end IF Jobs page ?>

		<?php /* Membership List Page */
		if ( is_page( 'Membership List' ) ):
			echo do_shortcode( '[energyfolks type=users restricttothread=21]' );
		endif; // end IF Membership List page ?>

		<?php /* Sponsors Page */
		if ( is_page( 'Sponsors' ) ):
			$sponsors = get_field('sponsors');
			foreach ($sponsors as $sponsor):
				$sponsor_image = wp_get_attachment_image($sponsor['sponsor_image'], 'sponsor-logo');?>
				<div class="sponsor-single">
					<?php echo $sponsor_image; ?>
					<a href="<?php echo $sponsor['sponsor_link'];?>"><h3><?php echo $sponsor['sponsor_name'];?></h3></a>
					<p><?php echo $sponsor['sponsor_description'];?></p>
				</div><!-- .sponsor-single -->
			<?php endforeach;
		endif; // end IF Sponsors Page
		?>
		<?php if ( is_page( 'Contact' ) ):
			echo '<p>Please contact us at this address: <a href="' . antispambot( get_field( 'contact_email', 'options' ), 1 ) . '">' . antispambot( get_field( 'contact_email', 'options' ) ) . '</p>';
		endif; ?>
		<?php /* Sloan About Us */
		if ( is_page( 'About Us' ) ):
			$members = get_field('members');
			if ( $members ): ?>
				<div class="sloan-about-us">

				<?php
				foreach ( $members as $member ): ?>
					<div class="team-member">
						<div class="member-description">
							<h1><?php echo $member['name'] . ' - ' . $member['position']; ?></h1>
							<?php echo $member['description'];?>
						</div>
					</div><!-- .team-member -->
				<?php endforeach; ?>
				</div><!-- .sloan-about-us -->
			<?php endif; // end IF members

		endif; // end IF Sloan About Us
		?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mitec' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'mitec' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
