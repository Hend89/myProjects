 <!-- Order Modal -->
       <div class="modal fade" tabindex="-1" role="dialog" id="order-confirm{{ $post->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Order {{ $post->title }}</h4>
                </div>
                <div class="modal-body">
                   <img src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}" style="height:200px; width:auto">
            
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route' => ['notifications.store', $post->id], 'method' => 'POST']) !!}
                     {!! Form::label('message', 'Message', ['class' => 'pull-left']) !!}
                     {!! Form::textarea('message',  null, ['class' => 'form-control', 'rows' => '2'] ) !!}
                     {!! Form::submit('Send', ['class' =>'btn btn-primary', 'style' => 'margin-top:10px']) !!}
                     
                     {!! Form::submit('Cancel', ['class' =>'btn btn-default', 'data-dismiss' => "modal", 'style' => 'margin-top:10px']) !!}
                     {!! Form::close() !!}
                     </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- /Edit Modal -->