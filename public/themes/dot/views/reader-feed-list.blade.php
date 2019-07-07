@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown">
        <div class="col-xs-12 head_cshare_bgblue">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 head_cshare_detail">
                            <hgroup>
                                <h2>READER RSS</h2>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container">
            <h3 style="text-transform: uppercase;">{{$res->title}}</h3>
            <div class="row p-2" style="margin-top: 15px; margin-bottom: 20px;">
            <div class="col-sm-12 contpost">
                <div class="row">
                    @foreach($data->channel->item as $item)
                    <div class="col-sm-3">
                        <a href="{{$item->link}}" class="thumbnail">
                            <img src="{{$item->enclosure['url']}}" alt="ซื้อทัวร์อย่างไร ไม่ให้โดนหลอก" style="max-height: 180px;">
                        </a>
                    </div>
                    <div class="col-sm-9 set-h-180">
                        <div class="col PostTitle">

                            <h4>
                                <a href="{{$item->link}}">
                                   {{$item->title}}
                                </a>
                            </h4>
                        </div>
                        <p></p>
                        <p>{{$item->description}}</p>
                        <p></p>
                        <div class="wrap_share">
                            <div class="contentdate">{{$item->pubDate}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>

    </section>
    <style>
        .wrap_share {
            display: block;
            margin-top: 0px;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .set-h-180 {
            min-height: 180px;
        }
    </style>
@endsection

