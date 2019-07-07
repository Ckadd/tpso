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
                                <h2>{{__('menu_the_chart')}}</h2>
                                <h1>CHART STATISTIC</h1>
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
    
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($detailAll))
                    @if(!empty($detailAll[0]['image']))
                        <img src="{{ asset('storage/'.$detailAll[0]['image']) ?? '' }}">
                    @endif
                    {!! $detailAll[0]['detail'] ?? '' !!}
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush