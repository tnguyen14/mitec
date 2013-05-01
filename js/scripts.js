jQuery( document ).ready( function($) {
	//$(".homepage-feature .homepage-carousel").scrollable({ circular: true }).autoscroll(10000).navigator(".bottom-tabs");
	$(".homepage-feature .features").bxSlider({
		auto: true,
		controls: false,
		pause: 8000,
		pagerCustom: '.bottom-tabs'
	});
	$( '.homepage-lower-content .module-wrap > .homepage-module:first-child a' )
		.addClass( 'fancybox' )
		.attr( 'href', 'https://www.energyfolks.com/accounts/CreateAccountExternal/18' )
		.attr( 'data-fancybox-type', 'iframe' );
	$( '.fancybox' ).fancybox();

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
	// Since Energy Folks plugin overwrite the window.onload event, attaching click event listener to body
	$( 'body' ).on( "click", ".member-login a", function(){
		$( '#efadminbar_sub1' ).toggle();
		return false;
	} );
});