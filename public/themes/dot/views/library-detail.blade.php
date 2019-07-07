@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <a href="#">{{__('knowledge_about_tourism')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <span>{{__('department_of_Tourism_Library')}}</span>
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
                                <h2>{{__('department_of_Tourism_Library')}}</h2>
                                <h1>Library</h1>
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
                    @if(!empty($detail))
                        <h1>{{ $detail['title'] ?? '' }}</h1>
                        <div class="wrap_share">
                            <div class="viewno">{{($logview) - 1 ?? 0}}</div><div class="contentdate">{{$detail['datetime' ?? '']}}</div>
                            <span></span><a class="btn_like" href="{{route('library.share.facebook',['id' => $detail['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_facebook_share.png') }}">
                            <span>{{$logAllSocial['social']['facebook'] ?? 0}}</span></a>
                            <a class="btn_like" href="{{route('library.share.twitter',['id' => $detail['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}">
                            <span>{{$logAllSocial['social']['twitter'] ?? 0}}</span>
                            </a>
                            <a style="display:none;" class="btn_like" href="#">
                                <img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}">
                                <span>0</span>
                                </a>
                                <a class="btn_like" href="{{route('library.share.gplus',['id' => $detail['id']])}}">
                                <img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}">
                                <span>{{$logAllSocial['social']['googleplus'] ?? 0}}</span>
                                </a>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($detail))
                    {!! $detail['full_description'] ?? '' !!}
                    <img src="{{asset('storage/'.$detail['image'])}}">
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/library-detail/script.js') }}"></script>
@endpush