@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('site_map')}}</span>
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
                            <h2>{{__('site_map')}}</h2>
                            <h1>WEBSITE MAP</h1>
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
            <div class="col-xs-12 col-sm-6 col-lg-6 website-map-img">
                <img src="{{ ThemeService::path('assets/images/website-map.jpg') }}">
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-6 website-map">
                    @if(!empty(menu('top-menu')))
                        {{ menu('top-menu','bootstrap') }}
                    @endif
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){    
    $('div.website-map ul.nav').removeClass('nav navbar-nav');
    $('div.website-map li.dropdown').removeClass('dropdown');
    $('div.website-map ul.dropdown-menu').removeClass('dropdown-menu');
    $('div.website-map li > a span.caret').removeClass('caret');
    $('title').text('ผังเว็บไซต์');
});
</script>   
@endpush
