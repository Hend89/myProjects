@extends('main')

@section('title', 'All posts')

@section('stylesheets')


@endsection

@section ('content')
@if(!is_null($posts))
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <img style="hiegt:200px; width:200px" src="/images/avatars/{{ App\Http\Controllers\PostController::getUserImage($posts->first()->user_id) }}" alt="{{ App\Http\Controllers\PostController::getUserName($posts->first()->user_id)  }}">
        </div>
        <div class="col-md-4 col-md-offset-1">
            <h1> {{ App\Http\Controllers\PostController::getUserName($posts->first()->user_id)  }}'s Kitchen</h1>
        </div>
        @if (Auth::user()->id == $posts->first()->user_id)
        <div class="col-md-4 col-md-offset-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create new post</a>
        </div>
        @endif
        <div class="col-md-12">
         <hr>   
        </div>
    </div>
    <br> <br>
    
    
  
        <div class="row">
        @foreach ($posts as $post)
          <div class="col-sm-7 col-md-3" style="height:220px; margin:30px;">
            <div class="thumbnail clearfix">
            <a href="/posts/{{ $post->id }}">
             <img class="img-responsive pull-left" style="hiegt:320px; width:320px" src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}" />
            </a>
            <span class="caption">
                <p> {{ $post->title }} </p>
            </span>
              
            </div>
          </div>
          @endforeach
        </div>
    
 
    
<div class="text-center">
    {!! $posts->links(); !!}
</div>
<!-- Modal -->
@else
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <img style="hiegt:200px; width:200px" src="/images/avatars/{{ Auth::user()->image }}" alt="{{ Auth::user()->name}}">
        </div>
        <div class="col-md-4 col-md-offset-1">
            <h1> {{ Auth::user()->name  }}'s Kitchen</h1>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create new post</a>
        </div>
        <div class="col-md-12">
         <hr>   
        </div>
    </div>
    <br> <br>
    
    
  
        <div class="row">

          <p> No posts made yet</p>
        </div>
    
 

@endif
@stop

@section('scripts')
    {!! Html::script('js/script.js') !!}
@endsection



