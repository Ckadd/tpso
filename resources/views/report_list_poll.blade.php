@extends('voyager::master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1>Report Polls</h1>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($polls) > 0)
                            @foreach($polls as $poll)
                                <tr>
                                    <td>
                                        <a href="{{url('admin/report-poll/answers-user/'.$poll->id)}}" title="{{$poll->name}}">{{$poll->name}}</a>
                                    </td>
                                    <td>
                                        {{$poll->slug}}
                                    </td>
                                    <td>
                                        {{$poll->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {!! $polls->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

