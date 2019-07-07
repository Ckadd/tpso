@php
    $langs = DB::table('languages')->orderBy('name', 'asc')->get();
@endphp
<div class="form-group  col-md-12">
    <div class="radio"> Languages :
        <input type="hidden" name="master_id" value="{{Request::query('id')}}">
        @if(Request::segment(4) == 'edit')
            @php
                $mp_langs = DB::table('mapping_langs')
                ->where('master_id', Request::segment(3))
                 ->where('module', Request::segment(2))
                ->get();
                $arr_code_lang = array();
                if(count($mp_langs)>0){
                    foreach ($mp_langs as $mp_lang){
                        array_push($arr_code_lang,$mp_lang->code_lang);
                    }
                }
            @endphp

            @foreach($langs as $lang)
                @if(in_array($lang->code, $arr_code_lang))
                    <?php
                    $mp = DB::table('mapping_langs')
                        ->where('master_id', Request::segment(3))
                        ->where('code_lang', $lang->code)
                        ->where('module', Request::segment(2))
                        ->first();
                    if (empty($mp->parent_id)) {
                        $id = $mp->master_id;
                    } else if (!empty($mp->master_id) && !empty($mp->parent_id)) {
                        $id = $mp->master_id;
                    } else {
                        $id = $mp->parent_id;
                    }
                    ?>
                    <a href="{{url('admin/'.Request::segment(2).'/'.$id.'/edit')}}"
                       class="btn {{active_lang($mp->code_lang,$lang->code)}}">
                        {{$lang->name}}
                    </a>

                @else
                    @php
                        $mp_lang = DB::table('mapping_langs')
                        ->where('master_id', Request::segment(3))
                        ->whereNotNull('parent_id')
                        ->where('module', Request::segment(2))
                        ->first();
                    @endphp
                    @if(isset($mp_lang) && $mp_lang->code_lang == $lang->code)
                        @if($mp_lang->code_lang == 'th')
                            <a href="{{url('admin/'.Request::segment(2).'/'.$id.'/edit')}}"
                               class="btn {{active_lang($mp_lang->code_lang,$lang->code)}}">
                                {{$lang->name}} ***
                            </a>
                        @else
                            <a href="{{url('admin/'.Request::segment(2).'/'.$id.'/edit')}}"
                               class="btn {{active_lang($mp_lang->code_lang,$lang->code)}}">
                                {{$lang->name}} **
                            </a>
                        @endif
                    @else
                        @if($lang->code == 'th')
                            <a href="{{url('admin/'.Request::segment(2).'/'.$mp->parent_id.'/edit')}}"
                               class="btn {{active_lang('',$lang->code)}}">
                                {{$lang->name}}
                            </a>
                        @else
                            @php
                                $mp_lang = DB::table('mapping_langs')
                                ->where('parent_id', Request::segment(3))
                                ->where('code_lang', $lang->code)
                                ->where('module', Request::segment(2))
                                ->first();
                            @endphp

                            @if(isset($mp_lang))
                                <a href="{{url('admin/'.Request::segment(2).'/'.$mp_lang->master_id.'/edit')}}"
                                   class="btn {{active_lang($mp_lang->code_lang,'th')}}">
                                    {{$lang->name}}
                                </a>
                            @else
                                <a href="{{url('admin/'.Request::segment(2).'/create?lang='.$lang->code.'&id='.Request::segment(3))}}"
                                   class="btn {{active_lang('',$lang->code)}}">
                                    {{$lang->name}}
                                </a>
                            @endif

                        @endif
                    @endif
                @endif
            @endforeach
        @else
            @foreach($langs as $lang)
                @if(Request::input('lang'))
                    <label>
                        <input type="radio" name="_lang" value="{{$lang->code}}"
                               @if(Request::input('lang') == $lang->code) checked @else disabled @endif> {{$lang->name}}
                    </label>
                @else
                    <label>
                        <input type="radio" name="_lang" value="{{$lang->code}}" @if('th' == $lang->code) checked
                               @else disabled @endif> {{$lang->name}}
                    </label>
                @endif
            @endforeach
        @endif

    </div>
</div>
@php
    function active_lang($tb_mp_lang='',$lang_code){
        if($tb_mp_lang == $lang_code){
         return 'btn-info';
        }
        return 'btn-default';
    }
@endphp

