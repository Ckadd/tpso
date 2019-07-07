@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
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
                            <h2>{{__('menu_frequently_asked_questions')}}</h2>
                            <h1>FAQS</h1>
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
            <div class="col-xs-12 wrap_tab">
            <!-- search -->
            <form method="post" action="{{route('faq.search')}}" style="display:inline;">
                @csrf
                <div class="col-xs-12 select_faq select_cate" id="faq-category" style="z-index:12">
                    <span>Select Categories</span> 
                    <ul>
                        @if(!empty($category))
                            @foreach($category as $keycategory => $valcategory)
                                @php
                                    $jsonString = [];
                                   if(File::exists(base_path('resources/lang/th.json'))){
                                       $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                                       $jsonString = json_decode($jsonString, true);
                                   }
                                   $name = $valcategory['name'];
                                   foreach ($jsonString as $key => $val) {
                                       if($valcategory['name'] == $val){
                                          $name = __($key);
                                          break;
                                       }
                                   }
                                @endphp
                                <li name="{{$valcategory['id']}}">{{$name ?? ''}}</li>
                            @endforeach
                        @endif                        
                    </ul>
                    <input type="hidden" name="category"> 
                </div><div class="col-xs-12 text-keyword select_faq">
                    <input type="text" name="keyword" style="width:100%" placeholder="ค้นหารายการ"> 
                </div>
                <button type="submit" class="btn_calendar_search">Search</button></form>

            <!-- featureTop -->
            @php $keyfeatureShow = 1;  @endphp
            <h2>{{__('qutstanding_question')}}</h2>
            <p>{{__('qutstanding_question')}} : {{__('to_consist_of')}} <span id="featurecount"></span>  {{__('as_follows')}}<br>
            @if(!empty($feature))
                @foreach($feature as $keyfeatureFirst => $valfeaturefirst)
                    @foreach($valfeaturefirst as $keyfeatureitem => $valfeatureitem)
                        {{($keyfeatureShow)}}. {{$valfeatureitem['title']}}<br>
                        @php $keyfeatureShow++;@endphp
                    @endforeach
                    
                @endforeach
            @endif
            </p>
            @if(!empty($feature))
            @php $keyfeatureontent = 1; @endphp
                @foreach($feature as $keyfeature => $valuefeature)
                @foreach($valuefeature as $keyfeaturevalue => $valuefeatureData)
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">{{0 . ($keyfeatureontent)}}</div><div class="tab_head">
                           {!! $valuefeatureData['title'] ?? '' !!} <i class="glyphicon glyphicon-pushpin" style="float: right; color:red;"></i></div>
                    </div>
                    <div class="tab_detail">
                    {!! $valuefeatureData['content'] ?? '' !!}
                    <div class="text-right">
                        <input type="hidden" name="idfaq" value="{{$valuefeatureData['id']}}">
                        <a href="{{route('faq.downloadPDF',['id'=>$valuefeatureData['id']])}}" target="_blank"><button class="text-right btn btn-download img-download "><span>download</span></button></a>
                        <button class="text-right btn btn-download btn-sentmail" data-idMail="{{$valuefeatureData['id']}}">{{__('sent_mail')}}</button>
                    </div>
                    </div>
                </div>
                @php $keyfeatureontent++ @endphp
                @endforeach
                @endforeach
            @endif
            
            <!-- faqQuestion -->
            @php $keyShow = 1;  @endphp
            <h2 style="margin-top:100px;">{{__('menu_frequently_asked_questions')}}</h2>
            <p>{{__('menu_frequently_asked_questions')}} : {{__('to_consist_of')}} <span id="faqcount"></span>  {{__('as_follows')}}<br>
            
            @if(!empty($dataFaqs))
                @foreach($dataFaqs as $keyfirst => $valfirst)  
                    {{($keyShow)}}. {{$valfirst['title']}}<br>
                    @php $keyShow++; @endphp   
                @endforeach
            @endif
            </p>
            @if(!empty($dataFaqs))
            @php $keyContent = 1; @endphp
                @foreach($dataFaqs as $key => $value)
                <div class="border_tab">
                    <div class="tab_item">
                        <div class="tab_num">{{0 . ($keyContent)}}</div><div class="tab_head">
                           {!! $value['title'] ?? '' !!} </div>
                    </div>
                    <div class="tab_detail">
                    {!! $value['content'] ?? '' !!}
                    <div class="text-right">
                        <input type="hidden" name="idfaq" value="{{$value['id']}}">
                        <a href="{{route('faq.downloadPDF',['id'=>$value['id']])}}" target="_blank"><button class="text-right btn btn-download img-download "><span>download</span></button></a>
                        <button class="text-right btn btn-download btn-sentmail" data-idMail="{{$value['id']}}">{{__('sent_mail')}}</button>
                    </div>
                    </div>
                </div>
                @php $keyContent++ @endphp
                @endforeach
            @endif
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <div>
                        @if(!empty($dataFaqs))
                            {{ $dataFaqs->links() }}
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
@include('modal.modal-question')
@include('modal.modal-success')
@endsection
@push('scripts')
 <script src="{{ ThemeService::path('assets/js/faq/script.js') }}"></script>
 <script>
$(document).ready(function(){    
    $( '.select_faq span' ).click(function (event) {
	  if (  $( this ).siblings('ul').is( ":hidden" ) ) {
            $('.select_faq').children('ul').slideUp();
            $( this ).siblings('ul').slideDown();
	  } else {
          $('.select_faq').children('ul').slideUp();
	  }
        event.stopPropagation();
	});
    $( '.select_faq ul li' ).click(function (event) {
        var textselect = $(this).text();    
        $(this).parent('ul').siblings('span').text(textselect);
        $('.select_faq').children('ul').slideUp();
	  event.stopPropagation();
	});
    $( "html" ).click(function (event) {
         $('.select_faq').children('ul').slideUp();
    });
    
    $(".select_cate  ul  li").click(function(){
        var idCategory = $(this).attr('name');

        $('input[name=category]').val(idCategory);
    });

    $(".select_month  ul  li").click(function(){
        $('input[name=month]').val($(this).text());
    });


    // $("#faq-category ul li").click(function(){
    //     $("input[name='category']").val($(this).text());
    // });
});
</script>  
@endpush
