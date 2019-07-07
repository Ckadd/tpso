@extends('layouts.app')

@section('content')
@php
    // Start the session
    session_start();
@endphp
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <!-- <a href="">Home</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><a href="#">เรื่องหน้ารู้ด้านการท่องเที่ยว</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>ซ่อมแซมที่ทางสร้างสรรค์ที่เที่ยว</span> -->
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
                                <h2>{{__('graph')}}</h2>
                                <h1>GRAPH GENERATE</h1>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="row wow fadeInDown" style="margin-bottom:30px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 news_head" >
                @if(Session::has('msg'))
                    <div class="alert alert-danger" style="margin-top:30px;">
                        {{Session::get('msg')}}
                    </div>
                @endif
                
                @php
                if(!empty($listgraph) && !empty($data)){
                    if($listgraph[0]['type'] == 1) {
                        dd('1');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;

                        echo '<img src="/graph" style="margin-top:30px;">';
                    }else if($listgraph[0]['type'] == 2) {
                        dd('2');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-line2" style="margin-top:30px;">';
                    }else if($listgraph[0]['type'] == 3) {
                        dd('3');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-line3" style="margin-top:30px;">';
                    }else if($listgraph[0]['type'] == 4) {
                        dd('4');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-line4" style="margin-top:30px;">';
                    }else if($listgraph[0]['type'] == 5) {
                        
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-organization-bar1" style="margin-top:30px; width:100%">';
                    }else if($listgraph[0]['type'] == 6) {
                        dd('6');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-bar2" style="margin-top:30px;">';
                    }else if($listgraph[0]['type'] == 7) {
                       
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-organization-pie1" style="margin-top:30px; width:100%">';
                    }else if($listgraph[0]['type'] == 8) {
                        dd('8');
                        $title = $listgraph[0]['title'];
                        echo '<h1>'.$title.'</h1>';
                        $_SESSION['data'] = $data;
                        $_SESSION['listgraph'] = $listgraph;
                    
                        echo '<img src="/graph-pie2" style="margin-top:30px;">';
                    }else {
                        echo '<h1>กรุณาเลือก กราฟ ให้ถูกต้อง !!</h1>';
                    }
                }else {

                }
                    
                @endphp
                <!-- <img src="/graph-line2" style="margin-top:30px;"> -->
                <!-- <img src="/library/jpgraph-4.2.6/chart_generater/line1.blade.php" style="margin-top:30px;">  -->
            </div>
        </div>
    </div>
</section>   

@endsection