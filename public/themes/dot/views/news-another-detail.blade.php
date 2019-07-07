@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <a href="#">{{__('knowledge_about_tourism')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <span>{{__('repair_at_creative_places_to_visit')}}</span>
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
                            @php $announce = "Announce"; $activity = "Activity";  @endphp
                                <h2>{{$category['name'] ?? ''}}</h2>
                                <h1>@if(!empty($category['name']) && $category['name'] == "คำสั่งและประกาศ") {{$announce}} @else {{$activity}} @endif</h1>
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
                    @if(!empty($alldata))
                        
                        <div class="wrap_share">
                            <div class="viewno">{{($views) - 1 ?? 0}}</div><div class="contentdate">{{$alldata['datetime' ?? '']}}</div>
                            <span></span>
                            <a class="btn_like" href="{{route('inform.share.facebook',['id' => $alldata['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_facebook_share.png') }}"><span></span></a>
                            <a class="btn_like" href="{{route('inform.share.twitter',['id' => $alldata['id']])}}">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span></span></a>
                            <a style="display:none;" class="btn_like" href="#">
                            <img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}">
                            <span>0</span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($alldata))
                    @if(!empty($alldata['image']))
                        <img src="{{asset('storage/'.$alldata['image'])}}">
                    @endif
                    {!! $alldata['full_desscription'] ?? '' !!}
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/new-inform-detail/script.js') }}"></script>
@endpush
