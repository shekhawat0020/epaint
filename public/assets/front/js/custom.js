
$(document).ready(function() {
	"use strict";
	
	/*SCROLl a div Script*/
	
	$('.scroll-link').on('click', function(event){
		event.preventDefault();
		var sectionID = $(this).attr("data-id");
		scrollToID('#' + sectionID, 1000);
	});
		function scrollToID(id, speed){
		var offSet = 72;
		var targetOffset = $(id).offset().top - offSet;
		$('html,body').animate({scrollTop:targetOffset}, speed);
	}
	/*SCROLl a div Script END*/
	
	$('.hamburger').click(function(){
		$('.navigation').toggleClass('show');
		$('body').addClass('ohidden');
	});
	$('.close_nav').click(function(){
		$('.navigation').removeClass('show');
		$('body').removeClass('ohidden');
	});
	
	$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
	
	$('.banner_carousel').owlCarousel({
        loop:true,
        nav:false,
		dots:true,
		smartSpeed: 1000,
        margin:0,
		autoplay:true,
		autoplayTimeout:6000,
		dotsContainer: '#myDots',
		animateOut: 'fadeOut',
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
			1024:{
                items:1
            },
            1366:{
                items:1
            }
        }
    })
	
	var myBanner = document.getElementById('home-banner')
	var carousel = new bootstrap.Carousel(myBanner, {
		interval: false,
		wrap: false,
		ride: 'carousel',
		pause: false,
	})
	
	$('.collection_carousel').owlCarousel({
        loop:false,
        nav:false,
		dots:true,
		smartSpeed: 1000,
        margin:0,
		autoplay:false,
		autoplayTimeout:6000,
		//dotsContainer: '.myDotsCollection',
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
			1024:{
                items:1
            },
            1366:{
                items:1
            }
        }
    })
	$('.collection_carousel2').owlCarousel({
        loop:false,
        nav:false,
		dots:true,
		smartSpeed: 1000,
        margin:0,
		autoplay:false,
		autoplayTimeout:6000,
        responsive:{
            0:{
                items:1
            },
            768:{
                items:1
            },
			1024:{
                items:1
            },
            1366:{
                items:1
            }
        }
    })
	$('.rp_carousel').owlCarousel({
        loop:false,
        nav:false,
		dots:true,
		smartSpeed: 1000,
        margin:30,
		autoplay:false,
		autoplayTimeout:6000,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            768:{
                items:3
            },
			1024:{
                items:3
            },
            1366:{
                items:4
            }
        }
    })
	
	
	$('.testimonial_carousel').owlCarousel({
        loop:false,
        nav:false,
		dots:true,
		smartSpeed: 1000,
        margin:30,
		autoplay:false,
		autoplayTimeout:6000,
        responsive:{
            0:{
                items:1
            },
            768:{
                items:2
            },
			1024:{
                items:3
            },
            1366:{
                items:3
            }
        }
    })
	

	$('.product_carousel').owlCarousel({
        loop:true,
        nav:true,
		navText: [ '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>' ],
		dots:false,
		smartSpeed: 1000,
        margin:10,
		autoplay:true,
		autoplayTimeout:6000,
        responsive:{
            0:{
                items:2
            },
            768:{
                items:3
            },
			1024:{
                items:3
            },
            1280:{
                items:4
            }
        }
    })
	
});// End of Document.ready



/*AOS.init({ disable: 'mobile' });*/

