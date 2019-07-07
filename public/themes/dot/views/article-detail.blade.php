@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <!-- <a href="">Home</a>
                    <div>
                    <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div>
                    <a href="#">เรื่องหน้ารู้ด้านการท่องเที่ยว</a>
                    <div>
                    <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div>
                    <span>ซ่อมแซมที่ทางสร้างสรรค์ที่เที่ยว</span> -->
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
                                <h2>{{__('interesting')}}</h2>
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
                @if(!empty($detail))
                    {!! $detail['title'] !!}
                @endif  
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($detail))
                    {!! $detail['full_description'] !!}
                    <img src="{{asset('storage/'.$detail['image'])}}">
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/article/script.js') }}"></script>
@endpush