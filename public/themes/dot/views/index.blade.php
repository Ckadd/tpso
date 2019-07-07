@extends('layouts.app')
@section('content')

<section class="row wow fadeInDown">
    <div class="col-xs-12 banner_slide">
        <div id="slider" class="flexslider flexslider_banner">
            <ul class="slides" style="width:10000%;transition-duration:0s;transform:translate3d(-1349px, 0px, 0px);">
                @if(!empty($gallery))                
                    @foreach($gallery as $keygallery => $valgallery)
                        @if(empty($valgallery['image']))
                            <li>
                                <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                            </li>
                        @else
                            <li>
                                <a href="{{$valgallery['link_url'] ?? '#'}}" target="_blank">
                                    <img src="{{ asset('storage/'.$valgallery['image']) }}">
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <li>
                        <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                    </li>
                @endif
            </ul>
        </div>
    </div>
</section>

<section class="row overflow_bg section_zindex">
    <div class="container">
        <div class="row">
            <hgroup class="col-xs-12 col-sm-7 permission_turism">
                @if(!empty($postPermission))
                    {!! $postPermission[0]['body'] !!}
                @else
                    <h1>{{__('data_not_found')}}</h1>
                @endif
                <a href="http://103.80.100.90/DOT-TBL/Page/Signin.aspx" target="_blank"><img src="{{ ThemeService::path('assets/images/arrow_black.png') }}"></a>
            </hgroup>
            
            <div class="col-xs-12 col-sm-5 verify_license" id="license">
                <hgroup>
                
                @if(!empty($postVerifyLicense))
                    {!! $postVerifyLicense[0]['body'] !!}
                @else
                    <h1>{{__('data_not_found')}}</h1>
                @endif

                </hgroup>
                
                <form method="post" action="#" id="formLisence">
                    @csrf
                    <!-- <input type="text" placeholder="{{__('business_travel_permit')}}"> -->
                    <select class="form-control licenseSelect" name="optionLicense">
                        <option>{{__('business_travel_permit')}}</option>
                        <option>{{__('tour_guide')}}</option>
                        <option>{{__('tour_operator_license')}}</option>
                    </select>
                    <input type="hidden" name="searchType" value="T">
                    <input type="text" name="searchParam" placeholder="{{__('fill_in_the_required_information')}}">
                    
                    <button class="btn_search_license">{{__('search')}}</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="row wow fadeInDown">
    <div class="container">
        <div class="row wrap_servicehome">
            @for($i=0; $i < 3; $i++)
                   @php (!empty($banner['bannerDot'][$i]['image'])) ? $imgBannerDot = asset('storage/'.$banner['bannerDot'][$i]['image']) 
                                                                    : $imgBannerDot = ThemeService::path('assets/images/photo_service_05.jpg');  
                   @endphp
                   @php $bannerDotUrl = (!empty($banner['bannerDot'][$i]['link_url'])) ? $banner['bannerDot'][$i]['link_url'] :  '#' ; @endphp                                                                     
                <div class="col-xs-12 col-sm-4 home_photoservice bannerDot{{$i}}">
                    <a href="{{ $bannerDotUrl }}"><img src=" {{ $imgBannerDot }}" class="img-responsive" alt=""></a>
                </div>
            @endfor
        </div>
    </div>
</section>

<section class="row wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 home_head">
                <h1>{{__('services')}}</h1>
            </div>
            <div class="col-xs-12 col-sm-3 service_detail service_desktop">
            @if(!empty($service))
                @foreach($service as $kkeyService => $valService)
                <div class="service_tab service0{{ $kkeyService + 1 }}">
                    <article>
                        {!! $valService['excerpt'] ?? ''!!}
                        
                        <a href="#"><img src="{{ ThemeService::path('assets/images/arrow_blue.png') }}"></a>
                    </article>
                    @if(!empty($valService['link']))
                        <a class="btn_readmore_service" href="{{$valService['link']}}" target="_blank">{{__('read_more')}}</a>
                    @else
                        <a class="btn_readmore_service" href="#">{{__('read_more')}}</a>
                    @endif
                </div>
                @endforeach
            @endif
            </div>
            <div class="col-xs-12 col-sm-9 wrap_service_slide service_desktop">
                <div class="owl-service owl-carousel owl-theme">
                @php $serviceKey = [0,1,2,3,4]; @endphp
                @if(!empty($service))
                    @foreach($serviceKey as $keyService => $valueService)
                        <figure class="item_service tabactive" rel="service0{{ $keyService + 1 }}">
                            @if(!empty($service[$keyService]['image']))
                                <img src="{{asset('storage/'.$service[$keyService]['image'])}}">
                                <figcaption>{{$service[$keyService]['title'] ?? ''}}<span></span></figcaption>
                            @else
                                <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                                <figcaption>{{$service[$keyService]['title'] ?? ''}}<span></span></figcaption>
                            @endif
                        </figure>
                    @endforeach
                @endif
                </div>
            </div>

            <!--ServiceMobile-->
            <div class="col-xs-12 col-sm-3 service_detail service_mobile">
            @php $serviceKey = [0,1,2,3,4]; @endphp
                @if(!empty($service))
                @foreach($serviceKey as $keyServiceMoblie => $valueServiceMoblie)
                <figure class="img_servicemobile item_service" rel="service0{{$keyServiceMoblie + 1}}">
                @if(!empty($service[$keyServiceMoblie]['image']))
                    <img src="{{ asset('storage/'.$service[$keyServiceMoblie]['image']) }}">
                @else 
                    <img src="{{ ThemeService::path('assets/images/default_img.png') }}"> 
                @endif
                    <figcaption>{{$service[$keyServiceMoblie]['title'] ?? ''}}<span></span></figcaption>
                </figure>
                <div class="service_tab service0{{$keyServiceMoblie + 1}}">
                    <article>
                        @if(!empty($service[$keyServiceMoblie]['title']))
                            {{$service[$keyServiceMoblie]['title'] ?? ''}}
                        @endif                        
                        <a href="{{$valService['link'] ?? '#'}}"><img src="{{ ThemeService::path('assets/images/arrow_blue.png') }}"></a>
                    </article>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown overflow_interest">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 home_head interesting_head">
                <h1>{{__('interesting')}}</h1>
            </div>
        </div>
        <div class="row rowinterest">
            <div class="col-xs-12 col-sm-5 hilight_interest">
                <div class="owl-hilightinterest owl-carousel owl-theme">
                @if(!empty($contentSharing) && !empty($contentSharing['Firstcontent']))
                    @for($i=0; $i < 3; $i++)
                    <figure>
                        <div class="imghilight_interest">
                        @if(!empty($contentSharing['Firstcontent']['image']))
                            <img src="{{ asset('storage/'.$contentSharing['Firstcontent']['image']) }}"></div>
                        @else
                            <img src="{{ ThemeService::path('assets/images/default_img.png') }}"></div>
                        @endif
                        <figcaption>
                            <h1 class="dotmaster">{{$contentSharing['Firstcontent']['title'] ?? ''}}</h1>
                            <p class="dotmaster">{{$contentSharing['Firstcontent']['title'] ?? ''}}</p>
                            <a href="{{route('sharing.detail',['id' => $contentSharing['Firstcontent']['id']])}}" target="_blank">{{__('read_more')}}</a>
                        </figcaption>
                    </figure>
                    @endfor
                @else
                    <h2>{{__('data_not_found')}}</h2>
                @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-7 wrap_interest">
                <div class="text-right">
                    <a href="{{ route('content.sharing') }}" class="btn_readmore_service text-right">{{__('view_all')}}</a>
                </div>
                <div class="owl-interesting owl-carousel owl-theme">
                @if(!empty($contentSharing) && !empty($contentSharing['contentlist']))
                    @foreach($contentSharing['contentlist'] as $keycontent => $valContent)
                    <div class="item_interest">
                        <figure>
                        @if(!empty($valContent['cover_image']))
                            <img src="{{ asset('storage/'.$valContent['cover_image']) }}"></figure>
                        @else
                            <img src="{{ ThemeService::path('assets/images/default_img.png') }}"></figure>
                        @endif
                        <figcaption>
                            <h1 class="dotmaster">{{$valContent['title'] ?? ''}}</h1>
                            <p class="dotmaster">{{$valContent['title'] ?? ''}}</p>
                            <a href="{{route('sharing.detail',['id' => $valContent['id']])}}" target="_blank">{{__('read_more')}}</a>
                        </figcaption>
                    </div>
                    @endforeach
                @else
                <h2>{{__('data_not_found')}}</h2>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown bg_stat">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 wrap_stat">
            @if(!empty($statistic))
                @foreach($statistic as $keystat => $valstat)
                @php 
                    $date = explode(' ',$valstat['datetime']);
                @endphp
                    <div class="item_stat">
                        <div class="stat_text">{{$valstat['title'] ?? ''}}</div>
                        <div class="stat_number">{{ number_format($valstat['stat']) ?? __('data_not_found')}} <span style="font-size:1.5rem">{{$valstat['unit'] ?? ''}}</span></div>
                        <a class="btn_stat_more" href="{{route('chart.statistic.detail',['id' => $valstat['id']])}}" target="_blank">
                        {{__('detail')}}
                        <img src="{{ ThemeService::path('assets/images/arrow_white.png') }}"><span style="margin-left:-10px;">ณ วันที่ {{ $valstat['dateChange'] ?? '' }}</span></a>    
                    </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown">
    <div class="container">
        <div class="row news_desktop">
                <div class="col-xs-5 col-sm-3 wrap_news_date">
                    <div class="date_news_tab" id="Date-management">
                        <div class="date_news">{{ $datenow[0] }} <span>{{ $datenow[1] }} {{ $datenow[2] }}</span></div>
                    </div>                    
                    <div class="wrap_news_tab">
                        @php
                        $cateArr = array('ข่าวผู้บริหาร','ข่าวจัดซื้อจัดจ้าง','ข่าวหน่วยงาน','ข่าวประชาสัมพันธ์','ข่าวรับสมัครงาน','ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์');
                            $jsonString = [];
                            if(File::exists(base_path('resources/lang/th.json'))){
                               $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                               $jsonString = json_decode($jsonString, true);
                            }
                            $title1 = '';
                            foreach ($jsonString as $key => $val) {
                               if ($val == $cateArr[0]){
                                  $title1 = __($key);
                               }else if ($val == $cateArr[1]){
                                  $title2 = __($key);
                               }else if ($val == $cateArr[2]){
                                  $title3 = __($key);
                               }else if ($val == $cateArr[3]){
                                  $title4 = __($key);
                               }else if ($val == $cateArr[4]){
                                  $title5 = __($key);
                               }else if ($val == $cateArr[5]) {
                                   $title6 = __($key);
                               }
                            }
                        @endphp
                        <div class="news_tab"><a class="active" href="#management">{{$title1}}</a></div>
                        <div class="news_tab"><a href="#hire">{{$title2}}</a></div>
                        <div class="news_tab"><a href="#department">{{$title3}}</a></div>
                        <div class="news_tab"><a href="#news">{{$title4}}</a></div>
                        <div class="news_tab"><a href="#jobposts">{{$title5}}</a></div>
                        <div class="news_tab"><a href="#guide">{{$title6}}</a></div>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-9">
                    
                    <div class="row content_news" id="management">
                    <a href="{{route('news.manager')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        @if(!empty($lastPostNews['ข่าวผู้บริหาร']))
                    <figure class="col-xs-12 col-sm-7">
                        @if(!empty($lastPostNews['ข่าวผู้บริหาร'][0]['cover_image']))
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวผู้บริหาร'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวผู้บริหาร'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster"> 
                            {{$lastPostNews['ข่าวผู้บริหาร'][0]['short_description'] ?? ''}}
                        </p>
                        <a href="{{route('news.manager.detail',['id' => $lastPostNews['ข่าวผู้บริหาร'][0]['id']])}}">{{__('read_more')}}</a><br>
                    </figcaption>
                        @endif
                    </div>

                    <div class="row content_news" id="hire">
                    <a href="{{route('news.procurement')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        @if(!empty($lastPostNews['ข่าวจัดซื้อจัดจ้าง']))
                    <figure class="col-xs-12 col-sm-7">
                        @if(!empty($lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['cover_image']))
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster">
                            {{$lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['short_description'] ?? ''}}
                        </p>
                        <a href="{{route('news.procurement.detail',['id'=>$lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['id']])}}">{{__('read_more')}}</a>
                        <br>
                    </figcaption>
                        @endif
                    </div>

                    <div class="row content_news" id="department">
                    <a href="{{route('news.institution')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                    @if(!empty($lastPostNews['ข่าวหน่วยงาน']))
                    <figure class="col-xs-12 col-sm-7">
                        @if($lastPostNews['ข่าวหน่วยงาน'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวหน่วยงาน'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวหน่วยงาน'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster">
                        {{$lastPostNews['ข่าวหน่วยงาน'][0]['short_description'] ?? ''}}
                        </p>
                        <a href="{{route('news.institution.detail',['id'=>$lastPostNews['ข่าวหน่วยงาน'][0]['id']])}}">{{__('read_more')}}</a><br>
                    </figcaption>
                    @endif
                    </div>

                    <div class="row content_news" id="news">
                    <a href="{{route('news.inform')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                    @if(!empty($lastPostNews['ข่าวประชาสัมพันธ์']))
                    <figure class="col-xs-12 col-sm-7">
                        @if($lastPostNews['ข่าวประชาสัมพันธ์'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวประชาสัมพันธ์'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวประชาสัมพันธ์'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster">
                            {{$lastPostNews['ข่าวประชาสัมพันธ์'][0]['short_description'] ?? ''}}
                        </p>
                        <a href="{{route('news.inform.detail',['id'=>$lastPostNews['ข่าวประชาสัมพันธ์'][0]['id']])}}">{{__('read_more')}}</a><br>
                    </figcaption>
                    @endif
                    </div>

                    <div class="row content_news" id="jobposts">
                    <a href="{{route('job.view')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                    @if(!empty($lastPostNews['ข่าวรับสมัครงาน']))
                    <figure class="col-xs-12 col-sm-7">
                        <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวรับสมัครงาน'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster">
                            {{$lastPostNews['ข่าวรับสมัครงาน'][0]['title'] ?? ''}}
                        </p>
                        <a href="{{route('job.detail',['id'=>$lastPostNews['ข่าวรับสมัครงาน'][0]['id']])}}">{{__('read_more')}}</a>
                        <br>
                    </figcaption>
                    @endif
                    </div>

                    <div class="row content_news" id="guide">
                    <a href="{{route('news.guide')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                    @if(!empty($lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์']))
                    <figure class="col-xs-12 col-sm-7">
                        @if($lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                    </figure>
                    <figcaption class="col-xs-12 col-sm-5">
                        <h1 class="dotmaster">{{$lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['title'] ?? ''}}</h1>
                        <p class="dotmaster">
                            {{$lastPostNews['ข่าวรับสมัครงาน'][0]['title'] ?? ''}}
                        </p>
                        <a href="{{route('news.guide.detail',['id'=>$lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['id']])}}">{{__('read_more')}}</a><br>
                    </figcaption>
                    @endif
                    </div>

                </div>
        </div>
        <div class="row news_mobile">
            <div class="col-xs-12">
                <div class="owl-newsmobile owl-carousel owl-theme">
                @if(!empty($lastPostNews['ข่าวผู้บริหาร']))
                    <div class="content_news">
                    <a href="{{route('news.manager')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('menu_executive_news')}}</h4>

                        <figure>
                        @if($lastPostNews['ข่าวผู้บริหาร'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวผู้บริหาร'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวผู้บริหาร'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{$lastPostNews['ข่าวผู้บริหาร']['dateChange']}}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวผู้บริหาร'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('news.manager.detail',['id' => $lastPostNews['ข่าวผู้บริหาร'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif

                @if(!empty($lastPostNews['ข่าวจัดซื้อจัดจ้าง']))
                    <div class="content_news">
                    <a href="{{route('news.procurement')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('menu_procurement_news')}}</h4>
                        <figure>
                        @if($lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{ $lastPostNews['ข่าวจัดซื้อจัดจ้าง']['dateChange'] }}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('news.procurement.detail',['id' => $lastPostNews['ข่าวจัดซื้อจัดจ้าง'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif

                @if(!empty($lastPostNews['ข่าวหน่วยงาน']))
                    <div class="content_news">
                    <a href="{{route('news.institution')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('menu_news_agency')}}</h4>
                        <figure>
                        @if($lastPostNews['ข่าวหน่วยงาน'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวหน่วยงาน'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวหน่วยงาน'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{ $lastPostNews['ข่าวหน่วยงาน']['dateChange'] }}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวหน่วยงาน'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('news.institution.detail',['id' => $lastPostNews['ข่าวหน่วยงาน'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif

                @if(!empty($lastPostNews['ข่าวประชาสัมพันธ์']))
                    <div class="content_news">
                    <a href="{{route('news.inform')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('menu_News')}}</h4>
                        <figure>
                        @if($lastPostNews['ข่าวประชาสัมพันธ์'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวประชาสัมพันธ์'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวประชาสัมพันธ์'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{ $lastPostNews['ข่าวประชาสัมพันธ์']['dateChange'] }}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวประชาสัมพันธ์'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('news.inform.detail',['id' => $lastPostNews['ข่าวประชาสัมพันธ์'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif

                @if(!empty($lastPostNews['ข่าวรับสมัครงาน']))
                    <div class="content_news">
                    <a href="{{route('job.view')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('jobposts')}}</h4>
                        <figure>
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวรับสมัครงาน'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{ $lastPostNews['ข่าวรับสมัครงาน']['dateChange'] }}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวรับสมัครงาน'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('job.detail',['id' => $lastPostNews['ข่าวรับสมัครงาน'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif

                @if(!empty($lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์']))
                    <div class="content_news">
                    <a href="{{route('news.guide')}}" class="btn_viewall_news" href="#">{{ __('read_all') }}</a>
                        <h4>{{__('new_guide')}}</h4>
                        <figure>
                        @if($lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['cover_image'])
                            <img src="{{ asset('storage/'.$lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['cover_image']) }}"> 
                        @else
                            <img src="{{ ThemeService::path('assets/images/managementnews.jpg') }}">
                        @endif
                        </figure>
                        <figcaption>
                            <h1 class="dotmaster">{{ $lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['title'] ?? 'ไม่มีข้อมูล' }}</h1>
                            <div class="date_newsmobile">{{ $lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์']['dateChange'] }}</div>
                            <p class="dotmaster">
                                {{ $lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['short_description'] ?? 'ไม่มีข้อมูล' }}
                            </p>
                            <a href="{{route('news.guide.detail',['id' => $lastPostNews['ข่าวธุรกิจนำเที่ยวและมัคคุเทศก์'][0]['id']])}}">อ่านต่อ</a>
                        </figcaption>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row wow fadeInDown bg_link">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 wrap_relatedlink">
                <h1>{{__('external_links')}}</h1>
                    <div class="owl-relatedlink owl-carousel owl-theme">
                        @if(!empty($banner['departmentEtc']))
                            @foreach($banner['departmentEtc'] as $valueDepartmentEtc)
                                <div class="item_relatedlink">
                                @if(!empty($valueDepartmentEtc['image']))
                                <a href="{{$valueDepartmentEtc['link_url']}}"><img src="{{ asset('storage/'.$valueDepartmentEtc['image']) }}"></a>
                                @else
                                <a href="{{$valueDepartmentEtc['link_url']}}"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                                @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
            </div>
            
            <div class="col-xs-12 col-sm-5 wrap_internaldepartment">
                <h1>{{__('Internal_link_agency')}}</h1>
                    <div class="owl-internaldepartment owl-carousel owl-theme">
                    @if(!empty($banner['departmentIn']))
                        @foreach($banner['departmentIn'] as $keyIn => $valIn)
                        <div class="item_relatedlink">
                        @if(!empty($valIn['image']))
                            <a href="{{ route('banner.url',['id' => $valIn['id']]) }}" target="_blank"><img src="{{ asset('storage/'. $valIn['image']) }}"></a>
                        @else
                            <a href="{{ route('banner.url',['id' => $valIn['id']]) }}" target="_blank"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                        @endif
                        </div>
                        @endforeach
                    @endif
                        
                    </div>
            </div>
            <div class="col-xs-12 col-sm-3 wrap_external">
                <h1>{{__('external_link')}}</h1>
                    <div class="owl-external owl-carousel owl-theme">
                    @if(!empty($banner['departmentOut']))
                        @foreach($banner['departmentOut'] as $keyIn => $valOut)
                        <div class="item_relatedlink">
                        @if(!empty($valIn['image']))
                            <a href="{{ route('banner.url',['id' => $valOut['id']]) }}" target="_blank"><img src="{{ asset('storage/'.$valOut['image']) }}"></a>
                        @else
                            <a href="{{ route('banner.url',['id' => $valOut['id']]) }}" target="_blank"><img src="{{ ThemeService::path('assets/images/default_img.png') }}"></a>
                        @endif
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
<script>
var asset_path = "{{ ThemeService::path('assets') }}";
var timeOutBanner = "{{setting('site.banner_slide')}}";
</script>
<script type="text/javascript">
$(function(){
  SyntaxHighlighter.all();
});
$(window).on( "load", function() {
$('.flexslider_banner').flexslider({
	animation: "slide",
	controlNav: true, //Boolean: Create navigation for paging control of each slide? Note: Leave true for manualControls usage
	directionNav: true,
	slideshowSpeed: 7000,
	animationSpeed: 2500,
	start: function(slider){
        $(".dotmaster").trigger("update.dot");
	}
  });
  $('.permission_turism').click(function() {
        window.open('http://103.80.100.90/DOT-TBL/Page/Signin.aspx');
  });
});
</script>
<script src="{{ ThemeService::path('assets/js/index/form.js') }}"></script>

<script>
    jQuery(document).ready(function() {
        $("form#formLisence").submit(function(event) {
            // var data = $('form#formLisence').serializeArray();
            $("form#formLisence").attr("action", "http://103.80.100.92:8087/mobiletourguide/info/license/tour/read");
        });
    });
</script>
@endpush
