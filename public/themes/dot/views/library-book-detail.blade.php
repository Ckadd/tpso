@extends('layouts.app') @section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage"> <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div>
                        <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div> <span>{{__('menu_library_book')}}</span>
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
                                <h2>{{__('menu_library_book')}}</h2>
                                <h1>LIBRARY BOOK</h1>
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
                    <h1>{{$data['title']}}</h1>
                    <div class="wrap_share">
                        <div class="viewno">{{($dataAllSocial['social']['view']) - 1 ?? 0}}</div>
                        <div class="contentdate">28.09.2018</div><span></span>
                        <a class="btn_like" href="{{route('share.social',['id' => $data['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_facebook_share.png') }}">
                            <span>{{$dataAllSocial['social']['facebook'] ?? 0}}</span>
                        </a>
                        <a class="btn_like" href="{{route('share.sharetwitter',['id' => $data['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}">
                            <span>{{$dataAllSocial['social']['twitter'] ?? 0}}</span>
                        </a>
                        <a style="display:none;" class="btn_like" href="#">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}">
                            <span>{{$dataAllSocial['social']['pinit'] ?? 0}}</span>
                        </a>
                        <a class="btn_like" href="{{route('share.sharegplus',['id' => $data['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}">
                            <span>{{$dataAllSocial['social']['googleplus'] ?? 0}}</span>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 csharedetail_content">{!! $data['full_description'] !!}
                @if(!empty($data['image']))
                    <img src="{{asset('storage/'.$data['image'])}}">
                @endif
                </div>
            </div>
        </div>
    </section>@endsection @push('scripts')
    <script src="{{ ThemeService::path('assets/js/law-regulation/script.js') }}"></script>@endpush
