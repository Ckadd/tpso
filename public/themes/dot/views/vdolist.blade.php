@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('event_calendar')}}</span>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="col-xs-12 head_cshare_bgblue headnews_bgblue">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 head_cshare_detail headvdo">
                        <hgroup>
                            <h2>{{__('menu_travel_tips')}}</h2>
                            <h1>INTERESTING</h1>
                            <h3>FACTS ABOUT TOURISM</h3>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row hilight_calendar hilight_vdo">
            <figure class="col-xs-12 col-sm-6">
                <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
            </figure>
            <figcaption class="col-xs-12 col-sm-6">
                <div class="hlc_date">28<span>September<br>2018</span></div>
                <h1>สื่อประชาสัมพันธ์ เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ/ภาคกลาง/ภาคใต้/ภาคตะวันออกเฉียงเหนือ</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
Lorem Ipsum has been the industry's standard dummy text ever since the 
1500s, when anunknown printer took a galley.
                </p>
                <div class="wrap_share">
                    <div class="contentdate">28.09.2018</div><span></span><a class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook.png') }}"><span>230</span></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}"></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}"></a>
                </div>
            </figcaption>
        </div>
        <div class="row row_item_calendar">
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">รายละเอียด</a>
                </figcaption>
            </div>
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">รายละเอียด</a>
                </figcaption>
            </div>
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">รายละเอียด</a>
                </figcaption>
            </div>
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">รายละเอียด</a>
                </figcaption>
            </div>
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">รายละเอียด</a>
                </figcaption>
            </div>
            <div class="col-xs-12 col-sm-4 item_calendar item_video">
                <figure>
                    <a href="https://www.youtube.com/embed/sUp7sgx7wHM" class="fancybox fancybox.iframe"><img src="{{ ThemeService::path('assets/images/vdolist_img.jpg') }}"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">เจ้าบ้านที่ดีสำหรับเยาวชน ภาคเหนือ</h1>
                    <h5>23-10-2061- 26-10-2061</h5>
                    <a href="#" class="btnmore">{{__('detail')}}</a>
                </figcaption>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">{{__('previous')}}</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">{{__('next')}}</span>
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){    
    $( '.select_calendar span' ).click(function (event) {
	  if (  $( this ).siblings('ul').is( ":hidden" ) ) {
            $('.select_calendar').children('ul').slideUp();
            $( this ).siblings('ul').slideDown();
	  } else {
          $('.select_calendar').children('ul').slideUp();
	  }
        event.stopPropagation();
	});
    $( '.select_calendar ul li' ).click(function (event) {
        var textselect = $(this).text();    
        $(this).parent('ul').siblings('span').text(textselect);
        $('.select_calendar').children('ul').slideUp();
	  event.stopPropagation();
	});
    $( "html" ).click(function (event) {
         $('.select_calendar').children('ul').slideUp();
	});
});
</script>   
@endpush
