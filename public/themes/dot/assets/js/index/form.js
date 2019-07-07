$(window).on("load resize",function(){
    var offsetctn = $('.container').offset();
    var innomechw = $('.innomech').width();
    $('.bg_innomech > span, .bg_news > span').css('width', offsetctn.left + innomechw );
    
    var blogh = $('.padding_blog .home_head').outerHeight() + $('.blog_item img').outerHeight() + 80;
    $('.bg_blog > span').css('height', blogh );
});

// function
$(function(){
  SyntaxHighlighter.all();
});
$(window).on( "load", function() {
  $('.flexslider').flexslider({
	animation: "slide",
    controlNav: false,
	start: function(slider){
        $(".dotmaster").trigger("update.dot");
	}
  });
});

$(document).ready(function(){
    $(".owl-service").on('changed.owl.carousel initialized.owl.carousel', function(event) {
        $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last');
        $(".dotmaster").trigger("update.dot");
    }).owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/images/chevron_leftgrey.png'>","<img src='"+asset_path+"/images/chevron_rightgrey.png'>"],
        nav:true,
        dots:false,
        autoplay:false,
        autoplayTimeout:5000,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:15,
                //slideBy: 3
            },
            500:{
                items:2
            },
            768:{
                margin:25,
                items:2
            },
            992:{
                margin:20,
                items:3
            },
            1025:{
                margin:25,
                items:4
            }
        }
    });
    
    $(".owl-interesting").owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/images/chevron_left.png'>","<img src='"+asset_path+"/images/chevron_right.png'>"],
        nav:true,
        dots:false,
        autoplay:false,
        autoplayTimeout:5000,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:15,
                //slideBy: 3
            },
            500:{
                items:2
            },
            768:{
                margin:20,
                items:2
            },
            992:{
                margin:10,
                items:3
            },
            1025:{
                margin:15,
                items:3
            }
        }
    });
    
    $(".owl-relatedlink").owlCarousel({
        loop:false,
        //margin:20,
        //navText: ["<img src='images/chevron_left.png'>","<img src='images/chevron_right.png'>"],
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        slideBy: 1,
        responsive:{
            0:{
                items:4,
                margin:25,
                //slideBy: 3
            },
            500:{
                items:2
            },
            768:{
                margin:5,
                items:3
            },
            992:{
                margin:8,
                items:4
            },
            1025:{
                margin:8,
                items:4
            }
        }
    });
    
    $(".owl-internaldepartment").owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/images/idarrowprev.jpg'>","<img src='"+asset_path+"/images/idarrownext.jpg'>"],
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:timeOutBanner,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:15,
                nav:false
                //slideBy: 3
            },
            500:{
                items:2
            },
            768:{
                margin:5,
                items:2
            },
            992:{
                margin:5,
                items:2
            },
            1025:{
                margin:8,
                items:2
            }
        }
    });
    
    $(".owl-external").owlCarousel({
        loop:true,
        //margin:20,
        //navText: ["<img src='images/chevron_left.png'>","<img src='images/chevron_right.png'>"],
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:timeOutBanner,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:15
                //slideBy: 3
            },
            1025:{
                items:1,
                margin:0,
            }
        }
    });
    
    $('.play').on('click',function(){
        $('.owl-banner').trigger('play.owl.autoplay',[4000])
    })
    $('.stop').on('click',function(){
        $('.owl-banner').trigger('stop.owl.autoplay')
    })
    
    $(".owl-banner").owlCarousel({
        loop:true,
        margin:0,
        autoplayHoverPause:true,
        nav:true,
        dots:true,
        autoplay:true,
        autoplayTimeout:4000,
        //slideBy: 3,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                margin:0,
                slideBy: 1
            }
        }
    });
    
    $(".owl-hilightinterest").owlCarousel({
        loop:true,
        margin:0,
        autoplayHoverPause:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        //slideBy: 3,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                margin:0,
                slideBy: 1
            }
        }
    });
    
    $(".owl-newsmobile").owlCarousel({
        loop:true,
        margin:0,
        autoplayHoverPause:true,
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        //slideBy: 3,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                margin:0,
                slideBy: 1
            }
        }
    });
    
    $( '.wrap_play_stop' ).click(function (event) {
        $(this).toggleClass('active');
        event.stopPropagation();
    });
    
    var ctnm = $('.container').offset().left;
    $('.owl-banner .owl-stage-outer').css('right', -ctnm);
    var osw = $('.owl-service').width() + ctnm;
    $('.owl-service').css('width', osw);
    $('.owl-service').trigger('refresh.owl.carousel');
    

    $( '.service_desktop .item_service' ).click(function (event) {
        var idservice = $(this).attr('rel');
	  if (  $( ".service_desktop .service_tab."+idservice ).is( ":hidden" ) ) {
            $(".service_desktop .item_service").removeClass("tabactive");
            $(this).addClass("tabactive");
            $('.owl-service').trigger('to.owl.carousel', $(this).parent('.owl-item').index()+1);
          if (Modernizr.mq('(max-width: 767px)')) {
            $(".service_desktop .service_tab").slideUp();
            $(".service_desktop .service_tab."+idservice).slideDown(800);
          } else{
            $(".service_desktop .service_tab").hide();
            $(".service_desktop .service_tab."+idservice).fadeIn(800); 
          }
          $(".dotmaster").trigger("update.dot");
	  } else {
          
	  }
	  event.stopPropagation();
    });
    
    $( '.service_mobile .item_service' ).click(function (event) {
        var idservicemobile = $(this).attr('rel');
	  if (  $( ".service_mobile .service_tab."+idservicemobile ).is( ":hidden" ) ) {
            $(".service_mobile .item_service").removeClass("tabactive");
            $(this).addClass("tabactive");
            $(".service_mobile .service_tab").slideUp();
            $(".service_mobile .service_tab."+idservicemobile).slideDown(800);
          $(".dotmaster").trigger("update.dot");
	  } else {
            $(".service_mobile .service_tab").slideUp();
            $(".service_mobile .item_service").removeClass("tabactive");
	  }
	  event.stopPropagation();
    });
    
    $( '.news_tab a' ).click(function (event) {
        var idnews = $(this).attr('href');
	  if (  $( ".content_news"+idnews ).is( ":hidden" ) ) {
            $(".news_tab a").removeClass("active");
            $(".content_news").hide();
            $(this).addClass("active");
            $(".content_news"+idnews).fadeIn(800);
            $(".dotmaster").trigger("update.dot");
	  } else {
	  }
	  event.preventDefault();
    });

    // $('button.btn_newsletter').click(function(){
    //     if($('#footer-alert').not('.alert-hide')) {
    //         $('#footer-alert').addClass('alert-hide');
    //     }
        
    //     var newletter = $('input[name="newletter"]').val();
    //     var url = $('input[name="newletter"]').data('url');

    //     console.log(newletter);
    //     $.ajax({
    //         type:'GET',
    //         url:url,
    //         data:{newLetter:newletter},
    //         success:function(msg){
    //           console.log(msg);
    //           if(msg=="success") {
    //             $('input[name="newletter"]').val('');
                
    //             $('#footer-alert').removeClass('alert-hide');
    //           }
    //         }
    //     });
    // });

    $('select.licenseSelect').change(function() {
        var textLisense = $('select.licenseSelect option:selected').text();
        
        if(textLisense == 'ใบอนุญาตมัคคุเทศก') {
            $('#formLisence').attr('action','http://103.80.100.92:8087/mobiletourguide/info/license/guide/read');
            $('input[name="searchType"]').val('G');
        }else if(textLisense == 'ใบอนุญาตผู้นำเที่ยว') {
            $('#formLisence').attr('action','http://103.80.100.92:8087/mobiletourguide/info/license/leader/read');
            $('input[name="searchType"]').val('TL');
        }else{
            $('#formLisence').attr('action','http://103.80.100.92:8087/mobiletourguide/info/license/tour/read');
            $('input[name="searchType"]').val('T');
        }
    });
    
    for(let indexBannerDot = 0; indexBannerDot < 3; indexBannerDot++) {
        
        let bannerLink = $('.bannerDot'+indexBannerDot + ' a').attr('href');

        // not use
        let bannerSrc = $('.bannerDot'+indexBannerDot + ' img').attr('src');
        
        if( (bannerLink == "#") ) {
            
            $('.bannerDot'+indexBannerDot).addClass('service_nophoto');
        }
    }
    
});
