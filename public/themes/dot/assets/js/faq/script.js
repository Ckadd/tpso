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

    $(".download-pdf").click(function(){
        var id = $(this).data('id');
        var url = $('input[name="url-download"]').val();

        $.ajax({
            type:'GET',
            url:url,
            data:{id:id},
            success:function(msg){
            }
        });
    });

    var id;
    $(".btn-sentmail").click(function(){
        id  = $(this).data('idmail');
        $("#modal-newletter-ask").modal('show');
    });

    $("#modal-ok").click(function(){
        var url = $(this).data('url');
        var email = $('input[name="email"]').val();
        $.ajax({
            type:'GET',
            url:url,
            data:{id:id,email:email},
            success:function(msg){
                if(msg == "success") {
                    console.log(msg);
                    $("#modal-Success").find('h3').text('ส่งข้อมูลถามตอบเสร็จสิ้น');
                    $("#modal-newletter-ask").hide();
                    $("#modal-Success").modal('show');
                    $("#modaluccess").click(function(){
                        window.location.reload();
                    });
                }
            }
        });
    });
    

    // select option
}); 