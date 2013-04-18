<?php // Homepage

get_header(); ?>

		<div id="primary" class="content-area-home">
			<div id="content" class="site-content" role="main">
				<div class="homepage-feature">
					<div class="headline-holder"></div>
					<div class="content-holder"></div>
					<div class="homepage-carousel">
						<div class="features">
							<?php /*
							<div class="main-headline">
								<p>
									<?php the_field("main_headline");?>
								</p>
							</div><!--main-headline-->
							*/?>

								<?php $features = get_field('features');
								if ($features) {
									$count = 1;
									foreach($features as $feature) {
										if ($count == 1) {
											echo '<div class="feature-single feature-1 active" id="feature-1">';
										}
										else {
											echo '<div class="feature-single feature-'.$count.'" id="feature-"'.$count.'>';
										}
										echo '<div class="headline">' . $feature['headline'] . '</div><!-- .headline -->';
										echo '<div class="supporting-content"><p>' . $feature['supporting_text'];
										if ($feature['supporting_link']) {
											echo '<a class="learn-more" href=' . $feature['supporting_link'] . '>Learn More</a>';
										}
										echo '</p></div><!-- .supporting-content -->';
										echo '</div><!-- .feature-single -->';
										$count++;
									}
								} ?>
						</div><!--features-->
					</div><!-- .homepage-carousel -->
				</div><!--homepage-feature-->
				<div class="tabs-wrap">
					<div class="bottom-tabs">
						<?php $count = count($features);
							for ($i = 0; $i < $count; $i++) {
								echo '<a class="tab tab-'.$count.'" href="" data-slide-index="' . $i . '"></a>';
							} ?>
					</div>
				</div><!--bottom-tabs-->

				<div class="homepage-lower-wrap">
					<div class="homepage-lower-content">
						<?php $modules = get_field('modules');
						// if there are 2 modules to display
						if (count($modules)== 2): ?>
							<div class="module-wrap">
							<?php foreach( $modules as $module ):?>
								<div class="homepage-module">
									<h1><?php echo $module['module_title'];?></h1>
									<?php $module_image = wp_get_attachment_image_src($module['module_image'], 'homepage-module');?>
									<img src="<?php echo $module_image[0];?>" width="<?php echo $module_image[1];?>" height="<?php echo $module_image[2];?>"/>
									<h2><?php echo $module['module_header'];?></h2>
									<p><?php echo $module['module_text'];?></p>
									<a class="learn-more" href="<?php echo $module['module_link'];?>">Learn More</a>
								</div><!--homepage-module-->
							<?php
							endforeach; ?>
							</div><!-- .module-wrap -->
						<?php endif;?>
						<div class="homepage-event-feed">
							<h1>Events Calendar</h1>
							<?php $events = get_ef_events( 'https://www.energyfolks.com/calendar/json/21/0/0' );
							if ( $events ):
								$num_events = 4;
								$i = 0;
								date_default_timezone_set('America/New_York');
								foreach ( $events as $event ) :
									if ( $i < $num_events ):
										$event_start =  $event->start ;
								?>
										<div class="event">
											<div class="event-date">
												<span class="month"><?php echo date( 'F', $event_start );?></span>
												<span class="date"><?php echo date( 'd', $event_start );?></span>
											</div><!-- .event-date -->
											<h2><?php echo $event->name;?></h2>
											<p><?php echo $event->synopsis;?> <a class="learn-more" href="https://www.energyfolks.com/calendar">Learn More</a></p>
										</div><!-- .event -->
								<?php
										$i++;
									else :
										break;
									endif;
								endforeach; ?>
							<?php endif; ?>
						</div><!--homepage-event-feed-->
					</div><!--homepage-lower-content-->
				</div><!--homepage-lower-wrap-->
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>