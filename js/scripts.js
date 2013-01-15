jQuery(document).ready(function($) {
	
	$(".homepage-feature .supporting-content").scrollable({ circular: true }).autoscroll(10000).navigator(".bottom-tabs");
	$(".sloan-carousel").bxSlider({
		auto: true,
		pause: 8000,
		pager: false
	});

	$('.EnFolksListItem span[id^="EnFolksScoreSpan"] a img').attr("src", "huh?");
});