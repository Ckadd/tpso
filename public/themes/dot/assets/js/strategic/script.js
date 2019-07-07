$(window).on( "load", function() {
    // The slider being synced must be initialized first
    $('#carousel').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      itemWidth: 180,
      itemMargin: 15,
      asNavFor: '#slider',
      minItems: 3,
      maxItems: 3
    });
   
    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      directionNav: false,
      animationLoop: false,
      slideshow: true,
      sync: "#carousel"
    });
  });    
  
  
  $( document ).ready(function() {
      $('.tab_item').click(function (event) {
        if (  $( this ).siblings('.tab_detail').is( ":hidden" ) ) {
              var tbox = $(this);
              $('.tab_item').removeClass('active');
              $(this).addClass("active");
              $('.tab_detail').slideUp();
              $( this ).siblings('.tab_detail').slideDown({
              complete: function(){
                      $("html, body").animate({ scrollTop: $( tbox ).offset().top - 10 }, 1000);
                  }
              });
        } else {
            $('.tab_item').removeClass('active');
            $('.tab_detail').slideUp();
        }
        event.stopPropagation();
      });
  
      $('.detail_career').click(function (event) {
          event.stopPropagation();
      });
      $('.owl-news').on('initialized.owl.carousel', function(event){ 
          $(".dotmaster").trigger("update.dot");
      });
      $(".owl-news").owlCarousel({
          loop:false,
          margin:20,
          nav:false,
          dots:false,
          autoplay:false,
          autoplayTimeout:6000,
          slideBy: 1,
          responsive:{
              0:{
                  items:1,
                  margin:15,
                  //slideBy: 3
              },
              500:{
                  items:2
              },
              768:{
                  margin:20,
                  items:3
              },
              992:{
                  margin:40,
                  items:4
              },
              1025:{
                  margin:60,
                  items:4
              }
          }
      });
    $('title').text('ยุทธศาสตร์');
  });
  
  