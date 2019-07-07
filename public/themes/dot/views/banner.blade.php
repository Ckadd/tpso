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
                                <h2>{{__('title_department_of_tourism')}}</h2>
                                <h1>Department of Tourism</h1>
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
            
            @if(!empty($banner))
                @foreach($banner as $keyIn => $valueIn)
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 banner_content" style="">
                        @if(!empty($valueIn['image']))
                        <a href="{{$valueIn['link_url'] ?? '#'}}" target="_blank">
                            <img src="{{ asset('storage/'.$valueIn['image']) ?? '' }}">
                        </a>
                        @else
                        <a href="{{$valueIn['link_url'] ?? '#'}}" target="_blank">
                            <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                        </a>
                        @endif
                    </div>
                @endforeach
            @endif

            </div>
        </div>
    </section>
@endsection

@push('css')
<style>
    .banner_content img{
        margin: 20px;
        display: block;
        height: 60px;
        width: 200px;
    }
</style>
@endpush
@push('scripts')

<script src="{{ ThemeService::path('assets/js/pages/script.js') }}"></script>
@endpush