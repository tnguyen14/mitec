/**
 * Handles toggling the main navigation menu for small screens.
 */
jQuery( document ).ready( function( $ ) {
	var $masthead = $( '#masthead' ),
		timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '.site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$masthead.find( '.site-navigation h1' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).unbind( 'click' ).click( function() {
			$masthead.find( '.menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	$.fn.smallMenuRemove = function() {
		$masthead.find( '.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
		$masthead.find( '.site-navigation h1' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
		$masthead.find( '.menu' ).removeAttr( 'style' );
	};

	$.fn.topLinksCollapse = function() {
		$masthead.find( '.top-links' ).addClass( 'top-links-collapse' );
		//$masthead.find( '.top-links' ).append( '<h1 class="links-toggle">Energy Links</h1>' );

		$ ( '.links-toggle' ).unbind( 'click' ).click( function(){
			$masthead.find( '.links' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	$.fn.topLinksCollapseRemove = function() {
		$masthead.find( '.top-links' ).removeClass( 'top-links-collapse' );
		//$masthead.find( 'links-toggle' ).remove();
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 560 ) {
		$.fn.smallMenu();
		$.fn.topLinksCollapse();
	}

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout ) {
			clearTimeout( timeout );
		}

		timeout = setTimeout( function() {
			if ( browserWidth < 560 ) {
				$.fn.smallMenu();
				$.fn.topLinksCollapse();
			} else {
				$.fn.smallMenuRemove();
				$.fn.topLinksCollapseRemove();
			}
		}, 200 );
	} );

} );