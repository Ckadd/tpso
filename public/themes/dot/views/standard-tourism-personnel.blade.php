@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="index.php">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_standard_of_tourism_personnel')}}</span>
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
                            <h2>{{__('menu_standard_of_tourism_personnel')}}</h2>
                            <h1>STANDARD TOURISM PERSONNEL</h1>
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
            <div class="col-xs-12 wrap_tab">
            @php $keyShow = 2; @endphp
            <h2>{{__('menu_standard_of_tourism_personnel')}}</h2>
            
            @if(!empty($data))
                @foreach($data as $key => $value)
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">{{0 . ($key+1)}}</div><div class="tab_head">
                           {!! $value['title'] ?? '' !!} </div>
                    </div>
                    <div class="tab_detail">
                    {!! $value['full_description'] ?? '' !!}
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
 <script src="{{ ThemeService::path('assets/js/standardtourismpersonnel/script.js') }}"></script>
@endpush