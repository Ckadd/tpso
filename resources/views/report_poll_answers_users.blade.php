@extends('voyager::master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1>Question User Answer</h1>

                    <div style="overflow-x:auto;">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th colspan="2">Question</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($poll_users->count() > 0)
                                @foreach($poll_users as $poll_user)
                                    <tr>
                                        <td colspan="2">
                                           คำถาม : {{$poll_user->title}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            @php
                                                $data_arr = DB::table('poll_answers_users')
                                                    ->join('poll_answers', 'poll_answers_users.answer_id', '=', 'poll_answers.id')
                                                    ->select('poll_answers.*', 'poll_answers_users.ip')
                                                    ->where('question_id',$poll_user->id)
                                                    ->get();
                                            @endphp
                                            <table class="table table-hover table-bordered">

                                                <tbody>
                                                @foreach($data_arr as $data)
                                                        <tr>
                                                            <td>
                                                                {{$data->answer}}
                                                            </td>
                                                            <td>
                                                                {{$data->ip}}
                                                            </td>
                                                        </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
@endsection

