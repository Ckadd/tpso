@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">{{__('knowledge_about_tourism')}}</a><div>
                <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('menu_mission_and_authority')}}</span>
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
                            <h2>{{__('menu_mission_and_authority')}}</h2>
                            <h1>MISSION AUTHORITY</h1>
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
                <h1>{{$alldata[0]['title'] ?? ''}}</h1>
                @if(!empty($alldata))
                <div class="wrap_share">
                    <div class="viewno">{{$countView ?? 0}}</div><div class="contentdate">{{$alldata[0]['datetime'] ?? ''}}</div><span></span><a class="btn_like" href="{{route('missionAuthority.share.facebook',['id' => $alldata[0]['id'] ])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook.png') }}"><span>{{$logSocial['social']['facebook'] ?? 0}}</span></a><a class="btn_like" href="{{route('missionAuthority.share.twitter',['id' => $alldata[0]['id'] ])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span>{{$logSocial['social']['twitter'] ?? 0}}</span></a><a style="display:none;" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}"></a><a class="btn_like" href="{{route('missionAuthority.share.gplus',['id' => $alldata[0]['id'] ])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}"><span>{{$logSocial['social']['googleplus'] ?? 0}}</span></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 wrap_news_slide">
                @if(!empty($alldata))
                <div id="slider" class="flexslider">
                    <ul class="slides">
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    </ul>
                </div>
                <div id="carousel" class="flexslider">
                    <ul class="slides">
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    <li>
                        <img src="{{ asset('storage/'. $alldata[0]['image']) ??  ''}}" />
                    </li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-6 wrap_news_detail">
                {!! $alldata[0]['short_description'] ?? '' !!}
                {!! $alldata[0]['full_description'] ?? '' !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ ThemeService::path('assets/js/mission-authority/script.js') }}"></script>
@endpush