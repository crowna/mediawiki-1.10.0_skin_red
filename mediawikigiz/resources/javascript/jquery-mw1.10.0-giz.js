/**
* @author Jeremy Crowe
* @version mw1.10.0_150902
* @file ~\mediawikigiz\resources\javascript\jquery-mw1.10.0-giz.js
* 
* @description jQuery to enhance Mediawiki projects on GC21
* 
*/

// Creating a new function, fadeToggle()
$.fn.fadeToggle = function( speed, easing, callback ) {
	return this.animate( { opacity: 'toggle' }, speed, easing, callback );
};
/////// -- Tweak jQuery Timer -- ///////
$.timerId = setInterval( function() {
	var timers = jQuery.timers;
	for ( var i = 0; i < timers.length; i++ ) {
		if ( !timers[i]() ) {
			timers.splice( i--, 1 );
		}
	}
	if ( !timers.length ) {
		clearInterval( jQuery.timerId );
		jQuery.timerId = null;
	}
}, 83 );

/**
* toggle for
*  display/hide an element 
*  fit/remove indicator class to button
* @var element: string target
* @var self: button to highlight (default: itself)
*/
function jq_view_drop (element , self) {
	
	$( element ).fadeToggle( 400 );

	if (self!=null){
		$( self ).toggleClass( 'open' );
	}
	else{
		$( this ).toggleClass( 'open' );
	}
}

/////// --jQuery Tabs-- ///////

$( function () {
	var tabContainers = $( '#menu-head > ul' );

	$( '#tabnav a' ).click( function () {
		/**
		* selects which sub menu is open/displayed via css
		*/
		
		if( $( this ).hasClass( 'selected' ) ){
			tabContainers.hide();
			$( '#tabnav a' ).removeClass( 'selected' );
		}else{
			tabContainers.hide().filter( this.hash ).show();
			$( '#tabnav a' ).removeClass( 'selected' );			
			$( this ).addClass( 'selected' );
		
		}

		return false;
	} )/*.filter( ':first' ).click()*/;
	
	$( '#headerbar-menu a' ).on( 'click', function( e ) {
		e.preventDefault();
		jq_view_drop("#mwgiz-menu")
	} );
	
	$('.post').prepend('<div id="page_actions"><span id="actions">Actions</span></div>');
	$('#page_actions').append( $('ul#head-actions') );
	$( "#page_actions" ).hover(
		function() {
			jq_view_drop("ul#head-actions");
		}, function() {
			jq_view_drop("ul#head-actions");
		}
	);
	$('#tabnav a').each(function (){ //remove Actions link from menu tabnav
		if ( $(this).attr('href') == '#head-actions' ){
			$(this).remove();
		}
	});
	
	//browser css corrections
	if ( typeof navigator.msPointerEnabled != "undefined" ) {
		//$('ul#preftoc').css('margin','1px'); 	
		//$('ul#preftoc li').css('padding','5px 5px 0px'); 	
	}
} );


