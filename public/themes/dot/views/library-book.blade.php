@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('menu_library_book')}}</span>
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
                                <h2>{{__('menu_library_book')}}</h2>
                                <h1>LIBRARY BOOK</h1>
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
                    <?php $index = 1; ?>
                    @foreach($alldata as $key => $vv)
                        <a href="{{ route('librarybook.detail',['id' => $vv['id']]) }}" class="col-xs-12 col-sm-6 item_viewcolumn">
                            <figure>
                                @if(empty($vv['cover_image']))
                                <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                                @else
                                <img src="{{ asset('storage/'.$vv['cover_image']) ?? '' }}">
                                @endif
                            </figure><figcaption>
                                <h1 class="dotmaster">{{$vv['title'] ?? ''}}</h1>
                                <div class="dotmaster">{!!$vv['short_description'] ?? '' !!}</div>
                                <div class="wrap_share" >
                                    <div class="viewno">{{$dataAllLogView[$vv['id']] ?? 0}}</div>
                                    <!-- <div class="contentdate"></div> -->
                                </div>
                            </figcaption>
                        </a>
                        <?php $clear_fix = $index % 2; ?>
                            @if($clear_fix == 0)
                                <div class="clearfix"></div>
                            @endif
                        <?php $index++;?>
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
    <script src="{{ ThemeService::path('assets/js/library/script.js') }}"></script>
@endpush
