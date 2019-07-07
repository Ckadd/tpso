@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
            <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_organizational_structure')}}</span>
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
                            <h2>{{__('menu_organizational_structure')}}</h2>
                            <h1>Organizational Structure</h1>
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
            <div class="col-xs-12 Organizational_Structure">
            @if(!empty($alldata))
                <img src="{{asset('storage/'.$alldata[0]['image'])}}">
            @endif
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 organization-img">
                    <img src="{{ ThemeService::path('assets/images/Dotlogo.jpg') }}" alt="">
                </div>
                
            @if(!empty($level1))
                @foreach($level1 as $keyLevel1 => $valueLevel1)
                    <a href="{{$valueLevel1['link_url']}}" target="_blank">
                    <div class="level1 text-center col-xs-6 col-sm-3" style="@if($keyLevel1 == 0) margin-left:200px; @endif">
                        {{ $valueLevel1['title'] ?? '' }}
                    </div></a>
                @endforeach
            @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 Organizational_Structure">
                @foreach($level2 as $keyLevel2 => $valueLevel2)
                <a href="{{$valueLevel2['link_url']}}" target="_blank">
                    <div class="level2 text-center col-xs-12 col-sm-2">
                        {{ $valueLevel2['title'] ?? '' }}
                    </div></a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
    <style>
        .level1 {
            width:20%;
            height:70px;
            background-color:#9cd3d8;
            margin:85px 15px 10px 15px;
            border:solid 2px #ebebeb;
            
        }
        .level2 {
            width:14%;
            height:80px;
            background-color:#ffffff;
            margin:30px 15px;
            border:solid 2px #eba974;
        }
        .organization-img > img {
            width:20%;
            float:left;
            margin-left:145px;
            position: relative;
        }
        .organization-img {
            padding:0;
        }
        .organization-img::after {
            content: " "; 
            border: solid 0px; 
            height: 73px; 
            width: 2px; 
            display: block; 
            background-color: #ccc8c8; 
            position: absolute; 
            bottom: -85px; 
            z-index: 100; 
            margin-left: 180px;
        }
        :after, :before { 
            -webkit-box-sizing: border-box; 
            -moz-box-sizing: border-box; 
            box-sizing: border-box; 
        }
        .Organizational_Structure a {
            color:black;
        }
        
    </style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    $('title').text('โครงสร้างองค์กร');
});
</script>
@endpush