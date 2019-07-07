@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_News')}}</span>
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
                            <h2>{{__('menu_News')}}</h2>
                            <h1>NEWS PRESS RELEASES</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container wrap_viewcolumn">
    
    @if(!empty($alldata))
    <div class="row row_viewcolumn">
    
    @foreach($alldata as $key => $val)
        @php 
            $dateColmunOne = $val['datetime'];
            $newdateColmunOne = explode(" ",$dateColmunOne);
        @endphp
        
            <div class="col-sm-12 col-md-6 col-lg-6">
            <a href="{{route('news.inform.detail',['id'=>$val['id']])}}" class="col-xs-12 col-sm-12 col-md-12 item_viewcolumn">
                <figure>
                    @if(!empty($val['cover_image']))
                        <img src="{{ asset('storage/'.$val['cover_image'])}}">
                        @else
                        <img src="{{asset('themes/dot/assets/images/default_img.png')}}">
                    @endif
                </figure><figcaption>
                    <h1 class="dotmaster">{{$val['title'] ?? ''}}</h1>
                    <p class="dotmaster">{{$val['short_description'] ?? ''}}</p>
                    <div class="wrap_share">
                        <div class="viewno">{{$val['view'] ?? 0}}</div><div class="contentdate">{{$newdateColmunOne[0]}}</div>
                    </div>
                </figcaption>
            </a>
            </div>
        
    @endforeach
    </div>
    @endif
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
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
<script src="{{ ThemeService::path('assets/js/new-press-releases/script.js') }}"></script>
@endpush

