@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{$category[0]['name'] ?? ''}}</span>
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
                            <h2>{{$category[0]['name'] ?? ''}}</h2>
                            <h1>ANOTHER</h1>
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
        @if(Session::has('msg'))
            <div class="alert alert-danger" style="margin-top:30px;">
                {{Session::get('msg')}}
            </div>
        @endif
        @if(!empty($data))
            <div class="col-xs-12 news_head">
                <h1>{{$category[0]['name'] ?? ''}}</h1>
            </div>
        </div>
        @endif
    </div>
</section>
<section class="row wow fadeInDown">

    <div class="container">
        <div class="row">
            <div class="col-sm-3 wrap_sidebar">
                @include('layouts-internal.inc-sidebar')
            </div>
            <div class="col-xs-9 wrap_viewcolumn row_viewcolumn">
                @if(!empty($allData))
                @foreach($allData as $keyData => $valueData)
                    @php
                        $getDate = explode(" ",$valueData['datetime']);
                    @endphp
                    <a href="{{route('internal.detail',['id' => $valueData['id'],'idCategory' => $category[0]['id'] ])}}" class="col-xs-12 col-sm-12 item-internal-audit-plan" target="_blank">
                        <figure>
                            @if(!empty($valueData['cover_image']))
                                <img src="{{ asset('storage/'.$valueData['cover_image'])}}">
                            @else
                                <img src="{{asset('themes/dot/assets/images/default_img.png')}}">                            
                            @endif
                        </figure><figcaption>
                            <h1 class="dotmaster">{{ $valueData['title'] ?? '' }}</h1>
                            <div class="wrap_share">
                                <div class="contentdate">{{$getDate[0] ?? ''}}</div>
                            </div>
                        </figcaption>
                    </a>
                @endforeach
                @endif
            </div>
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <div>
                        @if(!empty($allData))
                            {{ $allData->links() }}
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection
@push('css')
    <style>
        .item-internal-audit-plan figure {
            display:inline-block;
            width:210px;
            margin-top: 20px;
        }
        .item-internal-audit-plan figcaption {
            display: inline-block;
            padding-left: 20px;
            vertical-align: top;
        }
        .item-internal-audit-plan figure img {
            display: block;
            width: 100%;
            height: auto;
            vertical-align: top;
        }
        .item-internal-audit-plan figcaption h1 {
            font-size: 1.7rem;
            color: #000;
            line-height: 0.8;
            height: 0.8em;
        }
        .bg_sidebar{
            display: block;
            background-color: #132f70;
            position: relative;
            padding: 15px 0 30px 0;
        }
        .bg_sidebar::before{
            content: "";
            height: 25px;
            position: absolute;
            background-color: #132f70;
            border-top: 10px solid #f4d106;
            bottom: 100%;
            left: 0;
            width: 100%;
        }
        .btn_menusb{
            display: none;
            padding-left: 35px;
            padding-bottom: 10px;
            border-bottom: 1px solid #193e94;
            background-image: url(../../../../themes/dot/assets/images/arrsubmenu_sidebar.png);
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }    
        .btn_menusb img{
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }
        .btn_menusb .btn_menu_text{
            display: inline-block;
            font-size: 1.05rem;
            font-weight: 500;
            letter-spacing: 1px;
            vertical-align: middle;
            color: #FFF;
        }
        .sidebar{
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar > li{
            padding: 0 13px;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
        }
        .sidebar > li > a{
            color: #FFF;
            font-size: 1rem;
            padding: 5px;
            display: block;
            padding-left: 30px;
            text-decoration: none;
            border-bottom: 1px solid #193e94;
        }
        .sidebar .sb_sub{
            margin: 0;
            list-style: none;
            padding-bottom: 10px;
        }
        .sidebar .sb_sub li{
            
        }
        .sidebar .sb_sub li a{
            color: #FFF;
            font-size: 1rem;
            padding: 0px 5px 0px 10px;
            display: block;
            position: relative;
            text-decoration: none;
        }
        .sidebar .sb_sub li a::before{
            content: "•";
            position: absolute;
            left: 0;
            top: 0px;
            color: #32487c;
            font-size: 1.1rem;
        }
        .sidebar > li:last-child a{
            border-bottom: 0;
        }
        .sidebar > li.sb_hassub > a{
            background-image: url(../../../../themes/dot/assets/images/arrsubmenu_sidebar.png);
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }
        .sidebar > li.sb_hassub ul{
            display: none;
        }
        .sidebar > li.sb_hassub.active{
            background-color: #061456;
        }
        .sidebar > li.sb_hassub.active a{
            border-bottom: 0;
        }
        .sidebar > li:hover,.sidebar > li.sb_hassub:hover { 
            cursor: pointer;
        }
        .wrap_sidebar{
            padding-right: 0px;
            margin-top:50px;
        }
    </style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){
    $('title').text("{{__('internal_audit_plan')}}");
    $( '.sb_hassub a' ).click(function (event) {
	  if (  $( this ).next('.sb_sub').is( ":hidden" ) ) {
            $('.sb_sub').slideUp();
            $( this ).next('.sb_sub').slideDown();
            $('.sb_hassub').removeClass("active");
            $(this).parent('.sb_hassub').addClass("active");
	  } else {
          $('.sb_sub').slideUp();
          $('.sb_hassub').removeClass("active");
	  }
	//   event.preventDefault();
	});
});


</script>
@endpush