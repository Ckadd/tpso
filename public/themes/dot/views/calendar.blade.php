@extends('layouts.app')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css" type="text/css" rel="stylesheet" />
<style>
.notCalendar {
    display:none;
}
#bootstrapModalFullCalendar {
    margin-top:30px;
}
#btn-calendar:hover {
    cursor: pointer;
}
</style>
@endpush
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('event_calendar')}}</span>
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
                            <h2>{{__('event_calendar')}}</h2>
                            <h1>calendar</h1>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown zindexcalendar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_calendarsearch">
                <form method="get" action="{{route('calendar.search')}}" style="display:inline;">
                @csrf
                <div class="select_calendar select_cate">
                    <span>{{__('select_categories')}}</span>
                    @php
                        $jsonString = [];
                        if(File::exists(base_path('resources/lang/th.json'))){
                            $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                            $jsonString = json_decode($jsonString, true);
                        }
                    @endphp
                    <ul>
                        @foreach($category as $keycategory => $valcategory)
                            @php
                                $title = '';
                                foreach ($jsonString as $key => $val) {
                                    if($valcategory['title'] == $val){
                                       $title = __($key);
                                       break;
                                    }
                                }
                            @endphp
                            @if(!empty($title))
                                <li>{{$title}}</li>
                            @endif
                        @endforeach
                    </ul>
                    <input type="hidden" name="category"> 
                </div><div class="select_calendar select_month">
                    <span>{{__('select_month')}}</span>
                    <ul>
                        @foreach($month as $keymonth => $valmonth)
                            <li>{{$valmonth->Month}}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="month"> 
                </div><button type="submit" class="btn_calendar_search">{{__('search')}}</button></form>
                <!-- <a href="#" id="btn-calendar" class="btn btn-primary" target="_self">Calendar</a> -->
                <div id="btn-calendar" style="display:inline;">
                    <button type="button" class="btn_calendar_search" style="width: 50px;height: 44px;">
                        <i class="glyphicon glyphicon-calendar" style="color: #ffffff; font-size:30px;margin-top: 4px;"></i>
                    </button>
                </div>

                <!-- calendar -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">                            
                            <div id="bootstrapModalFullCalendar" class="notCalendar"></div>
                        </div>
                    </div>
                </div>
                <!-- endcalendar -->
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown sc-detail">
<input type="hidden" name="urldetail" data-url="{{route('calendar.view').'/detail/'}}">
    <div class="container">
        <div class="row hilight_calendar">

        @if(!empty($order1))
            <figure class="col-xs-12 col-sm-6">
                <a href="{{route('calendar.detail',['id' => $order1['id']])}}"><img src="@if(empty($order1['cover_image'])) {{ThemeService::path('assets/images/default_img.png')}} @else {{asset('storage/'.$order1['cover_image'])}} @endif"></a>
            </figure>
            <figcaption class="col-xs-12 col-sm-6">
            
                <div class="hlc_date">{{ $dateFirst[0] ?? 0 }}<span>{{ $dateFirst[1] ?? 0 }} <br>{{ $dateFirst[2] ?? 0 }}</span></div>
                <h1>{{$order1['title'] ?? ''}}</h1>
                {!! $order1['short_description'] ?? '' !!}
                <div class="wrap_share">
                    <a class="btn_like" href="{{route('calendar.detail',['id' => $order1['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook.png') }}"><span>230</span></a><a class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span>0</span></a><a class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_gplusshare.png') }}"><span>0</span></a>
                </div>
            </figcaption>
        @endif
        </div>
        <div class="row row_item_calendar">
        @if(count($alldata) > 0)
            @foreach($alldata as $val)
            <div class="col-xs-12 col-sm-4 item_calendar">
                <figure>
                    <a href="{{route('calendar.detail',['id'=>$val['id']])}}"><img src="@if(empty($val['cover_image'])) {{ThemeService::path('assets/images/default_img.png')}} @else {{asset('storage/'.$val['cover_image'])}} @endif"></a>
                </figure>
                <figcaption>
                    <h1 class="dotmaster">{{$val['title'] ?? ''}}</h1>
                    <h5>{{$val['datetime']}}</h5>
                    <a href="{{route('calendar.detail',['id'=>$val['id']])}}" class="btnmore">
                        {{__('detail')}}
                    </a>
                </figcaption>
            </div>
            @endforeach
        @endif
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav aria-label="Page navigation" class="nav_pagination">
                    <div>
                        @if(count($alldata) > 0)
                            {{ $alldata->links() }}
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>

    <div id="fullCalModal" class="modal fade" style="z-index:9999999; margin-top:90px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">{{__('close')}}</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <a class="btn btn-primary" id="eventUrl" target="_blank">{{__('event_page')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>

<script>
$(document).ready(function(){    
    $('title').text('ปฏิทินกิจกรรม');
    $( '.select_calendar span' ).click(function (event) {
	  if (  $( this ).siblings('ul').is( ":hidden" ) ) {
            $('.select_calendar').children('ul').slideUp();
            $( this ).siblings('ul').slideDown();
	  } else {
          $('.select_calendar').children('ul').slideUp();
	  }
        event.stopPropagation();
	});
    $( '.select_calendar ul li' ).click(function (event) {
        var textselect = $(this).text();    
        $(this).parent('ul').siblings('span').text(textselect);
        $('.select_calendar').children('ul').slideUp();
	  event.stopPropagation();
	});
    $( "html" ).click(function (event) {
         $('.select_calendar').children('ul').slideUp();
    });
    
    $(".select_cate  ul  li").click(function(){
        $('input[name=category]').val($(this).text());
    });

    $(".select_month  ul  li").click(function(){
        $('input[name=month]').val($(this).text());
    });
});
</script>   

<script>
        $(document).ready(function() {
            var contentUrl = $("input[name=urldetail]").data('url');
           $("#btn-calendar").click(function(){
               if($("#bootstrapModalFullCalendar").is(":hidden")) {
                $("#bootstrapModalFullCalendar").removeClass('notCalendar');
                $(".sc-detail").addClass('notCalendar');
                $('#bootstrapModalFullCalendar').fullCalendar({
                    header: {
                        left: '',
                        center: 'prev title next',
                        right: ''
                    },
                    eventClick:  function(event, jsEvent, view) {
                        $('#modalTitle').html(event.title);
                        $('#modalBody').html(event.description);
                        $('#eventUrl').attr('href',event.url);
                        $('#fullCalModal').modal();
                        return false;
                    },
                    events:
                    [
                        <?php 
                            if(!empty($fullContent)){
                            foreach($fullContent as $keyall => $valall) {
                                ?>
                            {
                                title : '<?php echo $valall['title'] ?? '' ?>',
                                start : '<?php echo $valall['datetime'] ?? '0000-00-00'?>',
                                description : '<?php echo $valall['short_description'] ?? ''?>',
                                url : contentUrl+'<?php echo $valall['id'] ?>',
                            },
                        <?php } }?>
                    
                    ],
                    eventBackgroundColor:'#99ABEA',
                    eventTextColor:'#000000',
                    eventBorderColor:'##5173DA',
                    timeFormat: 'H(:mm)',
                    
                });
               }else {
                $("#bootstrapModalFullCalendar").addClass('notCalendar');
                $(".sc-detail").removeClass('notCalendar');
               }
           });
            
        });
    </script>
@endpush
