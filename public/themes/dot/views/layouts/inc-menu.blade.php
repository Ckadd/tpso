<nav class="row mainnavbar wow fadeInDown">
    <div class="col-xs-12 top_bar">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 wrap_top_dot">
                        <div class="wrap_top_select">
                        <div class="select_text">For Blindness</div>
                            <div class="wrap_select_item">
                                <div class="default">Default</div>
                                <div class="blackwhite">Black White</div>
                                <div class="blackyellow">Black Yellow</div>
                            </div>
                        </div>
                        <div class="wrap_top_select">
                            <div class="select_text">{{__('font_size')}}</div>
                            <div class="wrap_select_item">
                                <div class="fontsize_s">S</div>
                                <div class="fontsize_m active">M</div>
                                <div class="fontsize_l">L</div>
                            </div>
                        </div>
                        <a class="icon_topred" href="#"><img src="{{ ThemeService::path('assets/images/icon_redtop.png') }}"></a>
                        <div class="wrap_top_select">
                            <div class="select_text" style="text-transform: uppercase;">
                                <img src="{{ ThemeService::path('assets/images/icon_'.App::getLocale().'.png') }}"> {{App::getLocale()}}
                            </div>
                            <div class="wrap_select_item">
                                @php
                                    $languages = DB::table('languages')->get();
                                @endphp
                                @foreach($languages as $language)
                                <div class="lang @if(App::getLocale() == $language->code) active @endif" data-id="{{url('change/'.$language->code)}}" style="text-transform: uppercase;">
                                    <img src="{{ ThemeService::path('assets/images/icon_'.$language->code.'.png') }}"> {{$language->code}}
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <a class="link_facebook" href="https://www.facebook.com/Deptourism" target="_blank"><img src="{{ ThemeService::path('assets/images/icon_facebook.png') }}"></a>
                        <form class="link_search" action="/search">
                            {{__('search')}}
                            <div class="search_box">
                                <input type="text" name="q"><button class="btn_search"></button><button class="btn_close"></button>
                            </div>
                        </form>
                        <a class="link_intranet" href="{{route('intranet')}}">INTRANET</a>
                        @if(session()->get('status_login'))
                            <a class="link_intranet_logout" href="{{url('intranet/logout')}}">
                                <span class="glyphicon glyphicon-off"></span> Logout
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-4 logo"><a href="{{route('index')}}"><img src="{{ ThemeService::path('assets/images/logo.svg') }}"></a></div>
            <div class="col-xs-6 col-sm-8 mainmenu">
                <div class="btn_menu"><img src="{{ ThemeService::path('assets/images/icon_menu.png') }}"><div class="btn_menu_text">MENU</div></div>
                    @if(!empty(menu('top-menu')))
                        {{ menu('top-menu','bootstrap') }}
                    @endif
                <div class="clone-submenu">
                <div class="submenu">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 submenu_left">
                                <hgroup>
                                    <h1>INTERNAL</h1>
                                    <h2>DEPARTMENT</h2>
                                </hgroup>
                                <h3>หน่วยงานภายใน</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#">รายละเอียด</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 submenu_mid">
                                @if(!empty(menu('sub-internalMenu')))
                                    {{ menu('sub-internalMenu','bootstrap') }}
                                @endif
                            </div>
                            <div class="col-xs-12 col-sm-3 submenu_right">
                                <img src="{{ ThemeService::path('assets/images/submenu.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script src="{{ ThemeService::path('assets/js/inc-menu/form.js') }}"></script>
