@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('department_of_Tourism_Library')}}</span>
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
                            <h2>{{__('department_of_Tourism_Library')}}</h2>
                            <h1>Library</h1>
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
    @foreach($alldata as $key => $val)
        <div class="row row_viewcolumn">
        @foreach($val as $kk => $vv)
            <a href="{{ route('library.detail',['id' => $vv[0]['id']]) }}" class="col-xs-12 col-sm-6 item_viewcolumn">
                <figure>
                    <img src="{{ asset('storage/'.$vv[0]['cover_image']) ?? '' }}">
                </figure><figcaption>
                    <h1 class="dotmaster">{{$vv[0]['title'] ?? ''}}</h1>
                    <p class="dotmaster">{{$vv[0]['short_description'] ?? ''}}</p>
                    <div class="wrap_share">
                        <div class="viewno">{{$allLogView['allLogView'][$vv[0]['id']] ?? 0}}</div><div class="contentdate">{{$vv[0]['datetime'] ?? ''}}</div>
                    </div>
                </figcaption>
            </a>
            @if(!empty($vv[1]))
            <a href="{{ route('library.detail',['id' => $vv[1]['id']]) }}" class="col-xs-12 col-sm-6 item_viewcolumn">            
                <figure>
                    <img src="{{asset('storage/'.$vv[1]['cover_image']) ?? ''}}">
                </figure><figcaption>
                    <h1 class="dotmaster">{{$vv[1]['title'] ?? ''}}</h1>
                    <p class="dotmaster">{{$vv[1]['short_description'] ?? ''}}</p>
                    <div class="wrap_share">
                        <div class="viewno">{{$allLogView['allLogView'][$vv[1]['id']] ?? 0}}</div><div class="contentdate">{{$vv[1]['datetime'] ?? ''}}</div>
                    </div>
                </figcaption>
            </a>
            @endif
            @endforeach
        </div>
    @endforeach
    @endif
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">{{__('previous')}}</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">{{__('next')}}</span>
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ ThemeService::path('assets/js/library/script.js') }}"></script>
@endpush

