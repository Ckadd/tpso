@extends('layouts.app')
@section('content')
    <section class="row wow fadeInDown bordermenu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 toppage">
                    <a href="{{url('/')}}">{{__('menu_home')}}</a>
                    <div><img src="{{ ThemeService::path('assets/images/toppage_arrow.png') }}"></div>
                    <span>{{__('department_of_Tourism_Library')}}</span>
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
                                <h2>{{__('ebook_category')}}</h2>
                                <h1>EBOOK CATEGORY</h1>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container wrap_viewcolumn">
            @if(!empty($ebookCategory))
            @foreach($ebookCategory as $key => $valebook)
                <div class="row row_viewcolumn">
                @foreach($valebook as $keys => $valebookData)
                    <a href = "{{ route('ebooks.group',[ 'id' => $valebookData['id'] ]) }}" class="col-xs-12 col-sm-6 item_viewcolumn">
                        <figure>
                            @if(!empty($valebookData['image_cover']))
                            <img src="{{ asset('storage/'.$valebookData['image_cover']) ?? '' }}">
                            @else
                            <img src="{{ ThemeService::path('assets/images/default_img.png') }}">
                            @endif
                        </figure><figcaption>
                            <h1 class="dotmaster">{{$valebookData['name'] ?? ''}}</h1>
                            <div class="dotmaster">{!!$valebookData['name'] ?? '' !!}</div>
                            <div class="wrap_share">
                                <div class="contentdate">{{$valebookData['datetime'] ?? ''}}</div>
                            </div>
                        </figcaption>
                    </a>
                @endforeach
                </div>
            @endforeach
            @endif
        </div>
    </section>
    <section class="row wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <nav aria-label="Page navigation" class="nav_pagination">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">{{__('previous')}}</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">{{__('next')}}</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ ThemeService::path('assets/js/library/script.js') }}"></script>
@endpush
