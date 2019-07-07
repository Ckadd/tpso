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
                                <h2>{{__('form_model')}}</h2>
                                <h1>FORM GENERATE</h1>
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
                <div class="col-xs-12 formGenerate csharedetail_head">
                @if(session()->has('message'))
                    <div id="sessionAlert" class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(!empty($formGenerate))
                <form method="post" action="{{route('form.generate.addDetail')}}" enctype='multipart/form-data'>
                    {{csrf_field()}}
                    <div class="fb-render">
    
                    </div>
                    
                    <input type="hidden" name="idForm" value="{{$formGenerate['id']}}">
                    <input type="submit" class="btn btn-primary" value="บันทึกข้อมูล">
                </form>
                <input type="hidden" name="jsonForm" value="{{$formGenerate['form']}}">
                @else
                    <h3>ฟอร์มหมดอายุ</h3>
                @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script src='http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src='https://formbuilder.online/assets/js/form-render.min.js'></script>
<script src="{{ ThemeService::path('assets/js/form-generate-detail/script.js') }}"></script>

@endpush