<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package mitec
 * @since mitec 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php /* Sidebar Area */

			// Sidebar Nav
			if (is_page() && !is_front_page() || is_post_type_archive( 'team_members' ) || is_tax( 'teams' )) : 
				$ancestors = get_post_ancestors($post->ID);

				if ( is_post_type_archive( 'team_members' ) || is_tax( 'teams' )):
					$ancestors[0] = 26; // 26 is About section
				endif;

				$top_page = ($ancestors) ? $ancestors[0] : $post->ID;
				$args = array(
					'child_of' => $top_page,
					'title_li' => '',
					'sort_column' => 'menu_order',
					'echo' => 0,
					'depth' => 2
				);
				
				$side_pages = wp_list_pages($args);
				$url = get_bloginfo('url');

				if ( 26 == $top_page ):
					if ( is_post_type_archive( 'team_members' ) || is_tax( 'teams' )): // if is children of About section
						$term_args = array(
							'taxonomy'	=> 'teams',
							'exclude'	=> 4, // exclude Executive Team
							'hierarchical'	=> 0,
							'title_li'	=> '',
							'echo'		=> 0
						);
						$terms = wp_list_categories($term_args);
						$terms = '<ul>' . $terms . '</ul>';
						// prepend sub nav for terms to side pages
						$side_pages = $terms . $side_pages;
					endif; // IF is post type archive 'team_members' or taxonomy 'teams'

					$class = '';
					if (is_post_type_archive( 'team_members' )) :
						$class .= 'current_page_item';
					endif;
					$exec_comm = '<li class="'. $class .'"><a href="' . $url . '/team_members/">Executive Committee</a></li>';
					// prepend Executive Committee item to side pages
					$side_pages = $exec_comm . $side_pages;
				endif; // IF top page is 26
			endif;

			if ($side_pages) : ?>
				<aside class="sidebar-nav">
					<h1>In This Section</h1>
					<ul>
						<?php echo $side_pages; ?>
					</ul>
				</aside>
			<?php endif;

			// Timely Content Module
			?>
				<aside class="timely-content">
					<?php 
					$home_id = 6;
					if (get_field('use_custom_timely_content') ) :
						$timely_header = get_field('timely_content_header');
						$timely_support = get_field('timely_content_supporting_text');
						$timely_image = wp_get_attachment_image_src(get_field('timely_content_image'), 'timely-content');
						$timely_link = get_field('timely_content_link');
					else :
						$timely_header = get_field('timely_content_header', $home_id);
						$timely_support = get_field('timely_content_supporting_text', $home_id);
						$timely_image = wp_get_attachment_image_src(get_field('timely_content_image', $home_id), 'timely-content');
						$timely_link = get_field('timely_content_link', $home_id);
					endif;
					?>
						<h1><?php echo $timely_header;?></h1>
						<img src="<?php echo $timely_image[0];?>" width="<?php echo $timely_image[1];?>" height="<?php echo $timely_image[2];?>"/>
						<p><?php echo $timely_support;?></p>
						<a class="learn-more" href="<?php echo $timely_link;?>">Learn More</a>
				</aside>
				
			<?php // Facebook Aside Module
			?>
				<aside class="facebook-sidebar">
					<div class="facebook-outer">
						<div class="fb-like-box" 
							data-href="<?php echo esc_url(get_field('facebook_page', 'options'));?>" 
							data-width="275" 
							data-height="258"
							data-show-faces="true" 
							data-stream="false" 
							data-header="false"
							data-border-color="#FDFDFD">
						</div> 
					</div><!--facebookOuter-->
				</aside><!--facebook-sidebar-->
			<?php /*
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'mitec' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'mitec' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
			*/ ?>
		</div><!-- #secondary .widget-area -->
