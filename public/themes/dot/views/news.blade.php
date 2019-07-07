@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">เรื่องหน้ารู้ด้านการท่องเที่ยว</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>ซ่อมแซมที่ทางสร้างสรรค์ที่เที่ยว</span>
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
                            <h2>ข่าวผู้บริหาร</h2>
                            <h1>EXECUTIVE NEWS</h1>
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
            <div class="col-xs-12 news_head">
                <h1>ประกาศกำหนดเขตพื้นที่ในท้องถิ่นหรือชุมชน เพื่อให้มัคคุเทศก์ซึ่งได้รับการยกเว้นคุณสมบัติตามมาตรา 51</h1>
                <div class="wrap_share">
                    <div class="viewno">124</div><div class="contentdate">28.09.2018</div><span></span><a class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook.png') }}"><span>230</span></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}"></a><a href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}"></a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 wrap_news_slide">
                <div id="slider" class="flexslider">
                    <ul class="slides">
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    </ul>
                </div>
                <div id="carousel" class="flexslider">
                    <ul class="slides">
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    <li>
                        <img src="{{ ThemeService::path('assets/images/image_text_01.jpg') }}" />
                    </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 wrap_news_detail">
                <h1>ประกาศกำหนดเขตพื้นที่ในท้องถิ่นหรือชุมชน เพื่อให้มัคคุเทศก์ซึ่งได้รับการยกเว้นคุณสมบัติตามมาตรา 51</h1>
                <p>วันพุธที่ 5 กันยายน 2561 เวลา 11.30 นายพงษ์ภาณุ เศวตรุนทร์ ปลัดกระทรวงการ
                ท่องเที่ยวและกีฬา นายอนันต์ วงศ์เบญจรัตน์ อธิบดีกรมการท่องเที่ยว แถลงข่าวต่อ
                สื่อมวลชน การประกาศกำหนดเขตพื้นที่ในท้องถิ่นหรือชุมชน เพื่อให้มัคคุเทศก์ซึ่งได้รับ
                การยกเว้นคุณสมบัติตามมาตรา 51 ทำหน้าที่มัคคุเทศก์ โดยจะมีพื้นที่ในท้องถิ่นหรือ
                ชุมชนเพื่อให้มัคคุเทศก์ซึ่งได้รับการยกเว้นคุณสมบัติทำหน้าที่มัคคุเทศก์ รวมจำนวน 
                26 พื้นที่ เพื่อตระหนักถึงความสำคัญในการพัฒนาชุมชนให้มีมาตราฐานด้านการท่องเที่ยว เพื่อสร้างความเชื่อมั่นจากนักท่องเที่ยวและดำรงอัตลักษณ์ของชุมชน อย่างยั่งยืนอย่างแท้จริง 
                ณ ห้องประชุม 1 ชั้น 2 กระทรวงการท่องเที่ยวและกีฬา

                    </p>
            </div>
        </div>
    </div>
</section>
<section class="row bg_related_content wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 head_related_content">
                <h1>RELATED CONTENT</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-news owl-carousel owl-theme">
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related01.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมแนวทางการจัดระเบียน และแก้ไขปัญหา...</h4>
                                <p class="dotmaster">สนช. ได้ดำเนินการพัฒนางานวิจัยที่ได้รับ
การสนับสนุนจากหน่วยงานหลักของประเทศ 
สำนักงานคณะกรรมการ...</p>
                            </figcaption>
                            <a href="#" class="btnmore">อ่านต่อ</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related02.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...</h4>
                                <p class="dotmaster">เป็นการบูรณาการความร่วมมือของหน่วยงาน
สังกัดกระทรวงวิทยาศาสตร์และเทคโนโลยี 
เพื่อสนับสนุนการพัฒนา...</p>
                            </figcaption>
                            <a href="#" class="btnmore">อ่านต่อ</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related03.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...
</h4>
                                <p class="dotmaster">สนช. มุ่งสร้างความสามารถทางนวัตกรรม 
(Innovation Capability) ของนวัตกร ผู้ประกอบ
การนวัตกรรม ...</p>
                            </figcaption>
                            <a href="#" class="btnmore">อ่านต่อ</a>
                        </figure>
                    </div>
                    <div>
                        <figure class="detail_news_item"><a href="#"><img src="{{ ThemeService::path('assets/images/related04.jpg') }}"></a>
                            <figcaption>
                                <h4 class="dotmaster">การประชุมเพื่อพิจารณามาตรการ
และแนวทางรักษา...</h4>
                                <p class="dotmaster">สนช. มุ่งประยุกต์ใช้วิทยาศาสตร์ข้อมูล 
(Data Science) ในการดึงเอาความรู้ออก
จากข้อมูล วิเคราะห์...</p>
                            </figcaption>
                            <a href="#" class="btnmore">อ่านต่อ</a>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ ThemeService::path('assets/js/news/form.js') }}"></script>
@endpush