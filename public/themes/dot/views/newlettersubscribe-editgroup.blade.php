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
                                <h2>{{__('receive_news')}}</h2>
                                <h1>INFORMATION NEWS</h1>
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
                <div class="col-xs-12 csharedetail_head">
                    <h1>{{__('receive_news')}}</h1>
                </div>
                <div class="col-xs-12 csharedetail_content">
                    <div class="checkbox">
                        <label>
                            <input id="chkboxAll" type="checkbox" name="chkall" value="all" checked>
                            All
                        </label>
                    </div>
                    <hr>
                    @if(!empty($newletterSubScribeGroup))
                        @foreach($newletterSubScribeGroup as $keynewletter => $valletter)
                        <div class="checkbox newletter_detail disabled">
                            <label>
                                <input name="{{$valletter['id']}}"  type="checkbox" value="{{$valletter['id']}}" disabled>
                                {{$valletter['newsletter_title'] ?? ''}}
                            </label>
                            <input type="hidden" value="{{$valletter['id']}}">
                        </div>
                        @endforeach
                    @endif
                    <input type="hidden" name="id" value="{{$id}}">
                    </div>
                    <input type="button" data-url="{{route('updatenewletter.subscribe.updatemail')}}" id="SentMail" name="btnSentMail" class="btn btn-warning" value="{{__('confirm_Receive_news')}}">
            </div>
        </div>
    </section>
@endsection
@include('modal.modal-newletter')
@push('scripts')

<script src="{{ ThemeService::path('assets/js/newlettersubscribe-editgroup/script.js') }}"></script>
@endpush