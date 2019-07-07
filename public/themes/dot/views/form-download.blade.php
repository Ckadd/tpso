@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('download_form_model')}}</span>
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
                            <h2>{{__('download_form_model')}}</h2>
                            <h1>FORM DOWNLOAD</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(Session::has('msg'))
<div class="alert alert-danger" style="margin:30px;">
    {{ Session::get('msg') }}
</div>
@endif
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
        @if(!empty($alldata))
            <div class="col-xs-12 news_head">
                <h1>ดาวน์โหลดแบบฟอร์ม</h1>
                <div class="wrap_share">
                    <div class="viewno">{{$logview ?? 0}}</div><div class="contentdate"></div>
                </div>
            </div>
            
        </div>
        @endif
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_list_download">
            @if(!empty($alldata))
                @foreach($alldata as $key => $val)
                <div class="border_listdownload">
                    <div class="listdownload_item">
                    <!-- <div class="listdownload_num">0{{$key+1}}</div> -->
                    <a href="{{route('formdownload.detail',['id'=>$val['id']])}}">
                        <div class="listdownload_head">
                            {{$val['title']}}
                        </div></a><div class="listdownload_btn"><a href="{{route('formdownload.download',['id' => $val['id']])}}">{{__('download')}}</a></div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <div>
                        @if(!empty($alldata))
                            {{ $alldata->links() }}
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection