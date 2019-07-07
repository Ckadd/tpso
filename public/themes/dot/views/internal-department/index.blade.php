@extends('layouts-internal.app-revise')
@push('css')
    <style>
        .owl-theme .owl-nav [class*=owl-]{
            position: absolute;
            top: 50%;
            -ms-transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }
        .owl-carousel .owl-nav button.owl-next{
            right: -50px;
        }
        .owl-carousel .owl-nav button.owl-prev{
            left: -50px;
        }
        .owl-theme .owl-nav [class*=owl-]:hover{
            background-color: transparent;
        }
        .owl-theme .owl-nav [class*=owl-]:focus{
            outline: 0;
        }
        .owl-service.owl-carousel .owl-nav button.owl-next{
            right: -40px;
        }
        .owl-service.owl-carousel .owl-nav button.owl-prev{
            left: -40px;
        }
        
@media (max-width: 767px){
    .owl-carousel .owl-nav button.owl-next{
            right: -25px;
        }
        .owl-carousel .owl-nav button.owl-prev{
            left: -25px;
        }   
}
</style>
@endpush 
@section('content')
    @if(!empty($department))
        {!! $department[0]['full_description'] ?? '' !!}
    @endif
@endsection 
@push('scripts')
<script>

$(document).ready(function(){   
    
    $( '.mobile_sidebar .btn_menusb' ).click(function (event) {
	  if (  $( ".mobile_sidebar .sidebar" ).is( ":hidden" ) ) {
            $(this).addClass("active");
            $('.mobile_sidebar .sidebar').slideDown();
	  } else {
          $('.mobile_sidebar .sidebar').slideUp();
          $(this).removeClass("active");
	  }
	  event.stopPropagation();
	});
    
    $( '.sb_hassub a' ).click(function (event) {
	  if (  $( this ).next('.sb_sub').is( ":hidden" ) ) {
            $('.sb_sub').slideUp();
            $( this ).next('.sb_sub').slideDown();
            $('.sb_hassub').removeClass("active");
            $(this).parent('.sb_hassub').addClass("active");
	  } else {
          $('.sb_sub').slideUp();
          $('.sb_hassub').removeClass("active");
	  }
	  event.preventDefault();
	});
    
    
});
</script>


<script type="text/javascript">
$(function(){
  SyntaxHighlighter.all();
});
$(window).on( "load", function() {
  $('.flexbanner').flexslider({
	animation: "slide",
    controlNav: true,
    directionNav: false,
	start: function(slider){
        $(".dotmaster").trigger("update.dot");
        var ostsidebar = $('.secot').offset().top;
        $(window).scroll(function() {
            if ($(this).scrollTop() > ostsidebar ){ 
                $('.mobile_sidebar').addClass("sticky");
            } else{
                $('.mobile_sidebar').removeClass("sticky");
            }
        });
        
        if ($(this).scrollTop() > ostsidebar ){  
            $('.mobile_sidebar').addClass("sticky");
        }
	}
  });
});
</script>
    
<script>
var asset_path = "{{ ThemeService::path('assets/internal-images') }}";

$(document).ready(function(){
    
    $(".owl-service").owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/arprev.png'>","<img src='"+asset_path+"/arnext.png'>"],
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:6000,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:10,
                //slideBy: 3
            },
            500:{
                items:3
            },
            768:{
                margin:10,
                items:4
            },
            992:{
                margin:10,
                items:4
            },
            1025:{
                margin:12,
                items:5
            }
        }
    });
    
    $(".owl-relatedlink").owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/arprev.png'>","<img src='"+asset_path+"/arnext.png'>"],
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
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
                margin:10,
                items:2
            },
            992:{
                margin:20,
                items:3
            },
            1025:{
                margin:20,
                items:3
            }
        }
    });
    
    $(".owl-internaldepartment").owlCarousel({
        loop:true,
        //margin:20,
        navText: ["<img src='"+asset_path+"/arprev.png'>","<img src='"+asset_path+"/arnext.png'>"],
        nav:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:4000,
        slideBy: 1,
        responsive:{
            0:{
                items:2,
                margin:15,
                nav:true
                //slideBy: 3
            },
            500:{
                items:2
            },
            768:{
                items:1
            },
            992:{
                items:1
            },
            1025:{
                items:1
            }
        }
    });
    
    $(".owl-newsmanager").on('changed.owl.carousel initialized.owl.carousel', function(event) {
        $(".dotmaster").trigger("update.dot");
    }).owlCarousel({
        loop:true,
        //margin:20,
        //navText: ["<img src='images/idarrowprev.jpg'>","<img src='images/idarrownext.jpg'>"],
        nav:false,
        smartSpeed: 500,
        dots:false,
        autoplay:true,
        autoplayTimeout:6000,
        slideBy: 1,
        responsive:{
            0:{
                items:1
                //slideBy: 3
            },
            500:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:1
            },
            1025:{
                items:1
            }
        }
    });
    
    $(".owl-newsevent").on('changed.owl.carousel initialized.owl.carousel', function(event) {
        $(".dotmaster").trigger("update.dot");
    }).owlCarousel({
        loop:true,
        //margin:20,
        //navText: ["<img src='images/idarrowprev.jpg'>","<img src='images/idarrownext.jpg'>"],
        nav:false,
        dots:false,
        smartSpeed: 500,
        autoplay:true,
        autoplayTimeout:6000,
        slideBy: 1,
        responsive:{
            0:{
                items:1
                //slideBy: 3
            },
            500:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:1
            },
            1025:{
                items:1
            }
        }
    });
    $(".owl-newsannounce").on('changed.owl.carousel initialized.owl.carousel', function(event) {
        $(".dotmaster").trigger("update.dot");
    }).owlCarousel({
        loop:true,
        //margin:20,
        //navText: ["<img src='images/idarrowprev.jpg'>","<img src='images/idarrownext.jpg'>"],
        nav:false,
        dots:false,
        autoplay:true,
        smartSpeed: 500,
        autoplayTimeout:6000,
        slideBy: 1,
        responsive:{
            0:{
                items:1
                //slideBy: 3
            },
            500:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:1
            },
            1025:{
                items:1
            }
        }
    });
});    
</script>
@endpush