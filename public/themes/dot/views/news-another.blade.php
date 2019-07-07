@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div>
                <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_news_agency')}}</span>
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
                            <h2>{{ $title[0]['name'] ?? ''}}</h2>
                            <h1>{{ $title[0]['name'] ?? ''}}</h1>
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
        @if(Session::has('msg'))
            <div class="alert alert-danger" style="margin-top:30px;">
                {{Session::get('msg')}}
            </div>
        @endif
        @if(!empty($data))
        @endif
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_list_download">
            @if(!empty($data))
                @foreach($data as $key => $val)
                <div class="border_listdownload">
                    <div class="listdownload_item">
                        <a href="{{route('news.another.detail',['id'=>$val['id']])}}">
                        <div class="listdownload_head">
                            {{$val['title']}}
                        </div></a>
                        <div class="listdownload_btn"><a href="{{route('news.another.download',['id' => $val['id']])}}" target="_blank">
                        {{__('download')}}
                        </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <div>
                        @if(!empty($data))
                            {{ $data->links() }}
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
    $('title').text('another');
});
</script>
@endpush