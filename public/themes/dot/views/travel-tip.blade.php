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
                <div class="row row_viewcolumn">
                    @foreach($alldata as $key => $vv)
                        <a href="{{ route('knowledgebase.detail',['id' => $vv['id']]) }}" class="col-xs-12 col-sm-6 item_viewcolumn">
                            <figure>
                                <img src="{{ asset('storage/'.$vv['cover_image']) ?? '' }}">
                            </figure><figcaption>
                                <h1 class="dotmaster">{{$vv['title'] ?? ''}}</h1>
                                <div class="dotmaster">{!!$vv['short_description'] ?? '' !!}</div>
                                <div class="wrap_share">
                                    <div class="viewno">{{$dataAllLogView[$vv['id']] ?? 0}}</div>
                                    <div class="contentdate">{{$vv['created_at'] ?? ''}}</div>
                                </div>
                            </figcaption>
                        </a>
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
