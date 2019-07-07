


@section('content')
    <link rel="stylesheet" href="{{url('library/languages/css/bootstrap.css')}}"/>
    <link href="{{url('library/languages/css/bootstrap-editable.css')}}" rel="stylesheet"/>
    <script src="{{url('library/languages/js/jquery.min.js')}}"></script>
    <script src="{{url('library/languages/js/bootstrap.min.js')}}"></script>
    <script src="{{url('library/languages/js/bootstrap-editable.min.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1>Language</h1>
                    <form method="POST" action="{{ route('translations.create') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="key" class="form-control" placeholder="Enter Key...">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="value" class="form-control" placeholder="Enter Value...">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" style="margin: 0">Add</button>
                            </div>
                        </div>
                    </form>
                    <div style="overflow-x:auto;">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Key</th>
                            @if($languages->count() > 0)
                                @foreach($languages as $language)
                                    <th>{{ $language->name }}({{ $language->code }})</th>
                                @endforeach
                            @endif
                            <th width="80px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($columnsCount > 0)
                            @foreach($columns[0] as $columnKey => $columnValue)
                                <tr>
                                    <td><a href="#" class="translate-key" data-title="Enter Key" data-type="text"
                                           data-pk="{{ $columnKey }}"
                                           data-url="{{ route('translation.update.json.key') }}">{{ $columnKey }}</a></td>
                                    @for($i=1; $i<=$columnsCount; ++$i)
                                        <td><a href="#" data-title="Enter Translate" class="translate"
                                               data-code="{{ $columns[$i]['lang'] }}" data-type="textarea" data-pk="{{ $columnKey }}"
                                               data-url="{{ route('translation.update.json') }}">{{ isset($columns[$i]['data'][$columnKey]) ? $columns[$i]['data'][$columnKey] : '' }}</a>
                                        </td>
                                    @endfor
                                    <td>
                                        <button data-action="{{ route('translations.destroy', $columnKey) }}"
                                                class="btn btn-danger btn-xs remove-key">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.translate').editable({
            params: function (params) {
                // params.code = $(this).editable().data('code');
                params.code = $(this).attr('data-code');
                return params;
            }
        });

        // });



        $('.translate-key').editable({
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'Key is required';
                }
            }
        });


        $('body').on('click', '.remove-key', function () {
            var cObj = $(this);


            if (confirm("Are you sure want to remove this item?")) {
                $.ajax({
                    url: cObj.data('action'),
                    method: 'DELETE',
                    success: function (data) {
                        cObj.parents("tr").remove();
                        alert("Your imaginary file has been deleted.");
                    }
                });
            }


        });

    </script>

@endsection
@extends('voyager::master')

