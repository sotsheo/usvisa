	$(document).ready(function() {
      $('#owl-detail').slick({
         slidesToShow: 4,
         slidesToScroll: 1,
         arrows: true,
         dots:false,
         infinite: false,
         vertical: true,
         responsive: [
         {
            breakpoint: 500,
            settings: {
               slidesToShow: 3,
               slidesToScroll: 1
            }
         },
         {
            breakpoint: 767,
            settings: {
               slidesToShow: 3,
               slidesToScroll: 1
            }
         },
         {
            breakpoint: 992,
            settings: {
               slidesToShow: 4,
               slidesToScroll: 1
            }
         },
         {
            breakpoint: 1920,
            settings: {
               slidesToShow: 4,
               slidesToScroll: 1
            }
         }
         ]
      });

      $('.slider_main').owlCarousel({
         items: 1,
         loop: true,
         margin:0,
         nav:true,
         dots:false,
         autoplay:true,
         autoplayTimeout:4000,
        
         smartSpeed:1000,
         navText : ["<span><i class='fa fa-angle-left'></i></span>","<span><i class='fa fa-angle-right'></i></span>"],
         responsive:{
            0:{
               items:1
            },
            600:{
               items:1
            },
            1000:{
               items:1
            }
         }
      });
      $('.list_chose').owlCarousel({
         items: 3,
         margin:30,
         nav:false,
         dots:true,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
        
         responsive:{
            0:{
               items:1
            },
            600:{
               items:2
            },
            1000:{
               items:3
            }
         }
      });
      
      $('.list_view_package').owlCarousel({
         items: 3,
         margin:30,
         nav:false,
         dots:false,     
         responsive:{
            0:{
               items:2
            },
            600:{
               items:2
            },
            1000:{
               items:3
            }
         }
      });
      $('.news_relation').owlCarousel({
         items:3,
         margin:30,
         nav:false,
         dots:true,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
        
         responsive:{
            0:{
               items:1
            },
            600:{
               items:2
            },
            1000:{
               items:3
            }
         }
      });
       $('.list_team').owlCarousel({
         items: 4,
         margin:30,
         nav:false,
         dots:true,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
        
         responsive:{
            0:{
               items:1
            },
            600:{
               items:3
            },
            1000:{
               items:4
            }
         }
      });
      
      $('.list_it_work').owlCarousel({
         items: 4,
         margin:30,
         nav:false,
         dots:false,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
        
         responsive:{
            0:{
               items:1
            },
            600:{
               items:3
            },
            1000:{
               items:4
            }
         }
      });
      
         $('.list_videos').owlCarousel({
         items: 4,
         margin:30,
         nav:false,
         dots:false,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
         responsive:{
            0:{
               items:1
            },
            600:{
               items:3
            },
            1000:{
               items:4
            }
         }
      });
       $('.list_partners').owlCarousel({
         items: 6,
         margin:30,
         nav:false,
         dots:false,
         autoplay:true,
         autoplayTimeout:4000,
         smartSpeed:1000,
        
         responsive:{
            0:{
               items:2
            },
            600:{
               items:4
            },
            1000:{
               items:6
            }
         }
      });
      
   // creat menu sidebar
   $(".menu-bar-lv-1").each(function(){
   	$(this).find(".span-lv-1").click(function(){
   		$(this).toggleClass('rotate-menu');
   		$(this).parent().find(".menu-bar-lv-2").toggle(500);
   	});
   });
   $(".menu-bar-lv-2").each(function(){
   	$(this).find(".span-lv-2").click(function(){
   		$(this).toggleClass('rotate-menu');
   		$(this).parent().find(".menu-bar-lv-3").toggle(500);
   	});
   });
   $(".shadow-open-menu").click(function() {
   	$('.menu-bar-mobile').fadeOut();
   	$(".shadow-open-menu").fadeOut();
   	$(".menu-btn-show").toggleClass("active");
   });
   $(".menu-btn-show").click(function() {
   	$(this).toggleClass("active");
   	$('.menu-bar-mobile').fadeToggle(500);
   	$(".shadow-open-menu").fadeToggle(500);
   });
   $(".categories-menu").each(function(){
   	$(this).find(".fa-minus").click(function(){
   		$(this).toggleClass("fa-plus");
   		$(this).parent().parent().find(".group-check-box").toggleClass("active");
   	});
   });
   $('.slider_related').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      dots:false,
      infinite: false,
      responsive: [
      {
         breakpoint: 500,
         settings: {
            slidesToShow: 1,
            slidesToScroll: 1
         }
      },
      {
         breakpoint: 767,
         settings: {
            slidesToShow: 2,
            slidesToScroll: 1
         }
      },
      {
         breakpoint: 992,
         settings: {
            slidesToShow: 4,
            slidesToScroll: 1
         }
      },
      {
         breakpoint: 1920,
         settings: {
            slidesToShow: 4,
            slidesToScroll: 1
         }
      }
      ]
   });
$('.owl-img-feedback').owlCarousel({
         autoplay: false,
         center: true,
         loop: true,
         nav: false,
         items:3,
         mouseDrag: false, 
         touchDrag: false,
         pullDrag: false,
         freeDrag: false,
      });
      $('.text_').owlCarousel({
         nav: false,
         dots: false, 
         items: 1,
         animateOut: 'fadeOut',
         animateIn: 'fadeIn',
         mouseDrag: false, 
         touchDrag: false,
         pullDrag: false,
         freeDrag: false,
      });
      $('.owl-caption-feedback').owlCarousel({
         nav: false,
         dots: false, 
         items: 1,
         animateOut: 'fadeOut',
         animateIn: 'fadeIn',
         mouseDrag: false, 
         touchDrag: false,
         pullDrag: false,
         freeDrag: false,
      });
   setTimeout(function(){ $( ".load_home" ).remove(); }, 2000);
    
    
   // const button = document.querySelector('.effects_button')
   // function materializeEffect(event){
   // 	const circle = document.createElement('div')
   // 	const x = event.layerX
   // 	const y = event.layerY
   // 	circle.classList.add('circle')
   // 	circle.style.left = `${x}px`
   // 	circle.style.top = `${y}px`
   // 	this.appendChild(circle)
   // }

   // button.addEventListener('click', materializeEffect)

});