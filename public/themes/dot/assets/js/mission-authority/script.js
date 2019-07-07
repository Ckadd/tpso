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

  $(document).ready(function(){
      console.log('theme-dot-nut');
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

    $('title').text('ภารกิจและอำนาจหน้าที่');
    /**
     * script js share social
     */
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
});