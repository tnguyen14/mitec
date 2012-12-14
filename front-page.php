<?php // Homepage

get_header(); ?>

		<div id="primary" class="content-area">
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

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>