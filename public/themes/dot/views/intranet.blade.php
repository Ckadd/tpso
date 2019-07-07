@extends('layouts.app')
@section('content')

<style>
    .mainmenu, footer {
        display: none;
    }
</style>

<section class="row wow fadeInDown">
    <div class="col-xs-12 banner_intranet">
        <img src="{{ Voyager::image(setting('admin.intranet_image')) }}">
    </div>
</section>

<section class="row wow fadeInDown intranet_overflow">
    <div class="container">
        <div class="row wrap_topmenuintra">
            @foreach ($menu['menuTop'] as $m)
                <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">

                    @php
                        $correct_url = false;
                    @endphp

                    @if($m['link_url'] && $m['link_url'] != "#")
                        @php
                            $correct_url = true;
                        @endphp
                    @endif

                    <a href="{{ $m['link_url'] }}" {{ !$correct_url ? "onclick='return false'" : "" }}>
                        <img src="{{ Voyager::image($m['image']) }}" alt="">
                        <span>{{ $m['title'] }}</span>
                    </a>
                </div>
            @endforeach
            {{-- <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>แผนปฏิบัติราชการ</span></a>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>แผนยุทธศาสตร์</span></a>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>กระดานท่องเที่ยว</span></a>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>อีเมลกรมการท่องเที่ยว</span></a>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>ดาวน์โหลดแบบฟอร์ม</span></a>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2 item_topmenuintra">
                <a href="#"><span>ดาวน์โหลดคู่มือ<br>การใช้โปรแกรม</span></a>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="wrap_profile">
                    <div class="profile_img" style="background-image: url('{{ isset($user_data['personel_img']) ? $server_url."/upload/user/".$user_data['personel_img'] : ThemeService::path('assets/images/blank-profile-picture.jpg') }}');"></div>
                    @if($user_data)
                        <p>ยินดีต้อนรับเข้าสู่ระบบ Intranet</p>
                        {!! isset($user_data['login_name']) ? "<h1>" . $user_data['login_name'] . "</h1>" : "" !!}
                        {!! isset($user_data['mainposition_name']) ? "<p>ตำแหน่ง : " . $user_data['mainposition_name'] . "<p>" : "" !!}
                        {!! isset($user_data['department_name']) ? "<p>กอง/สำนัก : " . $user_data['department_name'] . "<p>" : "" !!}
                        {!! isset($user_data['sub_department_info']) ? "<p>กลุ่ม : " . $user_data['sub_department_info'] . "<p>" : "" !!}
                        
                        @if(isset($user_data['main_position']) && intval($user_data['main_position']) == 4)
                            <h2>สรุปวันลา</h2>
                            <p>จำนวนวันที่ลามาแล้ว : {{ isset($user_data['employee_leave_stat']) ? "" . $user_data['employee_leave_stat'] . "" : "-" }} วัน</p>
                        @else
                            <h2>สรุปวันลา</h2>
                            <p>ลาป่วย : {{ isset($user_data['sick_leave_stat']) ? "" . $user_data['sick_leave_stat'] . "" : "-" }} วัน</p>
                            <p>ลากิจ : {{ isset($user_data['errand_leave_stat']) ? "" . $user_data['errand_leave_stat'] . "" : "-" }} วัน</p>
                            <p>ลาพักผ่อน : {{ isset($user_data['vacation_leave_stat']) ? "" . $user_data['vacation_leave_stat'] . "" : "-" }} วัน</p>
                            <p>มาสาย : {{ isset($user_data['late_stat']) ? "" . $user_data['late_stat'] . "" : "-" }} ครั้ง</p>
                            <p>ไปปฏิบัติราชการ : {{ isset($user_data['late2_stat']) ? "" . $user_data['late2_stat'] . "" : "-" }} ครั้ง</p>
                        @endif
                    @endif
                </div>
                <div class="wrap_btntopintra">
                    <a href="{{ $server_url }}/dot_system/admincp/profiles/index/{{ $user_data['id'] }}">เปลี่ยนรหัสผ่าน</a>
                    <a href="{{ route('intranet.logout') }}">ออกจากระบบ</a>
                </div>
                <div class="head_program"><h1>โปรแกรม</h1></div>
                <div class="wrap_left_menu">
                    @foreach ($menu['menuLeft'] as $m)

                        @php
                            $correct_url = false;
                        @endphp

                        @if($m['link_url'] && $m['link_url'] != "#")
                            @php
                                $correct_url = true;
                            @endphp
                        @endif

                        <form action="{{ $m['link_url'] }}" method="POST">
                            <input type="hidden" name="user" value="{{ $user_data['username'] }}">
                            <input type="hidden" name="authen" value="{{ $user_data['login_encoded'] }}">
                            <button {{ !$correct_url ? "onclick='return false'" : "" }}>
                                <img src="{{ Voyager::image($m['image']) }}" alt="">
                                <span>{{ $m['title'] }}</span>
                            </button>
                        </form>

                    @endforeach
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9 wrap_rightnewintra">
                <div class="head_topnews_intra"><h1>ข่าวกิจกรรมกรมการท่องเที่ยว</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 23]) }}">ดูทั้งหมด</a></div>
                <div class="owl-newsintra owl-carousel owl-theme">
                    @if(!empty($activity))
                        @foreach($activity as $keyactivity => $valueactivity)
                            <div class="item_newsintra">
                            <a href="{{ route('news.another.detail', ['id' => $valueactivity['id']]) }}">
                                    <figure><img src="{{ Voyager::image($valueactivity['cover_image']) }}"></figure>
                                    <figcaption>
                                        <h1 class="dotmaster">{{ $valueactivity['title'] }}</h1>
                                        <p class="dotmaster">{{ $valueactivity['short_description'] }}</p>
                                    </figcaption>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="item_newsintra">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
                    @endif
                </div>
                <div class="head_news_intra"><h1>ประกาศกรมการท่องเที่ยว</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 18]) }}">ดูทั้งหมด</a></div>
                <div class="wrap_listannounce">
                    @if(!empty($announce))
                        @foreach($announce as $keyAnnounce => $valueAnnounce)
                            <div class="listannounce">
                                {{ $valueAnnounce['title'] }}
                                <div class="wrap_btnlistannounce">
                                    <a class="listannounce_btnview" href="{{ route('news.another.detail', ['id' => $valueAnnounce['id']]) }}">View</a>
                                    <a class="listannounce_btndownload" href="{{ route('news.another.download', ['id' => $valueAnnounce['id']]) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item_announce">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
                    @endif
                </div>
                <div class="head_news_intra"><h1>ประกาศนายทะเบียน</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 19]) }}">ดูทั้งหมด</a></div>
                <div class="wrap_listannounce">
                    @if(!empty($registar))
                        @foreach($registar as $keyregistar => $valueregistar)
                            <div class="listannounce">
                                {{ $valueregistar['title'] }}
                                <div class="wrap_btnlistannounce">
                                    <a class="listannounce_btnview" href="{{ route('news.another.detail', ['id' => $valueregistar['id']]) }}">View</a>
                                    <a class="listannounce_btndownload" href="{{ route('news.another.download', ['id' => $valueregistar['id']]) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item_announce">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
                    @endif
                </div>
                <div class="head_news_intra"><h1>ประกาศจากกองการเจ้าหน้าที่</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 21]) }}">ดูทั้งหมด</a></div>
                <div class="wrap_listannounce">
                    @if(!empty($staff))
                        @foreach($staff as $keyStaff => $valueStaff)
                            <div class="listannounce">
                                {{ $valueStaff['title'] }}
                                <div class="wrap_btnlistannounce">
                                    <a class="listannounce_btnview" href="{{ route('news.another.detail', ['id' => $valueStaff['id']]) }}">View</a>
                                    <a class="listannounce_btndownload" href="{{ route('news.another.download', ['id' => $valueStaff['id']]) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item_announce">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
                    @endif
                </div>
                <div class="head_news_intra"><h1>ประกาศจากกลุ่มเทคโนโลยีสารสนเทศ</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 20]) }}">ดูทั้งหมด</a></div>
                <div class="wrap_listannounce">
                    @if(!empty($information))
                        @foreach($information as $keyInformation => $valueInformation)
                            <div class="listannounce">
                                {{ $valueInformation['title'] }}
                                <div class="wrap_btnlistannounce">
                                    <a class="listannounce_btnview" href="{{ route('news.another.detail', ['id' => $valueInformation['id']]) }}">View</a>
                                    <a class="listannounce_btndownload" href="{{ route('news.another.download', ['id' => $valueInformation['id']]) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item_announce">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
                    @endif
                </div>
                <div class="head_news_intra"><h1>หนังสือเวียนจากสารบรรณกรมการท่องเที่ยว</h1><a class="btn_newsintraviewall" href="{{ route('news.another', [23, 22]) }}">ดูทั้งหมด</a></div>
                <div class="wrap_listannounce">
                    @if(!empty($bookDot))
                        @foreach($bookDot as $keyBookDot => $valueBookDot)
                            <div class="listannounce">
                                {{ $valueBookDot['title'] }}
                                <div class="wrap_btnlistannounce">
                                    <a class="listannounce_btnview" href="{{ route('news.another.detail', ['id' => $valueBookDot['id']]) }}">View</a>
                                    <a class="listannounce_btndownload" href="{{ route('news.another.download', ['id' => $valueBookDot['id']]) }}">Download</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item_announce">
                            <p class="dotmaster">ไม่มีข้อมูล</p>
                        </div>
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
</script>

<script>
    $(document).ready(function(){
        $( '.head_program h1' ).click(function (event) {
              if (Modernizr.mq('(max-width: 767px)')) {
                  $('.wrap_left_menu').slideToggle();
              }
          event.stopPropagation();
        });   
    }); 
</script>
<script>
    $(document).ready(function(){
        asset_path = 1234;
        $(".owl-newsintra").on('changed.owl.carousel initialized.owl.carousel', function(event) {
            $(".dotmaster").trigger("update.dot");
        }).owlCarousel({
            loop:false,
            //margin:20,
            navText: ["<img src='/themes/dot/assets/images/chevron_leftgrey.png'>","<img src='/themes/dot/assets/images/chevron_rightgrey.png'>"],
            nav:false,
            dots:false,
            rewind:true,
            autoplay:true,
            autoplayTimeout:5000,
            slideBy: 1,
            responsive:{
                0:{
                    items:1,
                    margin:15,
                    //slideBy: 3
                },
                500:{
                    items:2
                },
                768:{
                    margin:25,
                    items:2
                },
                992:{
                    margin:30,
                    items:3
                },
                1025:{
                    margin:45,
                    items:3
                }
            }
        });
    });
</script>

@endpush