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
@if(!empty($pages))
    @if($pages['slug'] == "intro-pages")

    @else
    <section class="row wow fadeInDown">
        <div class="col-xs-12 head_cshare_bgblue">
            <div class="row">
                <div class="container">
                    <div class="row">
                    
                        <div class="col-xs-12 head_cshare_detail">
                            <hgroup>
                                <h2>{{__('title_department_of_tourism')}}</h2>
                                <h1>{{ $pages['title'] ?? '' }}</h1>
                            </hgroup>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    
    <section class="row wow fadeInDown">
        <div class="container">
            <div class="row">
                @if($pages['slug'] == "thank-you-pages")
                    <div class="col-xs-12 csharedetail_content">
                        @if(!empty($pages))
                            {!! $pages['body'] ?? '' !!}
                        @endif    
                    </div>
                @else
                    @if($pages['slug'] == "intro-pages")

                    @else
                    <div class="col-xs-12 csharedetail_head">
                    
                    </div>
                    @endif
                    
                    <div class="col-xs-12 csharedetail_content">
                    @if(!empty($pages))
                        <hr>
                        {!! $pages['body'] ?? '' !!}
                    @endif    
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/pages/script.js') }}"></script>
@endpush