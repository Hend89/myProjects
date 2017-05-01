@extends('main')

@section('title')
     Homepage
@endsection

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/product.css') !!}
@endsection

@section ('content')
<div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h2>InstaKitchen community</h2>
                  <p>find what's nearby and order some homemade food.</p>
                    <!-- serch bar -->
                       <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form-inline">
                        <div class="form-group">
                              <input type="text" class="form-control" name="s" placeholder ="Search" value="{{ isset($s) ? $s : '' }}">
                        </div>
                        <div class="form-group">
                               <input type="submit" class="btn btn-primary">
                        </div>
                      </form>
             </div>
        </div>
    </div>
    
    
    <!-- Display Product -->
    <div class="well well-sm">
        <strong>In Kitchen </strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div id="products" class="row list-group">
        @foreach ($posts as $post)
        <div class="item grid_element col-xs-6 col-lg-6" style="height:400px; margin:50px 0;">
            <div class="thumbnail" style="display: inline-block;">
                <a href="{{ route('posts.show', $post->id ) }}">
                   <img src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}" style="float:left; display:inline-block; max-width: 300px; max-height:300px">
                </a>
                 <div class="caption" style="display: inline-block;">
                    <h4 class="group inner list-group-item-heading">
                        <span><i class="fa fa-star" style="color:#ee8b2d;" aria-hidden="true"></i>
                        {{   App\Http\Controllers\PagesController::getRating($post->id) }}
                        </span>
                        {{ $post->title }}</h4>
                    <p class="group inner list-group-item-text">
                        {{ $post->description }}  
                         <h5>Available:<span> {{ $post->quantity }} </span></h5>
                            <h5>Category:<span>  {{ $post->category()->first()->name }} <span> </h5>
                             @if (App\Post::has('tags', '=', 3)->get())
                             <h5>Tags:  
                                @foreach ($post->Tags()->get() as $tag)
                                   <span class="label label-default">{{ $tag->name }}</span>
                                 @endforeach
                             </h5>
                             @endif
                    <div class="row">
                        <div class="col-md-9">
                            <p class="lead">
                               £ {{ $post->price }}</p>
                             <p class="info">
                         By  <a href="{{ route('posts.index', $post->user_id ) }}"> {{ $post->user->name}} </a>, {{ $post->created_at->diffForHumans() }}</a></p>
                        </div>
                      <div class="row">
                        <div class="col-md-6 col-md-4-offset">
                            
                                @if(Auth::check() && $post->user_id != Auth::user()->id)
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#order-confirm{{$post->id}}">
                                  Order
                                </button>
                                @include('modals.order_confirm')
                                @endif
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- end display products -->

    
<div class="text-center">
    {!! $posts->appends(['s' => $s])->links() !!}
</div>
<!-- Modal -->

@stop

@section('scripts')
    {!! Html::script('js/script.js') !!}
    <script type="text/javascript" >
        $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
    });
    </script>

@endsection



