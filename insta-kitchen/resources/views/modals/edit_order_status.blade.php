 <!-- Order Modal -->
       <div class="modal fade" tabindex="-1" role="dialog" id="edit-order-status{{ $notification->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Order {{ $notification->post()->first()->title }}</h4>
                </div>
                <div class="modal-body">
                   <label>Message</label>
                   <p> {{ $notification->message }} </p>
                   <select class="form-control">
                        <option value="1">Accept</option>
                        <option value="5">Reject</option>
                   </select>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- /Edit Modal -->