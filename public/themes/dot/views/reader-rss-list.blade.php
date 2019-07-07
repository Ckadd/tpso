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
            <h3 style="text-transform: uppercase;">{{$str}}</h3>
            <div class="row p-2" id="data" style="margin-top: 15px; margin-bottom: 20px;">
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
        .set-h-180{
            min-height: 180px;
        }
    </style>
@endsection
@push('scripts')
    <script type="application/javascript">
        $(document).ready(function() {
            //feed to parse
            var feed = "{{$rss_url}}";
            $.ajax(feed, {
                accepts:{
                    xml:"application/rss+xml"
                },
                dataType:"xml",
                success:function(data) {
                    //Credit: http://stackoverflow.com/questions/10943544/how-to-parse-an-rss-feed-using-javascript
                    $(data).find("item").each(function () { // or "item" or whatever suits your feed
                        var el = $(this);
                        /*console.log("------------------------");
                        console.log("img      : " + el. find("enclosure").attr('url'));
                        console.log("title      : " + el.find("title").text());
                        console.log("link       : " + el.find("link").text());
                        console.log("description: " + el.find("description").text());*/
                        var el_html = '<div class="col-sm-12 contpost"><div class="row"><div class="col-sm-3"> <a href="'+el.find("link").text()+'" class="thumbnail"> <img src="'+el. find("enclosure").attr('url')+'" alt="'+el.find("title").text()+'" style="max-height: 180px;"> </a></div><div class="col-sm-9 set-h-180"><div class="col PostTitle"><h4><a href="'+el.find("link").text()+'">'+el.find("title").text()+'</a></h4></div><p>'+el.find("description").text()+'</p><div class="wrap_share"><div class="contentdate">'+el.find("pubDate").text()+'</div></div></div></div></div>'
                        $('#data').append(el_html);
                    });


                }
            });

        });

    </script>
@endpush
