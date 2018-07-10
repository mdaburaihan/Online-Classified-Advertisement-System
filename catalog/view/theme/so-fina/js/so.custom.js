/* Add Custom Code Jquery
 ========================================================*/
$(document).ready(function(){

	// Messenger Top Link
	$('.list-msg').owlCarousel2({
		pagination: false,
		center: false,
		nav: false,
		dots: false,
		loop: true,
		slideBy: 1,
		autoplay: true,
		margin: 30,
		autoplayTimeout: 4500,
		autoplayHoverPause: true,
		autoplaySpeed: 1200,
		startPosition: 0, 
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},
			768:{
				items:1
			},
			1200:{
				items:1
			}
		}
	});


	
	// Slider Clients Say
	$('.slider-clients-say').owlCarousel2({
		pagination: false,
		center: false,
		nav: true,
		loop: true,
		slideBy: 1,
		autoplay: true,
		margin: 0,
		navText: ['',''],
		autoplayTimeout: 7500,
		autoplayHoverPause: true,
		autoplaySpeed: 1200,
		startPosition: 0, 
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},
			768:{
				items:1
			},
			1200:{
				items:1
			}
		}
	});

	// click header search mobile
	jQuery(document).ready(function($){
		$( ".searchbox .icon-search" ).click(function() {
		$('#search').slideToggle(200);
		$(this).toggleClass('active');
		});
	});
});
