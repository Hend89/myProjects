<div class="modal" id="confirm{{$tag->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h4 class="modal-title">Delete Confirmation</h4>
               </div>
           <div class="modal-body">
                 <p>Are you sure you, want to delete? {{ $tag->name }}</p>
            </div>
             <div class="modal-footer">
             {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
             {!! Form::submit('Delete', ['class' =>'btn btn-danger']) !!}
             {!! Form::submit('Cancel', ['class' =>'btn btn-default', 'data-dismiss' => "modal"]) !!}
             {!! Form::close() !!}
             </div>
    </div>
  </div>
</div>