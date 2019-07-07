@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
            </a>
        @endcan

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    @foreach($dataType->readRows as $row)
                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->display_name }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if($row->type == "image")
                                <img class="img-responsive"
                                     src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                            @elseif($row->type == 'multiple_images')
                                @if(json_decode($dataTypeContent->{$row->field}))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                        <img class="img-responsive"
                                             src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}">
                                    @endforeach
                                @else
                                    <img class="img-responsive"
                                         src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                @endif
                            @elseif($row->type == 'relationship')
                                 @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                            @elseif($row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                                    !empty($row->details->options->{$dataTypeContent->{$row->field}})
                            )
                                <?php echo $row->details->options->{$dataTypeContent->{$row->field}};?>
                            @elseif($row->type == 'select_dropdown' && $dataTypeContent->{$row->field . '_page_slug'})
                                <a href="{{ $dataTypeContent->{$row->field . '_page_slug'} }}">{{ $dataTypeContent->{$row->field}  }}</a>
                            @elseif($row->type == 'select_multiple')
                                @if(property_exists($row->details, 'relationship'))

                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                        @if($item->{$row->field . '_page_slug'})
                                            <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field}  }}</a>@if(!$loop->last), @endif
                                        @else
                                            {{ $item->{$row->field}  }}
                                        @endif
                                    @endforeach

                                @elseif(property_exists($row->details, 'options'))
                                    @if (count(json_decode($dataTypeContent->{$row->field})) > 0)
                                        @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                                            @if (@$row->details->options->{$item})
                                                {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                            @endif
                                        @endforeach
                                    @else
                                        {{ __('voyager::generic.none') }}
                                    @endif
                                @endif
                            @elseif($row->type == 'date' || $row->type == 'timestamp')
                                {{ property_exists($row->details, 'format') ? \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($row->details->format) : $dataTypeContent->{$row->field} }}
                            @elseif($row->type == 'checkbox')
                                @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                                    @if($dataTypeContent->{$row->field})
                                    <span class="label label-info">{{ $row->details->on }}</span>
                                    @else
                                    <span class="label label-primary">{{ $row->details->off }}</span>
                                    @endif
                                @else
                                {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @elseif($row->type == 'color')
                                <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                            @elseif($row->type == 'coordinates')
                                @include('voyager::partials.coordinates')
                            @elseif($row->type == 'rich_text_box')
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{!! $dataTypeContent->{$row->field} !!}</p>
                            @elseif($row->type == 'file')
                                @if(json_decode($dataTypeContent->{$row->field}))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}">
                                            {{ $file->original_name ?: '' }}
                                        </a>
                                        <br/>
                                    @endforeach
                                @else
                                    <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($row->field) ?: '' }}">
                                        {{ __('voyager::generic.download') }}
                                    </a>
                                @endif
                            @else
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{{ $dataTypeContent->{$row->field} }}</p>
                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
<!-- Begin show faqs in newletter -->
<div class="row">
            <div class="col-xs-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title panel-icon" style="display:inline-block;"><i class="voyager-window-list"></i>{{ __('voyager::generic.title_read_newletter') }}</h3>
                        <button class="btn btn-primary" id="btn-addmail">Add Email</button>
                        <button class="btn btn-success" id="btn-sentNews" style="margin-left:10px;">Sent Newsletter</button>
                    </div>
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">{{ __('voyager::generic.order') }}</th>
                                    <th>{{ __('voyager::generic.title') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty(NewletterService::findDetailInNewletterDetail($dataTypeContent->id)['Email']))
                                @foreach (NewletterService::findDetailInNewletterDetail($dataTypeContent->id)['Email'] as $key => $menuEmail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $menuEmail }}</td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End show faqs in faqCategories -->


    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal manual -->
<div class="modal fade" id="modal-newletter-ask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">คุณต้องการเพิ่ม email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <hr>
      <div class="modal-body">
          <div class="form-group">
            <label>Email:</label>
            <input type="email" placeholder="enter email" class="form-control" name="email">
            <input type="hidden" name="idcategory" value="{{$dataTypeContent->id}}">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="modal-ok" data-url="{{route('newsletter.subscribe.addmailbackend')}}" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>

<!-- modal alert success -->
<!-- Modal -->
<div class="modal fade" id="modal-newletter-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-success">
        <h5 class="modal-title" id="exampleModalLongTitle">Success</h5>
      </div>
      <div class="modal-body">
        <h3>เพิ่ม Email เสร็จสิ้น</h3>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-success" data-url="" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>

<!-- modal-confirm -->
<div class="modal fade" id="modal-newletter-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header  alert-primary" style="background-color:#62a8ea"> 
        <h5 class="modal-title" id="exampleModalLongTitle">CONFIRM SENT NEWSLETTER</h5>
      </div>
      <div class="modal-body">
        <h3>คุณต้องการส่งข่าวใช่หรือไม่</h3>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="modal-confirm" data-url="{{route('newsletter.subscribe.sentNewsLetter')}}" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>

<!-- end modal manual -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#btn-addmail').click(function(){
                $('#modal-newletter-ask').modal('show');
            });

            $('#modal-ok').click(function(){
                var url = $(this).data('url');
                var mail = $('input[name="email"]').val();
                var idCategory = $('input[name="idcategory"]').val();
                $.ajax({
                    type:'GET',
                    url:url,
                    data:{idCategory:idCategory,mail:mail},
                    success:function(msg){
                      console.log(msg);
                        if(msg=="success") {
                            $('#modal-newletter-ask').modal('hide');
                            $('#modal-newletter-success').modal({backdrop: 'static', keyboard: false});
                            $('#modal-success').click(function(){
                                    window.location.reload();
                            });
                        }
                    }
                });
            });

            $("#btn-sentNews").click(function(){
                $('#modal-newletter-confirm').modal('show');
            });

            $("#modal-confirm").click(function(){
                url = $(this).data('url');
                var idCategory = $('input[name="idcategory"]').val();
                console.log(url);
                $.ajax({
                    type:'GET',
                    url:url,
                    data:{idCategory:idCategory},
                    success:function(msg){
                      console.log(msg);
                        if(msg=="success") {
                            $('#modal-newletter-confirm').modal('hide');
                            $('#modal-newletter-success').find('h3').text("ส่งข้อมูลข้าวสารเสร็จสิ้น");
                            $('#modal-newletter-success').modal({backdrop: 'static', keyboard: false});
                            $('#modal-success').click(function(){
                                    window.location.reload();
                            });
                        }
                    }
                });
            });
        })
    </script>
@stop
