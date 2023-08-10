(function(jQuery) {
'use strict';

//Trap focus inside mobile menu modal
		//Based on https://codepen.io/eskjondal/pen/zKZyyg	
		var trapFocusInsiders = function(elem) {
			
				
			var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
			
			var firstTabbable = tabbable.first();
			var lastTabbable = tabbable.last();
			/*set focus on first input*/
			firstTabbable.focus();
			
			/*redirect last tab to first input*/
			lastTabbable.on('keydown', function (e) {
			   if ((e.which === 9 && !e.shiftKey)) {
				   e.preventDefault();
				   
				   firstTabbable.focus();
				  
			   }
			});
			
			/*redirect first shift+tab to last input*/
			firstTabbable.on('keydown', function (e) {
				if ((e.which === 9 && e.shiftKey)) {
					e.preventDefault();
					lastTabbable.focus();
				}
			});
			
			/* allow escape key to close insiders div */
			elem.on('keyup', function(e){
			  if (e.keyCode === 27 ) {
				elem.hide();
			  };
			});
			
		};
		
jQuery(document).ready(function($) {
	
	/* ## Document Scroll - Window Scroll */
	if( $("#sticker").length){
		$("#sticker").sticky();
	}



	/* -- Responsive Caret */
	if( $(".ddl-switch").length ){
		$(".ddl-switch").on("click", function() {

			var li = $(this).parent();
			if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
				li.removeClass("ddl-active");
				li.children().find(".ddl-active").removeClass("ddl-active");
				li.children(".dropdown-menu").slideUp();
			}
			else {
				li.addClass("ddl-active");
				li.children(".dropdown-menu").slideDown();
			}
			
		});
	}
	
	
	
	/* -- image-popup */
	if( $('.image-popup').length ){
		 $('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	
	
	
	/* -- Client Section */
	if( $(".owlGallery").length ) {
		$(".owlGallery").owlCarousel({
			navText: [ '<i class="fa fa-chevron-right"></i>', '<i class="fa fa-chevron-left"></i>' ],
			stagePadding: 0,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 10,
			nav: true,
			dots: false,
			smartSpeed: 1000,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	}
	
	
	/* -- popup-search */
	if( $("#popup-search").length){
		$('#popup-search').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').fadeIn();
		});
	}
	
	/* -- close-popup-search */
	if( $(".close-popup").length){
		$('.close-popup').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').hide();
		});
	}
	
	/*=============================================
	=            Main Menu         =
	=============================================*/
	
	$('.ow-navigation .nav.navbar-nav > li > a').keyup(function (e) {
		if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
			$(".ow-navigation .nav.navbar-nav > li").removeClass('focus');
			$(this).parents('li.menu-item-has-children').addClass('focus');
		}
	});	
	
	$('#popup-search').keyup(function (e) {
		e.preventDefault();
		$(".ow-navigation .nav.navbar-nav > li").removeClass('focus');
		var code = e.keyCode || e.which;
		if(code == 13) {
			
			$('.popup-search .search-field').focus();
		}
	});	
	trapFocusInsiders( $('#popup-search-wrap') );
	
	if( $(".ddl-switch").length ){
		$('.ddl-switch').keyup(function (e) {
		var code = e.keyCode || e.which;
		if(code == 13) {
			var li = $(this).parent();
			if ( li.hasClass("ddl-active") || li.find(".ddl-active").length !== 0 || li.find(".dropdown-menu").is(":visible") ) {
				li.removeClass("ddl-active");
				li.children().find(".ddl-active").removeClass("ddl-active");
				li.children(".dropdown-menu").slideUp();
			}
			else {
				li.addClass("ddl-active");
				li.children(".dropdown-menu").slideDown();
			}
		}
		});
	}

	AOS.init();

});
})(jQuery);