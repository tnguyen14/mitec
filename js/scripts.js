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

	$('.EnFolksListItem span[id^="EnFolksScoreSpan"] a img').attr("src", "huh?");
});