@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
            <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('menu_procurement_news')}}</span>
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
                            <h2>{{__('menu_procurement_news')}}</h2>
                            <h1>PURCHASE NEWS</h1>
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
            <div class="col-xs-12 wrap_procurement">
                @if(Session::has('msg'))
                    <div class="alert alert-danger">
                        {{Session::get('msg')}}
                    </div>
                @endif
                @if(!empty($alldata))
                    @foreach($alldata as $keydata =>$valdata)
                        <div class="procurement_item">
                            <div class="procurement_head">
                                {{$valdata['title'] ?? ''}}
                                @php
                                    $date = explode(" ", $valdata['datetime']);
                                @endphp
                                <div class="procurement_date">{{ $date[0] ?? "0000-00-00" }}</div>
                            </div><div class="procurement_download"><a class="pcm_preview" href="{{route('news.procurement.detail',['id'=>$valdata['id']])}}">PREVIEW</a><a class="pcm_download" href="{{route('news.procurement.download',['id'=>$valdata['id']])}}" target="_blank">DOWNLOAD</a></div>
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
@push('scripts')
<script>
$(document).ready(function(){
    $('title').text('ข่าวจัดซื้อจัดจ้าง');
});
</script>
@endpush