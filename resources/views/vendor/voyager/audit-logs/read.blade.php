@extends('voyager::master')

@section('page_title', __('voyager::generic.view'))

@section('page_header')
    <div class="text-right" style="margin-bottom:30px;">
    @if(!empty($type))
        <a href="{{route('graph.audit.type',['pathname'=> $type,'type' => 'line1','module' => $type])}}" class="btn btn-primary" target="_blank"><img src="{{asset('themes/dot/assets/images/chart_line.png')}}" style="width:23px;"></a>
        <a href="{{route('graph.audit.type',['pathname'=> $type,'type' => 'pie1','module' => $type])}}" class="btn btn-primary" target="_blank"><img src="{{asset('themes/dot/assets/images/chart_pie.png')}}" style="width:23px;"></a>
        <a href="{{route('graph.audit.type',['pathname'=> $type,'type' => 'bar1','module' => $type])}}" class="btn btn-primary" target="_blank"><img src="{{asset('themes/dot/assets/images/chart_bar.png')}}" style="width:23px;"></a>
        <a href="{{route('graph.audit.type',['pathname'=> $type,'type' => 'area','module' => $type])}}" class="btn btn-primary" target="_blank"><img src="{{asset('themes/dot/assets/images/chart_area.png')}}" style="width:23px;"></a>
    @endif
    </div>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <h1 style="margin:15px;">{{ $type ?? '' }}</h1>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('voyager::generic.ip_auditlog')}}</th>
                                    <th>{{__('voyager::generic.name')}}</th>
                                    <th>{{__('voyager::generic.datetime_auditlog')}}</th>
                                    <th>{{__('voyager::generic.module_auditlog')}}</th>
                                    <th>{{__('voyager::generic.action_log')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($moduleLog))
                                    @foreach($moduleLog as $key => $value)
                                    <tr>
                                        <td>{{$value->ip}}</td>
                                        <td>{{$value->user_name}}</td>
                                        <td>{{$value->datetime}}</td>
                                        <td>{{$value->module}}</td>
                                        <td>{{$value->action}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                           
                        </table>
                    </div>
                </div>
                <!-- paginate -->
                <div class="col-xs-12 text-center">
                        <nav aria-label="Page navigation" class="nav_pagination">
                            <div>
                                @if(!empty($moduleLog))
                                    {{ $moduleLog->links() }}
                                @endif
                            </div>
                        </nav>
                    </div>
                    <!-- end paginate -->
            </div>
        </div>
    </div>

    
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            $('.side-body').multilingual();
        });
    </script>
    <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
@stop
