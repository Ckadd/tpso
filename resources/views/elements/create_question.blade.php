<div class="col-md-6">
    <div class="panel panel-bordered">
        <div class="panel-body">
            <h3>Form Create Question</h3><br/>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ url('admin/polls/'.$poll_id.'/questions/create') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Order :</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ $order }}" required style="width: 250px;">
                    </div>
                    <div class="col-md-12">
                        <label>Question :</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="col-md-12">
                        <label>Answer :</label>
                        <input type="text" name="answer1" class="form-control" value="{{ old('answer1') }}" required>
                    </div>

                    <div class="col-md-12">
                        <label>Answer :</label>
                        <input type="text" name="answer2" class="form-control" value="{{ old('answer2') }}" required>
                    </div>
                    <div id="p_scents"></div>
                    <div class="col-md-12 text-left">
                        <hr/>
                        <button type="button" class="btn btn-primary " style="margin: 0;"  id="addScnt"> <i class="voyager-plus"></i> Add Another Input Answer</button>
                        <button type="submit" class="btn btn-success pull-right" style="margin: 0;">Save</button>

                    </div>

                    <div class="col-md-12">

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
