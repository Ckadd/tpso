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
                    <form method="POST" action="{{ url('admin/polls/'.$poll_id.'/'.$data->id.'/questions-update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>Order :</label>
                                <input type="number" name="sort_order" class="form-control"
                                       value="{{ $data->sort_order }}" required style="width: 250px;">
                            </div>
                            <div class="col-md-12">
                                <label>Question :</label>
                                <input type="text" name="title" class="form-control" value="{{ $data->title }}"
                                       required>
                            </div>
                            @foreach($data->answers as $v)
                                <div class="col-md-10" id="awswer_{{$v->id}}">
                                    <label>Answer:</label>
                                    <input type="text" name="answer_text[]" class="form-control"
                                           value="{{ $v->answer }}" required>
                                    <input type="hidden" name="answer_id[]" value="{{ $v->id }}">
                                </div>
                                <div class="col-md-2" id="btn_rm_{{$v->id}}"
                                     style="margin-bottom: 15px;padding-top: 22px;">
                                    <button type="button" class="btn btn-danger" onclick="delAnswer({{$v->id}})">
                                        <i class="voyager-trash"></i>
                                    </button>
                                </div>
                            @endforeach


                            <div id="p_scents"></div>
                            <div class="col-md-12 text-left">
                                <button type="button" class="btn btn-primary " style="margin: 0;" id="addScnt"><i
                                        class="voyager-plus"></i> Add Another Input Answer
                                </button>
                                <hr/>
                            </div>

                            <div class="col-md-10 text-center">
                                <a href="{{url('admin/polls/'.$poll_id.'/questions')}}" class="btn btn-info"><i
                                        class="voyager-double-left"></i> Back To List Question</a>
                                <button type="submit" class="btn btn-success">Save To Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{url('datepicker/js/jquery-1-9-1.js')}}"></script>
    <script>

        var scntDiv = $('#p_scents');
        var i = 1;

        $('#addScnt').on('click', function () {
            var idCount = i;
            $('<div class="col-md-10" id="ele_answer_' + i + '" style="margin-bottom: 15px;"><label>Answer :</label><input type="text" name="answer_new[]" class="form-control" required></div><div class="col-md-2" id="btAddDel_' + i + '" style="margin-bottom: 15px;padding-top: 22px;"><button type="button"  class="btn btn-danger" onclick="rmAnwer(' + idCount + ')"><i class="voyager-trash"></i></button></div>').appendTo(scntDiv);
            i++;
            return false;
        });

        function rmAnwer(e) {
            $('#ele_answer_' + e).remove();
            $('#btAddDel_' + e).remove();
        }

        function delAnswer(answer_id) {
            if (confirm("Do you have to delete this answer?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax(
                    {
                        url: "{{url('admin/polls/answer/del')}}" + '/' + answer_id,
                        type: 'DELETE', // Just delete Latter Capital Is Working Fine
                        dataType: "JSON",
                        data: {
                            "id": answer_id // method and token not needed in data
                        },
                        success: function (response) {
                            //console.log(response); // see the reponse sent
                            if (response.status == 'Y') {
                                $('#awswer_' + answer_id).remove();
                                $('#btn_rm_' + answer_id).remove();
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
