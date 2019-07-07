@extends('voyager::master')


@section('content')
    <link rel="stylesheet" href="{{url('library/languages/css/bootstrap.css')}}"/>
    <link href="{{url('library/languages/css/bootstrap-editable.css')}}" rel="stylesheet"/>
    <script src="{{url('library/languages/js/jquery.min.js')}}"></script>
    <script src="{{url('library/languages/js/bootstrap.min.js')}}"></script>
    <script src="{{url('library/languages/js/bootstrap-editable.min.js')}}"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1>Language Types</h1>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('language-types') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Enter Name...">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="code" class="form-control" placeholder="Enter Code...">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" style="margin: 0;">Add</button>
                            </div>
                        </div>
                    </form>


                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th width="80px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($languages) > 0)
                            @foreach($languages as  $language)
                                <tr>
                                    <td>
                                        {{$language->id}}
                                    </td>
                                    <td>
                                        {{$language->name}}
                                    </td>
                                    <td>
                                        {{$language->code}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/language-types/'.$language->id.'/destroy')}}" class="btn btn-danger btn-sm"> ลบ </a>
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

@endsection
