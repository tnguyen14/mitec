<?php // Homepage

get_header(); ?>

		<div id="primary" class="content-area-home">
			<div id="content" class="site-content" role="main">
				<div class="homepage-feature">
					<div class="main-headline">
						<p>
							<?php the_field("main_headline");?>
						</p>
					</div><!--main-headline-->
					<div class="supporting-content">
						<div class="features">
							<?php $features = get_field('features');
							if ($features) {
								$count = 1;
								foreach($features as $feature) {
									if ($count == 1) {
										echo '<div class="feature feature-1 active" id="feature-1"><p>';
									}
									else {
										echo '<div class="feature feature-'.$count.'" id="feature-"'.$count.'><p>';
									}
									echo $feature['supporting_text'].' <a href='.$feature['supporting_link'].'>Learn More</a>'.'</p></div>';
									$count++;
								}
							} ?>
						</div><!--features-->
					</div><!--supporting-content-->
				</div><!--homepage-feature-->
				<div class="tabs-wrap">
					<div class="bottom-tabs">
						<?php $count = count($features);
							for ($i = 1; $i <= $count; $i++) {
								if ($i == 1) {
									echo '<a class="tab tab-'.$count.' active" href="#feature-1"></a>';
								}
								else {
									echo '<a class="tab tab-'.$count.'" href="#feature-'.$i.'""></a>';
								}
							} ?>
					</div>
				</div><!--bottom-tabs-->

				<div class="homepage-lower-wrap">
					<div class="homepage-lower-content">
						<?php $modules = get_field('modules');
						// if there are 2 modules to display
						if (count($modules)== 2):
							foreach($modules as $module):?>
								<div class="homepage-module">
									<h1><?php echo $module['module_title'];?></h1>
									<?php $module_image = wp_get_attachment_image_src($module['module_image'], 'homepage-module');?>
									<img src="<?php echo $module_image[0];?>" width="<?php echo $module_image[1];?>" height="<?php echo $module_image[2];?>"/>
									<h2><?php echo $module['module_header'];?></h2>
									<p><?php echo $module['module_text'];?></p>
									<a class="learn-more" href="<?php echo $module['module_link'];?>">Learn More</a>
								</div><!--homepage-module-->
							<?php 
							endforeach;
						endif;?>
						<div class="homepage-event-feed">
							<h1>Events Calendar</h1>
							<div class="event">
								<div class="event-date">
									<span class="month">July</span>
									<span class="date">21</span>
								</div><!--event-date-->
								<h2>Event Name Area Goes Here Blah Blah Blah</h2>
								<p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
								<a class="learn-more" href="#">Learn More</a>
							</div><!--event-->
							<div class="event">
								<div class="event-date">
									<span class="month">August</span>
									<span class="date">23</span>
								</div><!--event-date-->
								<h2>Event Name Area Goes Here Blah Blah Blah</h2>
								<p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
								<a class="learn-more" href="#">Learn More</a>
							</div><!--event-->
						</div><!--homepage-event-feed-->
					</div><!--homepage-lower-content-->
				</div><!--homepage-lower-wrap-->
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>