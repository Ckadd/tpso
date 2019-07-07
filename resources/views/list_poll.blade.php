@extends('voyager::master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1 class="page-title" style="padding-top: 0;">
                        <i class="voyager-list" style="top: 5px;"> </i> Polls
                        <a href="{{url('admin/polls/create/')}}" class="btn btn-success add_item"><i class="voyager-plus"></i>New Poll</a>
                    </h1>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Url</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th style="width: 450px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($polls) > 0)
                            @foreach($polls as $poll)
                                <tr id="p_{{$poll->id}}">
                                    <td>
                                        {{$poll->name}}
                                    </td>
                                    <td style="width: 460px;">
                                        <a href="{{url('poll/'.$poll->slug)}}" target="_blank">{{url('polls/'.$poll->slug)}}</a>
                                    </td>
                                    <td>
                                        {{$poll->start_date}}
                                    </td>
                                    <td>
                                        {{$poll->end_date}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/polls/'.$poll->id.'/questions')}}" class="btn btn-warning save" style="text-decoration: none">
                                            <i class="voyager-list"> </i>
                                            <span class="hidden-xs hidden-sm">Question</span>
                                        </a>
                                        <a href="{{url('admin/polls/'.$poll->id.'/edit')}}" class="btn btn-primary save" style="text-decoration: none">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger save" onclick="delPoll({{$poll->id}})">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                        </button>
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
    <script src="{{url('datepicker/js/jquery-1-9-1.js')}}"></script>
    <script>
        function delPoll(poll_id) {
            if (confirm("Do you have to delete this question?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax(
                    {
                        url: "{{url('admin/polls/del')}}" + '/' + poll_id,
                        type: 'DELETE', // Just delete Latter Capital Is Working Fine
                        dataType: "JSON",
                        data: {
                            "id": poll_id // method and token not needed in data
                        },
                        success: function (response) {
                            //console.log(response); // see the reponse sent
                            if (response.status == 'Y') {
                                $('#p_' + poll_id).remove();
                                return false;
                            }
                            alert('do something here because of error');
                            return false;

                        },
                        error: function (xhr) {
                            alert('do something here because of error');
                            console.log(xhr.responseText); // this line will save you tons of hours while debugging
                            // do something here because of error
                            return false;
                        }
                    });
            }
        }
    </script>
@endsection

