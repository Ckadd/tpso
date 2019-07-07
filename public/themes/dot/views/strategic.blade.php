@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_contact_department')}}</span>
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
                            <h2>{{__('strategic')}}</h2>
                            <h1>Strategic</h1>
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
            <h2>{{__('tourism_development_strategy')}}</h2>
            <p>{{__('tourism_development_strategy')}} : {{__('to_consist_of')}} {{ $count ?? '' }} {{__('strategic')}} ดังนี้<br>
            @if(!empty($strategicOrderFirst))
                @foreach($strategicOrderFirst as $keyfirst => $valfirst)
                    {{($keyfirst + 1)}}. {{$valfirst['title']}}<br>
                @endforeach
                @foreach($strategicOrderThanFirst as $keythanfirst => $valthanfirst)
                    {{($keyShow + $keythanfirst)}}. {{$valthanfirst['title']}}<br>
                @endforeach
            @else 
                @foreach($strategicOrderThanFirst as $keythanfirst => $valthanfirst)
                    {{($keythanfirst + 1)}}. {{$valthanfirst['title']}}<br>
                @endforeach
            @endif
            </p>
            @if(!empty($strategicOrderFirst))
                <div class="border_tab">                
                    <div class="tab_item active">
                        <div class="tab_num">01</div><div class="tab_head">{{$strategicOrderFirst[0]['title'] ?? ''}}
                        </div>
                    </div>
                    <div class="tab_detail">
                        {!! $strategicOrderFirst[0]['full_description'] ?? '' !!}
                    </div>
               
                </div>
            @endif
            @php 
                if(!empty($strategicOrderFirst)) {
                    $keyOrderThanFirst = 2;
                }else { 
                    $keyOrderThanFirst = 1;
                }
            @endphp
            @if(!empty($strategicOrderThanFirst))
                @foreach($strategicOrderThanFirst as $key => $value)
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">{{0 . ($keyOrderThanFirst + $key)}}</div><div class="tab_head">
                           {!! $value['title'] ?? '' !!} </div>
                    </div>
                    <div class="tab_detail">
                    {!! $value['full_description'] ?? '' !!}
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <nav aria-label="Page navigation" class="nav_pagination">
            {{ $strategicOrderThanFirst->links() }}
        </nav>
    </div>

</section>
@endsection
@push('scripts')
 <script src="{{ ThemeService::path('assets/js/strategic/script.js') }}"></script>
@endpush