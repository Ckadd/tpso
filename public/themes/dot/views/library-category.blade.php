@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <span>{{__('library_category')}}</span>
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
                                <h2>{{__('library_category')}}</h2>
                                <h1>LIBRARY CATEGORY</h1>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container wrap_viewcolumn">
            <div class="row" style="margin-top:50px;">
                @if(!empty($alldata))
                    @foreach($alldata as $keydata => $valuedata)
                        <div class="col-sm-12 library-category" style="margin-top:10px;">
                            <a href="{{route('librarybook.category.id',['id' => $valuedata['id']])}}" target="_blank">
                                <img src="{{ ThemeService::path('assets/images/default_img.png') }}" style="height:100px">
                                <span style="margin-left:20px;">{{ $valuedata['title'] ?? '' }}</span>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
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
    <script src="{{ ThemeService::path('assets/js/library/script.js') }}"></script>
@endpush
@push('css')
    <style>
        .library-category > a:hover {
            text-decoration:none;
        }
        .library-category span:hover {
            text-decoration:underline;
        }
    </style>
@endpush
