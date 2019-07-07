@if(!isset($innerLoop))
<ul class="nav navbar-nav">
@else
<ul class="dropdown-menu">
@endif

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

@foreach ($items as $item)

    @php

        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }

        $listItemClass = null;
        $linkAttributes =  null;
        $styles = null;
        $icon = null;
        $caret = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // With Children Attributes
        if(!$originalItem->children->isEmpty()) {
            $linkAttributes =  'class="dropdown-toggle" data-toggle="dropdown"';
            $caret = '<span class="caret"></span>';

            if(url($item->link()) == url()->current()){
                $listItemClass = 'dropdown active';
            }else{
                $listItemClass = 'dropdown';
            }
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }

    @endphp

    {{--/@dd($jsonString['Internal_link_agency']);--}}
    <li class="{{ $listItemClass }}">
        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}" {!! isset($linkAttributes) ? $linkAttributes : '' !!}>
            {!! $icon !!}
            @php
                $jsonString = [];
                if(File::exists(base_path('resources/lang/th.json'))){
                    $jsonString = file_get_contents(base_path('resources/lang/th.json'));
                    $jsonString = json_decode($jsonString, true);
                }
                $title = '';
                foreach ($jsonString as $key => $val) {
                    //dd($val.'--'.$key);
                    if($item->title == $val){
                       $title = __($key);
                       break;
                    }
                }
            @endphp
            <span>{{ ($title == '')? $item->title : $title }}</span>
            {!! $caret !!}
        </a>
        @if(!$originalItem->children->isEmpty())
        @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
        @endif
    </li>
@endforeach

</ul>
