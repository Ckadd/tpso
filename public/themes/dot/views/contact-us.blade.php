@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('menu_contact_department')}}</span>
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
                            <h2>{{__('menu_contact_department')}}</h2>
                            <h1>contact us</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        @if(Session::has('msg'))
            <div class="alert alert-success text-center" style="margin-top:30px;">
                {{Session::get('msg')}}
            </div>
        @endif
        <div class="row wrap_contact_info">
            <div class="col-xs-12 col-sm-6 contact_text contact_address">
                <h1>{{__('department_of_Tourism_Address')}}</h1>
                
                @if(!empty($address))
                    {!! $address[0]['body'] ?? '' !!}
                @endif

            </div>
            <div class="col-xs-12 col-sm-6 contact_text contact_route">
                <h1>{{__('travel')}}</h1>
                
                @if(!empty($travel))
                    {!! $travel[0]['body'] ?? '' !!}
                @endif

            </div>
        </div>
        <div class="row wrap_contact_enandmap">
            <div class="col-xs-12 contact_head">
                <h1>{{__('Information_for_contacting_the_Department_of_Tourism')}}</h1>
            </div>
            <form method="post" action="{{route('contactus.sendmail')}}">
                @csrf
            <div class="col-xs-12 col-sm-12 col-md-6 wrap_enquiry">
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('name_surname')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('id_card')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="text" name="number-id" class="form-control" required>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('telephone_number')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('email')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('contact_topic')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                    {{__('message')}}<span>*</span>
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <textarea class="form-control" name="body" rows="4" required></textarea>
                    </div>
                </div>
                <div class="row item_form">
                    <div class="col-xs-12 col-sm-4 text_form">
                        
                    </div>
                    <div class="col-xs-12 col-sm-8 input_form">
                        <input type="submit" class="form-control btn btn-primary btn-md" value="{{__('send_information')}}">
                    </div>
                </div>
            </div>
            </form>
            <div class="col-xs-12 col-sm-12 col-md-6 wrap_googlemap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.5345491997437!2d100.52477931479406!3d13.746606290350801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29932873873c9%3A0xa3691ef47814e31c!2sDepartment+of+Tourism!5e0!3m2!1sen!2sth!4v1538836132205" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
@endsection