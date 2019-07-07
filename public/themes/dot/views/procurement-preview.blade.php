@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
            <a href="index.php">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('menu_procurement_news')}}</span>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="col-xs-12 head_cshare_bgblue headnews_bgblue">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 head_cshare_detail">
                        <hgroup>
                            <h2>{{__('menu_procurement_news')}}</h2>
                            <h1>Purchase news</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 procurement_preview_head">
                <h1>ประกาศประกวดราคาจ้างซ่อมแซมบำรุงรักษาเครื่องคอมพิวเตอร์แม่ข้ายข อุปกรณ์เครือข่ายและคอมพิวเตอร์ลูกข่าย ประจำปีงบประมาณ พ.ศ. 2562 ด้วยวิธีประกวดราคาอิเล็กทรอนิกส์ (E-BIDDING)</h1>
                <div class="wrap_share">
                    <div class="viewno">124</div><div class="contentdate">28.09.2018</div><span></span><a class="btn_like" href="#"><img src="images/content_sharing_facebook.png"><span>230</span></a><a href="#"><img src="images/content_sharing_tweet.png"></a><a href="#"><img src="images/content_sharing_pinit.png"></a><a href="#"><img src="images/content_sharing_gplusshare.png"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 img_pcm_preview">
                <img src="images/pdf_preview.jpg">
            </div>
            <div class="col-xs-12 wrap_pcm_preview_download">
                <a href="#">{{__('download_documents')}} 1</a><a href="#">{{__('download_documents')}} 2</a><a href="#">{{__('download_documents')}} 3</a>
            </div>
        </div>
    </div>
</section>
@endsection