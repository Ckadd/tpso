<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Polls</title>
    <link href="{{url('library/bootstrap-3.0.3/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{url('library/bootstrap-3.0.3/js/bootstrap.min.js')}}"></script>
    <script src="{{url('library/jquery-1.11.1.min.js')}}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <div>
            <h3 class="text-center" style="margin-top: 3%">{{$poll->name}}</h3>
            <form method="POST" action="{{url('poll/'.$poll->slug.'/create')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="token_key" value="{{csrf_token()}}">
                <div class="panel">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="margin: 10px 10px;">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="panel-heading">
                        <h3 class="panel-title">
                           {{$data->order}}. {{$data->question}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($data->answers as $answer)
                            <li class="list-group-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answer_id" value="{{$answer->id}}">
                                        {{$answer->answer}}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #00000012;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
        box-shadow: 0 1px 1px rgba(0,0,0,0.05);
        margin-top: 2%;
    }
    .panel-body {
        padding: 10px 15px;
    }
    .panel-footer {
        padding: 10px 15px;
         background-color: unset;
         border-top: unset;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 5px 15px;
        margin-bottom: -1px;
        background-color: #fffc;
        border: 1px solid #dddddd54;
    }
</style>
</body>
</html>
