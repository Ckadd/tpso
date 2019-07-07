@extends('layouts.app')
@section('content')
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
                                <h2>ข่าวสารธุรกิจนำเที่ยวและมัคคุเทศก์</h2>
                                <h1>NEWS GUIDE</h1>
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
                <div class="col-xs-12 csharedetail_head">
                    @if(!empty($alldata))
                        <h1>{{$alldata['title']}}</h1>
                        <div class="wrap_share">
                            @php 
                                $date = explode(" ",$alldata['datetime']);
                            @endphp
                            <div class="viewno">{{($views) - 1 ?? 0}}</div><div class="contentdate">{{$date[0] ?? "0000-00-00"}}</div>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                
                @if(!empty($alldata))
                    @if(!empty($alldata['image']))
                    @php $image = json_decode($alldata['image']); @endphp
                        @if(!empty($image))
                            @foreach($image as $valueImage)
                                <img src="{{ asset('storage/'.$valueImage) }}">
                            @endforeach
                        @endif
                    @endif
                    
                    {!! $alldata['full_desscription'] ?? '' !!}
                @endif    
                </div>
                <div class="col-xs-12 job-post-download">
                    <!-- form download -->
                    <div class="col-xs-12 wrap_pcm_preview_download">
                        @for($i=1; $i < 6; $i++)
                            @if(!empty($alldata['file'.$i]))
                                <a href="{{route('news.institution.detaildownload',['id' => $alldata['id'], 'filename'=>'file'.$i])}}" target="_blank">
                                {{__('download_documents')}} {{$i}}</a>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('title').text("ข่าวสารธุรกิจนำเที่ยวและมัคคุเทศก์");
});
</script>
@endpush
