<div class="modal" id="edit-comment{{$comment->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                     <h4 class="modal-title">Edit comment</h4>
               </div>
             <div class="modal-footer">
             {!! Form::open(['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
             {!! Form::label('comment', 'Comment', ['class' => 'pull-left']) !!}
             {!! Form::textarea('comment',  $comment->comment , ['class' => 'form-control'] ) !!}
             <br>
             {!! Form::submit('Save', ['class' =>'btn btn-primary']) !!}
             {!! Form::submit('Cancel', ['class' =>'btn btn-default', 'data-dismiss' => "modal"]) !!}
             {!! Form::close() !!}
             </div>
    </div>
  </div>
</div>