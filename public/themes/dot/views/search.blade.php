@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('search')}}</span>
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
                            <h2>{{__('search')}}</h2>
                            <h1>Search</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row wow fadeInDown ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="warp-search-page">

                    <div class="warp-count">
                        {{ sprintf(_('ผลลัพทธ์การค้นหา %s รายการ'), $num_found) }}
                    </div>

                    @foreach($results as $result)
                        <div class="post-block">
                            <div class="title">
                                <a href="{{ $result['url'] }}">
                                    <h3>
                                        {{ $result['title'] }}
                                    </h3>
                                    <div class="url">
                                        {{ $result['url'] }}
                                    </div>
                                </a>
                            </div>
                            <div class="description">
                                @php
                                    $text = Html2Text\Html2Text::convert($result['excerpt']);
                                    echo $text;
                                @endphp
                            </div>
                        </div>
                    @endforeach
                    
                    @if ($max_pages != 1 && false)
                    <div class="warp-pagination">
                            <ul class="pagination">
                                @for ($i = 1; $i <= $max_pages ; $i++ ) 

                                    <li class="{{ ($current_page == $i) ? 'active' : '' }}">
                                        <a href="{{ ($current_page == $i) ? '#' : route('search.q.page', ['q' => $q, 'page' => $i]) }}" {{ ($current_page == $i) ? 'disable' : '' }}>
                                            {{ $i }}
                                        </a>
                                    </li>

                                @endfor
                            </ul>
                    </div> <!-- .warp-pagination -->
                    @endif

                    <div class="warp-pagination">
                        <div class="selector-pagination pagination">

                        </div>
                    </div>

                </div> <!-- .warp-search-page -->

            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script type="text/javascript">
        $_num_found = <?php echo $num_found; ?>;
        $_max_pages = <?php echo $max_pages; ?>;
        $_current_page = <?php echo $current_page; ?>;
        $_url = "<?php echo route('search.q.page', ['q' => $q, 'page' => '']); ?>";
        $_count_per_page = <?php echo $count_per_page; ?>;
    </script>
    <script src="{{ ThemeService::path('assets/js/jquery.twbsPagination.min.js') }}"></script>
    <script src="{{ ThemeService::path('assets/js/jquery.simplePagination.js') }}"></script>
    <script src="{{ ThemeService::path('assets/js/search/script.js') }}"></script>
@endpush