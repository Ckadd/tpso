<div class="bg_sidebar">
    <div class="btn_menusb"><div class="btn_menu_text">เมนูสถิติ</div></div>
    <ul class="sidebar">
        @if(!empty($group))
            @foreach($group as $keyGroup => $valueGroup)
                @if(!empty($valueGroup['category']))
                <li class="sb_hassub">
                    @php
                        $jsonString = [];
                           if(File::exists(base_path('resources/lang/th.json'))){
                               $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                               $jsonString = json_decode($jsonString, true);
                           }
                           $titleValueGroup = $valueGroup['name'];
                           foreach ($jsonString as $key => $val) {
                               if($valueGroup['name'] == $val){
                                  $titleValueGroup = __($key);
                                  break;
                               }
                           }
                    @endphp
                    <a>{{ $titleValueGroup ?? '' }}</a>
                    <ul class="sb_sub">
                        @foreach($valueGroup['category'] as $keyCategory => $valueCategory)
                            @php
                                $jsonString = [];
                                   if(File::exists(base_path('resources/lang/th.json'))){
                                       $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                                       $jsonString = json_decode($jsonString, true);
                                   }
                                   $titleValueCate = $valueCategory['name'];
                                   foreach ($jsonString as $key => $val) {
                                       if($valueCategory['name'] == $val){
                                          $titleValueCate = __($key);
                                          break;
                                       }
                                   }
                            @endphp
                            <li>
                                <a href="{{ route('dotStat.menuId',['id' => $valueCategory['id']]) }}">{{ $titleValueCate ?? '' }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @else
                    <li><a>{{ $valueGroup['name'] ?? '' }}</a></li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
