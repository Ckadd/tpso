<form method="POST" action="{{ url('admin/polls/'.$poll_id.'/'.$data->id.'/uestions-update') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <label>Order :</label>
            <input type="number" name="sort_order" class="form-control" value="{{ $data->sort_order }}" required style="width: 250px;">
        </div>
        <div class="col-md-12">
            <label>Question :</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success pull-right" style="margin: 0;">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
