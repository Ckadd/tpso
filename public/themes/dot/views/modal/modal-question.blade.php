<div class="modal fade" id="modal-newletter-ask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <hr>
      <div class="modal-body">
          <div class="form-group">
            <label>Email:</label>
            <input type="email" placeholder="enter email" class="form-control" name="email">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="modal-ok" data-url="{{route('faq.sentmailfaq')}}" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>