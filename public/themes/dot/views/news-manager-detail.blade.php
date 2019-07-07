@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <a href="#">{{__('menu_executive_news')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div><span>{{__('repair_at_creative_places_to_visit')}}</span>
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
                                <h2>{{__('menu_executive_news')}}</h2>
                                <h1>NEWS MANAGER</h1>
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
            <div class="col-xs-12 col-sm-6 wrap_news_slide">
                @if(!empty($alldata))
                <div id="slider" class="flexslider">
                    <ul class="slides">
                    @php $i = 1; @endphp
                    @while($i <= 4)
                    @if(!empty($alldata['image']))
                        @php $image = json_decode($alldata['image']); @endphp
                        @if(!empty($image))
                            @foreach($image as $valueImage)
                                <li>
                                    <img src="{{ asset('storage/'.$valueImage) }}">
                                </li>
                            @endforeach
                        @endif
                    @else
                            <li>
                                <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                            </li>
                        @endif
                    @php $i++ @endphp
                    @endwhile
                    </ul>
                </div>
                <div id="carousel" class="flexslider">
                    <ul class="slides">
                    @php $i = 1; @endphp
                    @while($i <= 4)
                    @if(!empty($alldata['image']))
                        @php $image = json_decode($alldata['image']); @endphp
                        @if(!empty($image))
                            @foreach($image as $valueImage)
                                <li>
                                    <img src="{{ asset('storage/'.$valueImage) }}">
                                </li>
                            @endforeach
                        @endif
                    @else
                        <li>
                            <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                        </li>
                    @endif
                    @php $i++ @endphp
                    @endwhile
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-6 wrap_news_detail">
                {!! $alldata['short_description'] ?? '' !!}
                {!! $alldata['full_desscription'] ?? '' !!}
            </div>

                <!-- form download -->
                <div class="col-xs-12 wrap_pcm_preview_download">
                    @for($i=1; $i < 6; $i++)
                        @if(!empty($alldata['file'.$i]))
                            <a href="{{route('news.manager.detaildownload',['id' => $alldata['id'], 'filename'=>'file'.$i])}}" target="_blank">ดาวน์โหลดเอกสาร {{$i}}</a>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- news related -->
    <section class="row bg_related_content wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 head_related_content">
                    <h1>RELATED CONTENT</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="owl-news owl-carousel owl-theme">
                        @if(!empty($newRelated))
                            @foreach($newRelated as $keyRelate => $valueRelate)
                                <div>
                                
                                    <figure class="detail_news_item">
                                    <a href="{{ route('news.manager.detail',['id'=>$valueRelate['id']]) }}">
                                    @if(!empty($valueRelate['cover_image']))
                                        <img src="{{ asset('storage/'.$valueRelate['cover_image']) }}">
                                    @else
                                        <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                                    @endif
                                    </a>
                                        <figcaption>
                                            <h4 class="dotmaster">{{ $valueRelate['title'] ?? '' }}</h4>
                                            <p class="dotmaster">{{ $valueRelate['short_description'] ?? '' }}</p>
                                        </figcaption>
                                        <a href="{{ route('news.manager.detail',['id'=>$valueRelate['id']]) }}" class="btnmore">อ่านต่อ</a>
                                    </figure>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/new-manager-detail/script.js') }}"></script>
@endpush