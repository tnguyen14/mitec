jQuery(document).ready(function($) {
	
	$(".homepage-feature .supporting-content").scrollable({ circular: true }).autoscroll(10000).navigator(".bottom-tabs");

	// removing onmouseover by EnergyFolks plugin
	// @todo: this doesn't work
	$('div.EnFolksListItem table').onmouseover = null;

	$('.EnFolksListItem span[id^="EnFolksScoreSpan"] a img').attr("src", "huh?");
});