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
			if (is_page() && !is_front_page()) : 
				$ancestors = get_post_ancestors($post->ID);
				$top_page = ($ancestors) ? $ancestors[0] : $post->ID;

				$args = array(
					'child_of' => $top_page,
					'title_li' => '',
					'sort_column' => 'menu_order',
					'echo' => 0,
					'depth' => 2
				);
				
				$side_pages = wp_list_pages($args);
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
					<h1></h1>
				</aside>
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
