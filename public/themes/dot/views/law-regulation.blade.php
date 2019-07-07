@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_laws_and_regulations')}}</span>
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
                            <h2>{{__('menu_laws_and_regulations')}}</h2>
                            <h1>Law Regulation</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(Session::has('msg'))
    <div class="alert alert-danger" style="margin:30px;">{{Session::get('msg')}}</div>
@endif
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
           
            <div class="col-xs-12 news_head">
                @if(!empty($dataMain))
                    @php
                        $jsonString = [];
                       if(File::exists(base_path('resources/lang/th.json'))){
                           $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                           $jsonString = json_decode($jsonString, true);
                       }
                       $title = '';
                       foreach ($jsonString as $key => $val) {
                           if($dataMain['title'] == $val){
                              $title = __($key);
                              break;
                           }
                       }
                    @endphp
                    <h1>{{$title ?? ไม่มีข้อมูล}}</h1>
                @else
                <h1>กรุณาเพิ่มข้อมูล Backend</h1>
                @endif
                <div class="wrap_share">
                    <div class="viewno">{{$logView ?? 0}}</div><div class="contentdate"></div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_list_download">
            @if(!empty($allTravel))
                @foreach($allTravel as $key => $val)
                <div class="border_listdownload">
                    <div class="listdownload_item">
                    <a href="{{route('laws.detail',['id' => $val['id']])}}" target="_blank">
                        <div class="listdownload_head">
                            {{$val['title'] ?? ''}}
                        </div></a><div class="listdownload_btn">
                            <a href="{{route('laws.travel.download',['id' => $val['id'],'type'=>$dataMain['title']])}}">{{__('download')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                <div>
                @if(!empty($allTravel))
                    {{ $allTravel->links() }}
                @endif
                </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ ThemeService::path('assets/js/law-regulation/script.js') }}"></script>
@endpush
