@extends('voyager::master')

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        
    </h1>
</div>
@endsection

@section('content')
<form method="post" action="{{route('manage.relared.save')}}">
@csrf
<table id="table-news" class="table table-striped table-bordered" style="width:100%; margin-top:30px;">
    <thead>
        <tr>
            <th>[choice]</th>
            <th>title</th>
            <th>datetime</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($data))
            @foreach($data as $key => $value)
                <tr>
                    <td><input type="checkbox" name="news[]" value="{{$value['id']}}"></td>
                    <td>{{$value['title'] ?? ''}}</td>
                    <td>{{$value['datetime'] ?? 0000-00-00}}</td>
                </tr>
            @endforeach
        @else
            <td></td>
            <td></td>
            <td></td>
        @endif
    </tbody>
</table>
<input type="hidden" name="idNew" value="{{$idNew}}">
<input type="submit" class="btn btn-primary btn-submit" value="Save">
</form>
@endsection

@section('css')
    <style>
        .btn-submit {
            margin-top:30px;
        }
        #table-news > tbody > tr:hover {
            background-color: #ebebe0;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
@endsection

@section('javascript')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table-news').DataTable();
            var check = [];
            $('input[type="checkbox"]').click(function(){

                if($(this).is(':checked')) {
                    check.push($(this).val());
                    if(check.length > 4) {
                        alert('จำนวนข่าวครบแล้ว');
                        check.pop();
                        $(this).prop('checked',false);

                        return;
                    }

                    return;
                }
                check.pop();                
            });
        });
    </script>
@endsection