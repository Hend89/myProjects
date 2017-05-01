<div class="modal" id="delete-comment{{$comment->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h4 class="modal-title">Delete Confirmation</h4>
               </div>
           <div class="modal-body">
                 <p>Are you sure you, want to delete?</p>
            </div>
             <div class="modal-footer">
             {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
             {!! Form::submit('Delete', ['class' =>'btn btn-danger']) !!}
             {!! Form::submit('Cancel', ['class' =>'btn btn-default', 'data-dismiss' => "modal"]) !!}
             {!! Form::close() !!}
             </div>
    </div>
  </div>
</div>