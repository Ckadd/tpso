@extends('voyager::master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <h1 class="page-title" style="padding-top: 0; height: 0">
                        <i class="voyager-list" style="top: 5px;"> </i> Question
                    </h1>
                    <hr/>
                    @include('elements.create_question')
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Questions</th>
                            <th>Created</th>
                            <th style="width: 450px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($questions) > 0)
                            @foreach($questions as $question)
                                <tr id="q_{{$question->id}}">
                                    <td width="870">
                                        <strong style="font-weight: bold;">{{$question->sort_order}}. {{$question->title}}</strong>
                                        <ul>
                                        @foreach($question->answers as $v)
                                            <li>{{$v->answer}}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {{$question->created_at}}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{url('admin/polls/'.$poll_id.'/questions/'.$question->id.'/edit')}}" class="btn btn-primary save"  style="text-decoration: none">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger save" onclick="delAnswer({{$question->id}})">
                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    {!! $questions->render() !!}

                </div>
            </div>
        </div>
    </div>
    <script src="{{url('datepicker/js/jquery-1-9-1.js')}}"></script>
    <script>

            var scntDiv = $('#p_scents');
            var i =1;

            $('#addScnt').on('click', function() {
                var idCount = i;
                $('<div class="col-md-10" id="ele_answer_'+i+'" style="margin-bottom: 15px;"><label>Answer :</label><input type="text" name="answer[]" class="form-control" required></div><div class="col-md-2" id="btAddDel_'+i+'" style="margin-bottom: 15px;padding-top: 22px;"><button type="button"  class="btn btn-danger" onclick="rmAnwer('+idCount+')"><i class="voyager-trash"></i></button></div>').appendTo(scntDiv);
                i++;
                return false;
            });

            function rmAnwer(e) {
                $('#ele_answer_'+e).remove();
                $('#btAddDel_'+e).remove();
            }

            function delAnswer(question_id) {
                if (confirm("Do you have to delete this question?")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax(
                        {
                            url: "{{url('admin/poll/question/del')}}" + '/' + question_id,
                            type: 'DELETE', // Just delete Latter Capital Is Working Fine
                            dataType: "JSON",
                            data: {
                                "id": question_id // method and token not needed in data
                            },
                            success: function (response) {
                                //console.log(response); // see the reponse sent
                                if (response.status == 'Y') {
                                    $('#q_' + question_id).remove();
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

