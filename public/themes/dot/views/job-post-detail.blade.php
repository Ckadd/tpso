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
                                <h2>{{__('menu_job_postings')}}</h2>
                                <h1>JOB POST</h1>
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
                <div class="col-xs-12 csharedetail_head">
                    @if(!empty($alldata))
                        <h1>{{$alldata['title']}}</h1>
                    @endif
                </div>
                <div class="col-xs-12 csharedetail_content">
                @if(!empty($alldata))
                    @if(!empty($alldata['image']))
                        <img src="{{asset('storage/'.$alldata['image'])}}">
                    @endif
                    {!! $alldata['full_description'] ?? '' !!}
                @endif    
                </div>
                @if($alldata['id'] != '')
                <div class="col-xs-12 job-post-download">
                    <h3>{{__('download_documents')}}</h3>
                    <a href="{{route('job.download',['id' => $alldata['id']])}}">
                        <button class="btn btn-success">{{__('download')}}</button>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('title').text('ประกาศรับสมัครงาน');
});
</script>
@endpush
