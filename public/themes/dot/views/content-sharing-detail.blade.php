@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <!-- <a href="">Home</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">เรื่องหน้ารู้ด้านการท่องเที่ยว</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>ซ่อมแซมที่ทางสร้างสรรค์ที่เที่ยว</span> -->
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="col-xs-12 head_cshare_bgblue">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 head_cshare_detail">
                            <hgroup>
                                <h2>{{__('knowledge_about_tourism')}}</h2>
                                <h1>INTERESTING</h1>
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
                <div class="col-xs-12 csharedetail_head">
                    @if(!empty($dataContentById))
                        <h1>{{$dataContentById[0]['title']}}</h1>
                        <div class="wrap_share">
                            <div class="viewno">{{($dataAllSocial['social']['view']) - 1 ?? 0}}</div><span></span><a class="btn_like" href="{{route('share.social',['id' => $dataContentById[0]['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook_share.png') }}"><span>{{$dataAllSocial['social']['facebook'] ?? 0}}</span></a><a class="btn_like" href="{{route('share.sharetwitter',['id' => $dataContentById[0]['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span>{{$dataAllSocial['social']['twitter'] ?? 0}}</span></a><a style="display:none;" class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}"><span>{{$dataAllSocial['social']['pinit'] ?? 0}}</span></a><a class="btn_like" href="{{route('share.sharegplus',['id' => $dataContentById[0]['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}"><span>{{$dataAllSocial['social']['googleplus'] ?? 0}}</span></a>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($dataContentById))
                    {!! $dataContentById[0]['full_description'] !!}
                    @if(!empty($dataContentById[0]['image']))
                        <img src="{{asset('storage/'.$dataContentById[0]['image'])}}">
                    @endif
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/content-sharing-detail/script.js') }}"></script>
@endpush