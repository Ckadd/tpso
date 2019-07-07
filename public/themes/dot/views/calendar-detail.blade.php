@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div>
                    <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div>
                    <a href="#">{{__('knowledge_about_tourism')}}</a>
                    <div>
                    <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div>
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
                                <h2>{{__('event_calendar')}}</h2>
                                <h1>calendar</h1>
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
                    @if(!empty($dataById))
                        <h1>{{$dataById['title']}}</h1>
                        {!! $dataById['short_description']!!}
                        <div class="wrap_share">
                            <div class="viewno"></div><div class="contentdate">{{$dataById['datetime'] ?? ''}}</div><span></span>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($dataById))
                    {!! $dataById['full_description'] !!}
                    
                    @if(!empty($dataById['image']))
                        <img src="{{asset('storage/'.$dataById['image'])}}">
                    @endif
                @endif    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('title').text("{{__('event_calendar')}}");
});
</script>
<!-- <script src="{{ ThemeService::path('assets/js/content-sharing-detail/script.js') }}"></script> -->
@endpush