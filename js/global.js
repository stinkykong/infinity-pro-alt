jQuery(document).ready(function($) {

	// Match height for content and sidebar
	$( '.content, .sidebar' ).matchHeight();

});

jQuery(function($) {

	// Set offscreen container height
	var windowHeight = $(window).height();

	$( '.offscreen-container' ).css({
		'height': windowHeight + 'px'
	});
	
	if ( ( 'relative' !== $( '.js .nav-primary' ).css( 'position' ) ) ) {
		var headerHeight = $( '.site-header' ).height();
		$( '.site-inner' ).not( '.front-page .site-inner' ).css( 'margin-top', headerHeight+'px' );
	} else {
		$( '.site-inner' ).removeAttr( 'style' );
	}

	$(window).resize(function() {

		var windowHeight = $(window).height();

		$( '.offscreen-container' ).css({
			'height': windowHeight + 'px'
		});
		
		if ( ( 'relative' !== $( '.js .nav-primary' ).css( 'position' ) ) ) {
			var headerHeight = $( '.site-header' ).height();
			$( '.site-inner' ).not( '.front-page .site-inner' ).css( 'margin-top', headerHeight+'px' );
		} else {
			$( '.site-inner' ).removeAttr( 'style' );
		}

	});

	// Add white class to site header after 50px
	$(document).on( 'scroll', function() {

		if ( $(document).scrollTop() > 50 ) {
			$( '.site-container' ).addClass( 'white' );

		} else {
			$( '.site-container' ).removeClass( 'white' );
		}

	});

	// Set offscreen content variables
	var body = $( 'body' ),
		content = $( '.offscreen-content' ),
		sOpen = false;

	// Toggle the offscreen content widget area
	$(document).ready(function() {

		$( '.offscreen-content-toggle' ).click(function() {
			__toggleOffscreenContent();
		});

	});

	function __toggleOffscreenContent() {

		if (sOpen) {
			content.fadeOut();
			body.toggleClass( 'no-scroll' );
			sOpen = false;
		} else {
			content.fadeIn();
			body.toggleClass( 'no-scroll' );
			sOpen = true;
		}

	}

});