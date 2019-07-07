@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">เรื่องหน้ารู้ด้านการท่องเที่ยว</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>ซ่อมแซมที่ทางสร้างสรรค์ที่เที่ยว</span>
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
                                <h1>CONTENT SHARING</h1>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown hilight_csharing">
        <div class="container">
            <div class="row">
            @if(!empty($dataContentById))
                <figure class="col-xs-12 col-sm-5 col-md-4 image_hcsharing">
                    @if(!empty($dataContentById[0]['cover_image']))
                        <a href="{{ route('sharing.detail',['id' => $dataContentById[0]['id']]) }}"><img src="{{asset('storage/'.$dataContentById[0]['cover_image'])}}"></a>
                    @else
                        <a href="{{ route('sharing.detail',['id' => $dataContentById[0]['id']]) }}"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                    @endif
                </figure>
                <figcaption class="col-xs-12 col-sm-7 col-md-8 detail_hcsharing">
                    <h1>{{$dataContentById[0]['title']}}</h1>
                    {!! $dataContentById[0]['short_description'] !!}
                    <div class="wrap_viewshare">
                        <div class="viewno">@if(!empty($dataAllLogView['allViewLog'][1])) {{ $dataAllLogView['allViewLog'][$dataContentById[0]['id']] }} @else 0 @endif</div>
                        
                            <!-- <iframe name="iframesharingdetail" frameborder="0" width="0px" height="0px" src="{{route('sharing.detail',['id' => $dataContentById[0]['id']])}}"></iframe> -->
                            <div class="shareno">{{ $allshareLog[$dataContentById[0]['id']] ?? 0 }}</div> 
                        </div>
                    <a class="btn_readmore" href="{{route('sharing.detail',['id' => $dataContentById[0]['id']])}}">{{__('read_more')}}</a>
                @else
                    <h1>{{__('data_not_found')}}</h1>
                @endif
                </figcaption>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container cont_item_csharing">
            <div class="row wrap_item_csharing">
            @if(!empty($dataContentSort))
                @foreach($dataContentSort as $keycontent => $valcontent)
                <div class="col-xs-12 col-sm-4 item_csharing">
                    <figure>
                    @if(!empty($valcontent['cover_image']))
                        <a href="{{route('sharing.detail',['id' => $valcontent['id']])}}"><img src="{{asset('storage/'.$valcontent['cover_image'])}}"></a>
                    @else
                        <a href="{{ route('sharing.detail',['id' => $valcontent['id']]) }}"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                    @endif
                    </figure>
                    <figcaption>
                        <h1 class="dotmaster">{{$valcontent['title']}}</h1>
                        <div class="wrap_viewshare">
                        <div class="viewno">{{$dataAllLogView['allViewLog'][$valcontent['id']] ?? 0}}</div><div class="shareno">{{ $allshareLog[$valcontent['id']] ?? 0 }}</div>
                        </div>
                        <a class="btn_readmore" href="{{route('sharing.detail',['id' => $valcontent['id']])}}">{{__('read_more')}}</a>
                    </figcaption>
                </div>
                @endforeach
            @else
                <h1>{{__('data_not_found')}}</h1>
            @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ ThemeService::path('assets/js/content-sharing/script.js') }}"></script>
@endpush