@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">สถิติกรมการท่องเที่ยว</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>สถิติกรมการท่องเที่ยว</span>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="col-xs-12 head_cshare_bgblue">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 head_cshare_detail">
                            <hgroup>
                                <h2>{{__('knowledge_about_tourism')}}</h2>
                                <h1>Dot Stat</h1>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row mobile_sidebar">@include('layouts-internal.inc-sidebar')</section>
    <section class="row wow fadeInDown hilight_csharing">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 wrap_sidebar">
                    @include('layouts.inc-sidebar')
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

                    <div class="row">
                        <div class="col-xs-12">
                        @if(!empty($data))
                            @php
                                $jsonString = [];
                                if(File::exists(base_path('resources/lang/th.json'))){
                                    $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                                    $jsonString = json_decode($jsonString, true);
                                }
                                $titleName = $data['name'];
                                foreach ($jsonString as $key => $val) {
                                    if($data['name'] == $val){
                                        $titleName = __($key);
                                        break;
                                    }
                                }
                            @endphp
                            <h1 class="text-center"> {{ $titleName ?? '' }}</h1>
                        @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 text-center">
                        @if(!empty($data))
                            <h1 class="text-center"> {{ $data['title'] ?? '' }}</h1>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="containner" style="padding-top:30px;">
                            <form method="GET" action="{{ route('dotStat.search',['id' => $data['id'] ?? 0 ]) }}">
                                @csrf
                                <div class="col-xs-12 col-md-2 text-right">
                                    <label>{{__('choose_month')}}:</label>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <select class="form-control" name="month" id="selectMonth">
                                        @foreach($month as $keyMonth => $valueMonth)
                                            <option value="{{ $keyMonth }}">{{ $valueMonth }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-xs-12 col-md-2 text-right">
                                    <label>{{__('choose_year')}}:</label>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <select class="form-control" name="year" id="selectYear">
                                        @foreach($year as $valueYear)
                                            <option value="{{$valueYear}}">{{ $valueYear }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="category" value="{{ $data['id'] ?? 0 }}">
                                <div class="col-xs-12 col-md-2">
                                    <input type="submit" class="btn btn-primary" value="ค้นหา">
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <table class="table table-hover" style="padding-top:20px;">
                                        <thead>
                                            <tr>
                                                <th>{{__('no')}}</th>
                                                <th>{{__('txt_title')}}</th>
                                                <th>{{__('download_file')}}</th>
                                                <th>{{__('download_file')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($dataStat))
                                                @foreach($dataStat as $keyDataStat => $valueDataStat)
                                                    <tr>
                                                        <td>{{ $keyDataStat }}</td>
                                                        <td>{{ $valueDataStat['title'] ?? '' }}</td>
                                                        <td><a href="{{ route('dotStat.download',['id'=>$valueDataStat['id'],'nameFile'=> 'file1' ]) }}" class="btn btn-primary">Download</a></td>
                                                        <td>
                                                            @if(!empty($valueDataStat['file2']))
                                                                <a href="{{ route('dotStat.download',['id'=>$valueDataStat['id'],'nameFile'=> 'file2' ]) }}" class="btn btn-primary">Download</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    
$(document).ready(function(){
    $( '.mobile_sidebar .btn_menusb' ).click(function (event) {
	  if (  $( ".mobile_sidebar .sidebar" ).is( ":hidden" ) ) {
            $(this).addClass("active");
            $('.mobile_sidebar .sidebar').slideDown();
	  } else {
          $('.mobile_sidebar .sidebar').slideUp();
          $(this).removeClass("active");
	  }
	  event.stopPropagation();
	});

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

    let dateNow = [];
    dateNow.push(<?php echo $dateNow[0] + 543 ?>);
    dateNow.push('0' + <?php echo $dateNow[1] ?>);
    
    $('#selectMonth').val(dateNow[1]);
    $('#selectYear').val(dateNow[0]);
});
</script>
@endpush
