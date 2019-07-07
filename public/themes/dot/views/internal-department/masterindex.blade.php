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
        .btn-new-readAll {
            float:right;
            margin-top:20px;
            background-color:#132f70; 
            color:white;
        }
        .btn-new-readAll:hover {
            color:white;
            text-decoration: underline;
            text-decoration-color: white;
        }
@media (max-width: 991px){
    .btn-new-readAll {
        margin-top: 10px;
    }

}
@media (max-width: 767px){
.owl-carousel .owl-nav button.owl-next{
        right: -25px;
    }
    .owl-carousel .owl-nav button.owl-prev{
        left: -25px;
    }   
}
@media (max-width: 414px) {
    .btn-new-readAll {
        margin-top: -1px;
    }
}

@media (max-width: 320px) {
    .btn-new-readAll {
        margin-top: -34px;
    }
}
</style>
@endpush 
@section('content')
<div class="container-fluid">
    <section class="row wow fadeInDown">
        <div class="col-xs-12 banner_slide">
            <div class="flexslider flexbanner">
                <ul class="slides">
                @if(!empty($gallery))
                @foreach($gallery as $keyGallery => $valueGallery)
                <li>
                    @if(!empty($valueGallery['image']))
                    <a href="{{ $valueGallery['link_url'] ?? '#' }}">
                    <img class="img_desktop" src="{{ asset('storage/'.$valueGallery['image']) }}" />
                    <img class="img_mobile" src="{{ asset('storage/'.$valueGallery['image']) }}" /></a>
                    @else
                    <img class="img_desktop" src="{{ ThemeService::path('assets/internal-images/banner01.jpg') }}" />
                    <img class="img_mobile" src="{{ ThemeService::path('assets/internal-images/banner_mobile.jpg') }}" />
                    @endif
                    <div class="banner_caption">
                        <div class="container">
                            <hgroup>
                                <h1>{{ $valueGallery['caption'] ?? '' }}</h1>
                            </hgroup>
                            <!-- <a href="#">DETAIL</a> -->
                        </div>
                    </div>
                </li>
                @endforeach
                @else
                <img class="img_desktop" src="{{ ThemeService::path('assets/images/default_img.png') }}" />
                @endif
              </ul>
            </div>
        </div>
    </section>
    <section class="row mobile_sidebar">@include('layouts-internal.inc-sidebar')</section>
    <section class="row wow fadeInDown secot">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3 wrap_sidebar">
                @include('layouts-internal.inc-sidebar')
                </div>
                <div class="col-xs-12 col-md-9">
                    <h1 class="headindex" style="display:inline;">ข่าวสารประชาสัมพันธ์ของหน่วยงาน</h1>
                    @if(!empty($idDepartMent))
                        <a href="{{route('new.inform.departmet',['id'=>$idDepartMent])}}" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @else
                        <a href="#" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @endif
                    <div class="row">
                        <div class="col-xs-12 col-md-6 wrap_newshilight">
                            <div class="owl-newsannounce owl-carousel owl-theme">
                            

                                    @php $i=0; @endphp
                                    @while($i < 3)
                                        <figure class="item_newsannounce">
                                            @if(!empty($newPressRelease[$i]['cover_image']))
                                            <a href="{{route('news.inform.detail',['id'=>$newPressRelease[$i]['id']])}}"><img src="{{ asset('storage/'.$newPressRelease[$i]['cover_image']) }}"></a>
                                            @else
                                            <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                                            @endif
                                            @if(!empty($newPressRelease[$i]))
                                            <figcaption>
                                            @php $date = explode(" ",$newPressRelease[$i]['datetime']); @endphp
                                                <p class="dotmaster">{{$newPressRelease[$i]['short_description'] ?? ไม่มีข้อมูล}}</p>
                                                <div class="newsannounce_date">{{$date[0]}}<a href="{{route('news.inform.detail',['id'=>$newPressRelease[$i]['id']])}}">อ่านต่อ</a></div>
                                            </figcaption>
                                            @else
                                            <figcaption>
                                                <p class="dotmaster">ไม่มีข้อมูล</p>
                                                <div class="newsannounce_date">ไม่มีข้อมูล</div>
                                            </figcaption>
                                            @endif
                                        </figure>
                                        @php $i++ @endphp
                                    @endwhile
                                
                                 
                            </div>
                        </div>
                        

                        @php $i=3; @endphp
                        @while($i < 5)
                        <div class="col-xs-6 col-md-3 wrap_newsannounce">
                            <figure class="item_newsannounce">
                                @if(!empty($newPressRelease[$i]['cover_image']))
                                <a href="{{route('news.inform.detail',['id'=>$newPressRelease[$i]['id']])}}"><img src="{{ asset('storage/'.$newPressRelease[$i]['cover_image']) }}"></a>
                                @else
                                <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>                                
                                @endif
                                @if(!empty($newPressRelease[$i]))
                                @php $date = explode(" ",$newPressRelease[$i]['datetime']); @endphp
                                 <figcaption>
                                     <p class="dotmaster">{{$newPressRelease[$i]['short_description'] ?? ไม่มีข้อมูล}}</p>
                                     <div class="newsannounce_date">{{$date[0]}}<a href="{{route('news.inform.detail',['id'=>$newPressRelease[$i]['id']])}}">อ่านต่อ</a></div>
                                 </figcaption>
                                @else
                                <figcaption>
                                     <p class="dotmaster">ไม่มีข้อมูล</p>
                                     <div class="newsannounce_date">ไม่มีข้อมูล</div>
                                 </figcaption>
                                 @endif
                             </figure>
                        </div>
                        @php $i++ @endphp
                        @endwhile
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container">
            <div class="row">
            @if(Session::has('msg'))
                <div class="alert alert-danger">
                    {{Session::get('msg')}}
                </div>
            @endif
                <div class="col-xs-12 wrap_announce">
                    <h1 class="headindex" style="display:inline;">ข่าวหน่วยงาน</h1>
                    @if(!empty($idDepartMent))
                    <a href="{{ route('new.institution.departmet',['id'=>$idDepartMent]) }}" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @else
                    <a href="#" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @endif
                    @php $i=0 @endphp
                    @while($i < 5)
                    @if(!empty($announce[$i]['title']))
                    <div class="item_announce">
                        <p class="dotmaster">{{$announce[$i]['title']}}</p><a class="btn_view" href="{{route('news.another.detail',['id'=>$announce[$i]['id']])}}">View</a><a class="btn_download" href="{{route('news.another.download',['id'=>$announce[$i]['id']])}}" target="_blank">Download</a>
                    </div>
                    @else
                    <div class="item_announce">
                        <p class="dotmaster">ไม่มีข้อมูล</p>
                    </div>
                    @endif
                    @php $i++ @endphp
                    @endwhile
                    
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown ovf_news">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 wrap_newsmanager">
                    <h1 class="headindex" style="display:inline;">ข่าวผู้บริหาร</h1>
                    @if(!empty($idDepartMent))
                    <a href="{{ route('new.manager.departmet',['id'=>$idDepartMent]) }}" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @else
                    <a href="#" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @endif
                    <div class="owl-newsmanager owl-carousel owl-theme">
                    
                    @php $i=0 @endphp
                        @while($i < 3)
                         <figure class="item_news">
                                @if(!empty($newManage[$i]['cover_image']))
                                    <a href="{{route('news.manager.detail',['id'=>$newManage[$i]['id']])}}"><img src="{{ asset('storage/'.$newManage[$i]['cover_image']) }}"></a>
                                @else
                                    <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>                                
                                @endif
                            @if(!empty($newManage[$i]))
                             <figcaption>
                                 <p class="dotmaster">{{$newManage[$i]['short_description'] ?? ไม่มีข้อมูล}}</p>
                                 <a href="{{route('news.manager.detail',['id'=>$newManage[$i]['id']])}}">อ่านต่อ...</a>
                             </figcaption>
                             @else
                             <figcaption>
                                 <p class="dotmaster">ไม่มีข้อมูล</p>
                             </figcaption>
                             @endif
                         </figure>
                            @php $i++ @endphp
                        @endwhile
                    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 wrap_newsevent">
                    <h1 class="headindex" style="display:inline;">ข่าวกิจกรรม</h1>
                    @if(!empty($idDepartMent))
                    <a href="{{ route('calendar.departmet',['id'=>$idDepartMent]) }}" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @else
                    <a href="#" class="btn btn-md text-right btn-new-readAll"><span>อ่านข่าวทั้งหมด</span></a>
                    @endif
                    <div class="owl-newsevent owl-carousel owl-theme">
                         
                    @php $i=0 @endphp
                        @while($i < 3)
                         <figure class="item_news">
                                @if(!empty($newActivity[$i]['cover_image']))
                                    <a href="{{route('calendar.detail',['id'=>$newActivity[$i]['id']])}}" target="_blank"><img src="{{ asset('storage/'.$newActivity[$i]['cover_image']) }}"></a>
                                @else
                                    <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>                                
                                @endif
                            @if(!empty($newActivity[$i]))
                             <figcaption>
                                 <p class="dotmaster">{{$newActivity[$i]['title'] ?? ไม่มีข้อมูล}}</p>
                                 <a href="{{route('calendar.detail',['id'=>$newActivity[$i]['id']])}}" target="_blank">อ่านต่อ...</a>
                             </figcaption>
                             @else
                             <figcaption>
                                 <p class="dotmaster">ไม่มีข้อมูล</p>
                             </figcaption>
                             @endif
                         </figure>
                            @php $i++ @endphp
                        @endwhile
                         
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown section_service">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="headindex">บริการ</h1>
                </div>
                <div class="col-xs-12 wrap_service">
                    <div class="owl-service owl-carousel owl-theme">
                    
                        @php $countService = 0; @endphp
                        @while($countService < 5)
                        <div class="item_service">
                            @if(!empty($service[$countService]['image']))
                            <a href="{{$service[$countService]['link']}}" target="_blank"><img src="{{ asset('storage/'.$service[$countService]['image']) }}">
                            @else
                            <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                            @endif
                                <span>{{ $service[$countService]['title'] ?? 'ไม่มีข้อมูล' }}</span>
                             </a>
                        </div>
                        @php $countService++ @endphp
                        @endwhile
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 head_relatelink">
                    <h1 class="headindex">หน่วยงานภายในที่เกี่ยวข้อง</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown bg_relatelink">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9 wrap_relatedlink">
                    <h1>ลิงค์หน่วยงานภายนอกที่เกี่ยวข้อง</h1>

                     <div class="owl-relatedlink owl-carousel owl-theme">
                        @if(!empty($departmentOut))
                        @foreach($departmentOut as $keyBannerOut => $valueBannerOut)
                         <div class="item_relatedlink">
                            @if(!empty($valueBannerOut['image'])) 
                            <a href="{{$valueBannerOut['link_url']}}" target="_blank"><img src="{{ asset('storage/'.$valueBannerOut['image']) }}"></a>
                            @endif
                         </div>
                        @endforeach
                        @endif
                    </div>

                </div>
                <div class="col-xs-12 col-sm-3 wrap_internaldepartment">
                    <h1>ลิงค์หน่วยงานภายใน</h1>
                    <div class="owl-internaldepartment owl-carousel owl-theme">

                        @if(!empty($departmentIn))
                        @foreach($departmentIn as $keyBannerIn => $valueBannerIn)
                         <div class="item_relatedlink">
                            @if(!empty($valueBannerIn['image'])) 
                            <a href="{{$valueBannerIn['link_url']}}"><img src="{{ asset('storage/'.$valueBannerIn['image']) }}"></a>
                            @endif
                         </div>
                        @endforeach
                        @else
                        <div class="item_relatedlink">
                            <a href="#"><img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                         </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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
	//   event.preventDefault();
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
        loop:false,
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
        loop:false,
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
        loop:false,
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
        loop:false,
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
        loop:false,
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
        loop:false,
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