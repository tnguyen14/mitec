jQuery(document).ready(function($) {

	//$(".homepage-feature .homepage-carousel").scrollable({ circular: true }).autoscroll(10000).navigator(".bottom-tabs");
	$(".homepage-feature .features").bxSlider({
		auto: true,
		controls: false,
		pause: 8000,
		pagerCustom: '.bottom-tabs'
	});
	$(".sloan-carousel").bxSlider({
		auto: true,
		pause: 8000,
		pager: false
	});

	$(".sponsor-footer .sponsors").bxSlider({
		auto: true,
		pause: 8000,
		minSlides: 1,
		maxSlides: 5,
		moveSlides: 1,
		slideWidth: 175,
		pager: false,
		controls: false
	});

});