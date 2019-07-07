
<div class="bg_sidebar">
    <div class="btn_menusb"><div class="btn_menu_text">เมนูหน่วยงานภายใน</div></div>
    <ul class="sidebar">
    @if(!empty($menu))
        @foreach($menu as $keyMenu => $valMenu)
            @php
                $jsonString = [];
                   if(File::exists(base_path('resources/lang/th.json'))){
                       $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                       $jsonString = json_decode($jsonString, true);
                   }
                   $titleValMenu = $valMenu['tile'];
                   foreach ($jsonString as $key => $val) {
                       if($valMenu['tile'] == $val){
                          $titleValMenu = __($key);
                          break;
                       }
                   }
            @endphp
            @if(!empty($valMenu['menusub']))
                <li class="sb_hassub">
                    <a>
                        {{$titleValMenu}}
                    </a>
                    <ul class="sb_sub">
                    
                    @foreach($valMenu['menusub'] as $keysub => $valsub)
                        @php
                            $jsonString = [];
                               if(File::exists(base_path('resources/lang/th.json'))){
                                   $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                                   $jsonString = json_decode($jsonString, true);
                               }
                               $titleValsub = $valsub['tile'];
                               foreach ($jsonString as $key => $val) {
                                   if($valsub['tile'] == $val){
                                      $titleValsub = __($key);
                                      break;
                                   }
                               }
                        @endphp
                        @if(!empty($valsub['link']) && $valsub['link'] != "#")
                        <li>
                            <a href="http://{{ $valsub['link'] ?? '#'}}" target="_blank">
                                {{$titleValsub}}
                            </a>
                        </li>
                        @else
                        <li><a>{{$titleValsub}}</a></li>
                        @endif
                    @endforeach
                    </ul>
                </li>
            @else
                @if(!empty($valMenu['link']) && $valMenu['link'] != "#")
                <li>
                    <a href="http://{{ $valMenu['link'] ?? '#'}}" target="_blank">
                        {{$titleValMenu}}
                    </a>
                </li>
                @else
                <li>
                    <a>{{$titleValMenu}}</a>
                </li>
                @endif
            @endif
        @endforeach
    @else
        <li><a>ไม่มีข้อมูล</a></li>
    @endif
    </ul>
</div>
