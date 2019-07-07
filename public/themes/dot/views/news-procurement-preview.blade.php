@extends('layouts.app')
@section('content')
<section class="row wow fadeInDown bordermenu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 toppage">
            <a href="{{url('/')}}">{{__('menu_home')}}</a>
            <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div><span>{{__('menu_procurement_news')}}</span>
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
                            <h2>{{__('menu_procurement_news')}}</h2>
                            <h1>Purchase news</h1>
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
            <div class="col-xs-12 procurement_preview_head">
                <h1>{{$alldata['title'] ?? ''}}</h1>
                <div class="wrap_share">
                @php $date = explode(" ",$alldata['datetime']);  @endphp
                    <div class="viewno">{{($views) - 1 ?? 0}}</div><div class="contentdate">{{ $date[0] ?? '0000-00-00' }}</div><span></span><a class="btn_like" href="{{route('procurement.share.facebook',['id'=>$alldata['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_facebook.png') }}"><span>0</span></a><a class="btn_like" href="{{route('procurement.share.twitter',['id'=>$alldata['id']])}}"><img src="{{ ThemeService::path('assets/images/content_sharing_tweet.png') }}"><span>0</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 img_pcm_preview">
                @if(!empty($alldata['image']))
                    @php $image = json_decode($alldata['image']); @endphp
                    @if(!empty($image))
                        @foreach($image as $valueImage)
                            <img src="{{ asset('storage/'.$valueImage) }}">
                        @endforeach
                    @endif
                @endif
                @if(!empty($alldata))
                    {!! $alldata['full_desscription'] ?? '' !!}
                @endif
            </div>
            <div class="col-xs-12 wrap_pcm_preview_download">
                @for($i=1; $i < 6; $i++)
                    @if(!empty($alldata['file'.$i]))
                        <a href="{{route('news.procurement.detaildownload',['id' => $alldata['id'], 'filename'=>'file'.$i])}}" target="_blank">
                        {{__('download_documents')}} {{$i}}
                        </a>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

<script src="{{ ThemeService::path('assets/js/new-procurement-preview/script.js') }}"></script>
@endpush