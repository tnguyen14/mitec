jQuery(document).ready(function($) {

	$(".homepage-feature .homepage-carousel").scrollable({ circular: true }).autoscroll(10000).navigator(".bottom-tabs");
	/*$(".homepage-feature").bxSlider({
		auto: true,
		pause: 10000,
		pagerSelector: '.bottom-tabs'
	});*/
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

	$('.EnFolksListItem span[id^="EnFolksScoreSpan"] a img').attr("src", "huh?");
});