@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                <span>{{__('board_of_Directors')}}</span>
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
                            <h2>{{__('board_of_Directors')}}</h2>
                            <h1>Executives</h1>
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
            <div class="col-xs-12 orchart_detail_top">
                <figure>
                    <img src="{{ asset('storage/'. $dataDetail['image']) }}">
                </figure><figcaption>
                    <hgroup>
                        <h2>{{__('executive_information')}} {{$dataDetail['position'] ?? ''}}</h2>
                        <h1>{{$dataDetail['first_name'] ." ". $dataDetail['last_name']}}</h1>
                        <h3>ตำแหน่ง : {{$dataDetail['position'] ?? ''}}</h3>
                    </hgroup>
                    <h4>{{__('contact_information')}}</h4>
                    {!! $dataDetail['contact'] ?? '' !!}
                </figcaption>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 wrap_ogchart_detail">
                <div class="border_ogchart_detail">
                    <div class="ogchart_detail_item">
                        <h1>{{__('history_of_education')}}</h1>
                    </div>
                    <div class="ogchart_detail">
                    {!! $dataDetail['education_history'] ?? '' !!}
                    </div>
                </div>
                <div class="border_ogchart_detail">
                    <div class="ogchart_detail_item">
                        <h1>{{__('caree_History')}}</h1>
                    </div>
                    <div class="ogchart_detail">
                    {!! $dataDetail['work_history'] ?? '' !!}
                    </div>
                </div>
                <div class="border_ogchart_detail">
                    <div class="ogchart_detail_item">
                        <h1>{{__('training_history_seminar_work_visit')}}</h1>
                    </div>
                    <div class="ogchart_detail">
                    {!! $dataDetail['train_history'] ?? '' !!}
                    </div>
                </div>
                <div class="border_ogchart_detail">
                    <div class="ogchart_detail_item">
                        <h1>{{__('history_Get_royal')}}</h1>
                    </div>
                    <div class="ogchart_detail">
                    {!! $dataDetail['insignia_history'] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
 <script>
$( document ).ready(function() {
    $('.ogchart_detail_item').click(function (event) {
      if (  $( this ).siblings('.ogchart_detail').is( ":hidden" ) ) {
            var tbox = $(this);
            $('.ogchart_detail_item').removeClass('active');
            $(this).addClass("active");
            $('.ogchart_detail').slideUp();
            $( this ).siblings('.ogchart_detail').slideDown({
            complete: function(){
                    $("html, body").animate({ scrollTop: $( tbox ).offset().top - 10 }, 1000);
                }
            });
      } else {
          $('.ogchart_detail_item').removeClass('active');
          $('.ogchart_detail').slideUp();
      }
      event.stopPropagation();
    });
});
</script>
@endpush
