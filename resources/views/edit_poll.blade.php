@extends('voyager::master')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h3>Form Edit</h3><br/>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ url('admin/polls/'.$data->id.'/edit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>Name :</label>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" placeholder="Enter Poll Name...">
                            </div>


                            <div class="col-md-12">
                                <label>Start date :</label>
                                <input type="text" name="start_date" id="start_datepicker" value="{{$data->start_date }}" class="form-control" placeholder="Enter start date...">
                            </div>
                            <div class="col-md-12">
                                <label>end date :</label>
                                <input type="text" name="end_date" id="end_datepicker" value="{{ $data->end_date }}" class="form-control" placeholder="Enter end date...">
                            </div>
                            <div class="col-md-12">
                                <label>Order :</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ $data->sort_order }}" placeholder="Enter order...">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success" style="margin: 0;">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <link href="{{url('datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <style>
        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
            background: #eaeaea82;
            color: #9292927a;
            cursor: default;
        }
    </style>
    <script src="{{url('datepicker/js/jquery-1-9-1.js')}}"></script>
    <script src="{{url('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript">

        var date = new Date();
        date.setDate(date.getDate());

        $('#start_datepicker').datepicker({
            startDate: date,
            dateFormat: 'yy-mm-dd',
            orientation: "bottom auto",
            autoclose: true,
        }).val();

        $('#end_datepicker').datepicker({
            startDate: date,
            dateFormat: 'yy-mm-dd',
            orientation: "bottom auto",
            autoclose: true,
        }).val();
    </script>

@endsection
