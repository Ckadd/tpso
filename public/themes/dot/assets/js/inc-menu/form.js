$(document).ready(function(){    
    $( '.btn_menu' ).click(function (event) {
	  if (  $( ".mainmenu > ul" ).is( ":hidden" ) ) {
            $(this).addClass("active");
            $('.mainmenu > ul').slideDown();
	  } else {
          $('.mainmenu > ul').slideUp();
          $(this).removeClass("active");
          $('.submenu').slideUp();
          $('.hassub').removeClass("active");
	  }
	  event.stopPropagation();
	});
    
    $( '.link_search' ).click(function (event) {
	  if (  $( ".search_box" ).is( ":hidden" ) ) {
            $('.search_box').slideDown();
	  } else {
          $('.search_box').slideUp();
	  }
	  event.stopPropagation();
	});
    
    $( '.btn_close' ).click(function (event) {
             $('.search_box').slideUp();
	  event.stopPropagation();
	});
    
    $( '.search_box' ).click(function (event) {
	  event.stopPropagation();
	});
    
    $('.hassub').click(function (event) {
	    if (  $(this).children( ".submenu" ).is( ":hidden" ) ) {
            $('.hassub').removeClass("active");
            $(this).addClass("active");
            $('.submenu').slideUp();
            $(this).children( ".submenu" ).slideDown();
        } else {
            
            if (Modernizr.mq('(max-width: 991px)')) {
                $('.submenu').slideUp();
                $(this).removeClass("active");
            }
        }
	  event.stopPropagation();
    });
    
    
    $( '.search_btn' ).click(function (event) {
        $('.searchbox').toggleClass('active');
        $('.top_bar').toggleClass('active');
        event.stopPropagation();
	});
    
    $( '.searchbox' ).click(function (event) {
        event.stopPropagation();
	});
    
     $( 'html' ).click(function (event) {
        $('.searchbox').removeClass('active');
        $('.top_bar').removeClass('active');
	});
    
    $( '.fontsize_s' ).click(function (event) {
        $('html').removeClass('fz_l');
        $('html').addClass('fz_s');
	});
    $( '.fontsize_m' ).click(function (event) {
        $('html').removeClass('fz_l fz_s');
	});
    $( '.fontsize_l' ).click(function (event) {
        $('html').removeClass('fz_s');
        $('html').addClass('fz_l');
	});
    
    $( '.wrap_select_item div' ).click(function (event) {
          $(".wrap_select_item div").removeClass("active");
          $(this).addClass("active");
	});
    
    $( '.wrap_top_select' ).click(function (event) {
	  if (  $( this ).children('.wrap_select_item').is( ":hidden" ) ) {
            $(this).addClass("active");
            $('.wrap_select_item').slideUp();
            $( this ).children('.wrap_select_item').slideDown();
	  } else {
          $(this).removeClass("active");
          $('.wrap_select_item').slideUp();
	  }
	  event.stopPropagation();
	});
    
    $( "html" ).click(function (event) {
             $('.search_box').slideUp();
    });
    
    $('.mainmenu li.dropdown > a').click(function(e){
        $(this).next('ul').slideToggle();
        e.stopPropagation();
        e.preventDefault();
    });
    
    
    

    // submenu internal
    $('a[href*="/internal-department"]').parent().addClass('hassub');
    
    $('.mainmenu .hassub > a').click(function(e){
        $('li.hassub > .submenu').slideToggle();
        e.stopPropagation();
        e.preventDefault();
    });
    $('.hassub > a').hover(function(){
        $(this).next('ul').css('display','none');
    });
    $('.hassub > a').click(function(){
        $(this).next('ul').css('display','none');
    });
    
    $('.submenu_mid > ul').addClass('submenu_mid_list');
    var clone_menusub = $('.clone-submenu').html();
    $('.hassub').append($(clone_menusub));
    $('li.dropdown').removeClass('active');

// new css scroll
    if ($(this).scrollTop() > 50){  
        $('.mainnavbar').addClass("sticky");
        $('body').css('padding-top',$('.mainnavbar').outerHeight());
    }

    $( '.lang' ).click(function (event) {
        //alert($(this).data("id"));
        window.location = $(this).data("id");
    });


    // business
    $( '.default' ).click(function (event) {
        $('body').removeClass('blackwhite blackyellow');
        // $('link[title="blackwhite"]').attr('disabled', 'disabled');
        // $('link[title="blackyellow"]').attr('disabled', 'disabled');
	});
    $( '.blackwhite' ).click(function (event) {
        $('body').removeClass('blackyellow');
        $('body').addClass('blackwhite');
        // $('link[title="blackwhite"]').removeAttr('disabled');
        // $('link[title="blackyellow"]').attr('disabled', 'disabled');
	});
    $( '.blackyellow' ).click(function (event) {
        $('body').removeClass('blackwhite');
        $('body').addClass('blackyellow');
        // $('link[title="blackwhite"]').attr('disabled', 'disabled');
        // $('link[title="blackyellow"]').removeAttr('disabled');
	});

});

$(window).scroll(function() {
    $('nav.sticky').css('visibility','visible');
    if ($(this).scrollTop() > 50){  
        $('.mainnavbar').addClass("sticky");
        $('body').css('padding-top',$('.mainnavbar').outerHeight());
    }
    else{
        $('.mainnavbar').removeClass("sticky");
        $('body').css('padding-top','0px');
    }
});
