<div> <!-- new comment form -->
    {{ Form::open(['route' => ['comments.store', $post->id], 'method' => "POST"]) }}
    <p>
   
    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Add comment']) }}
    </p>
       <!-- stars -->
        @if( $post->user_id != Auth::user()->id)
        <p><div class="container">
            <div class="row">
                <p>Add rating</p>
                <div id="hearts-existing" class="starrr" data-rating='0'></div>
                <span id="count-existing"></span> stars
                <input type="hidden" id="rate-count" name="rating"> 
            </div>
        </div></p>
        <p>
        @endif
            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
           
            {{ Form::close() }}

</div><!-- end new comment form -->

<hr>

<!-- All Comments -->

<div class="row">
    @foreach ($post->comments()->orderBy('comments.id', 'DESC')->get() as $comment)
    <div class="col-sm-12">
        <div class="panel panel-white post panel-shadow">
            <div class="post-heading">
                <div class="pull-left image">
                    <img src="/images/avatars/{{ $comment->user->image }}" class="img-circle avatar" alt="$comment->user->name">
                </div>
                <div class="pull-left meta">
                    <div class="title h5">
                        <a href="#"><b>{{ $comment->user->name }}</b></a>
                        made a post.
                    </div>
                    <div class="pull-right"><div id="hearts" class="starrr noHover" data-rating='{{ $comment->rating }}'></div></div>
                    <h6 class="text-muted time">{{ $comment->created_at->diffForHumans() }}</h6>
                </div>
            </div> 
                <div class="post-description"> 
                    <p>{{ $comment->comment }}</p>
                    <div class="stats">
                        <a href="#" class="btn btn-default stat-item">
                            <i class="fa fa-thumbs-up icon"></i>2
                        </a>
                        <a href="#" class="btn btn-default stat-item">
                            <i class="fa fa-thumbs-down icon"></i>12
                        </a>
                        @if( $comment->user_id == Auth::user()->id)
                        
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-comment{{$comment->id}}">
                              Edit
                        </button>
                            @include('modals.edit_comment')
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-comment{{$comment->id}}">Delete</a>
                            @include('modals.delete_comment')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- end all comments -->