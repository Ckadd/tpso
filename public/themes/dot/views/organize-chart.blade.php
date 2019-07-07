@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
            <a href="{{url('/')}}">{{__('menu_home')}}</a>
            <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('board_of_Directors')}}</span>
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
                            <h2>{{__('board_of_Directors')}}</h2>
                            <h1>Executives</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        @if(!empty($level))
        @foreach($level as $keylevel => $vallevel)
            <div class="row ">
            @foreach($vallevel as $keydatalevel => $valdatalevel)

            @php 
                $collevel1 = "";
                $col = "";
                if($valdatalevel['level'] == 1) {
                    $collevel1 = "item_og_chart_top";
                } 
                if($valdatalevel['level'] == 2 && $keydatalevel==1 ) {
                    $col = "col-sm-6 col-md-4 col-md-offset-2";
                }elseif($valdatalevel['level'] != 1){
                    $col = "col-sm-6 col-md-4";
                }
            @endphp
                <div class="col-xs-12 item_og_chart {{$collevel1}} {{$col}}  ">
                    <a href="{{route('organizechart.detail',['id' => $valdatalevel['id']])}}">
                        <figure>
                            <img src="{{ asset('storage/'.$valdatalevel['image']) ?? '' }}">
                        </figure><figcaption>
                            <h1>{{$valdatalevel['first_name']  ." ". $valdatalevel['last_name'] ?? ''}}</h1>
                            <span></span>
                            <p>{{$valdatalevel['position'] ?? ''}}</p>
                        </figcaption>
                    </a>
                </div>
                @endforeach
            </div>
        @endforeach
        @endif
    </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('title').text('คณะผู้บริหาร');
});
</script>
@endpush