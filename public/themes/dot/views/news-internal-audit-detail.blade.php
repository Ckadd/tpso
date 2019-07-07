@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                <a href="{{url('/')}}">{{__('menu_home')}}</a><div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <a href="#">{{__('knowledge_about_tourism')}}</a>
                    <div>
                    <img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}">
                    </div>
                    <span>{{ (!empty($category)) ? $category['name'] : '' }}</span>
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
                            @if(!empty($category))
                                <h2>{{ $category['name'] }}</h2>
                                <h1>ANOTHER</h1>
                            @endif
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
                        <h1>{{ $alldata['title'] ?? '' }}</h1>
                        
                            @php 
                                $date = explode(" ",$alldata['datetime']);
                            @endphp
                        @if(!empty($alldata) && !empty($category))
                        <div class="wrap_share">
                        <div class="viewno">{{($view['view']) - 1 ?? 0}}</div><div class="contentdate">{{$date[0] ?? '0000-00-00'}}</div><span></span><a class="btn_like" href="{{route('internal.share.facebook',['id' => $alldata['id'],'idCategory' => $category['id']])}}" target="_blank"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook_share.png') }}"><span>{{ $view['facebook'] ?? 0 }}</span></a><a class="btn_like" href="{{route('internal.share.twitter',['id' => $alldata['id'],'idCategory' => $category['id']])}}" target="_blank"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span>{{$view['twitter'] ?? 0}}</span></a><a style="display:none;" class="btn_like" href="#"><img src="{{ ThemeService::path('assets/images/content_sharing_pinit.png') }}"><span>0</span></a>
                        </div>
                        @endif
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

                <!-- form download -->
                <div class="col-xs-12 wrap_pcm_preview_download">
                    @for($i=1; $i < 6; $i++)
                        @if(!empty($alldata['file'.$i]))
                            <a href="{{route('news.inform.detaildownload',['id' => $alldata['id'], 'filename'=>'file'.$i])}}" target="_blank">{{__('download_documents')}} {{$i}}</a>
                        @endif
                    @endfor
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/new-inform-detail/script.js') }}"></script>
@endpush