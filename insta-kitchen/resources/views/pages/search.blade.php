@extends('main')

@section('title')
     Homepage
@endsection

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h2>InstaKitchen community</h2>
                  <p>find what's nearby and order some homemade food.</p>
                    <!-- serch bar -->
             </div>
        </div>
    </div>
        
    <div class="row" style="padding:10px;">
        <div class="col-md-3 pull-right">
            <h3>Right Sidebar</h3>
                <ul class="">
                    <li><a href='#'>My Experience</a></li>
                    <li><a href='#'>My Posts</a></li>
                    <li><a href='#'>Worldwide</a></li>
                </ul>
        </div>
        <div class="col-md-8">
            
            <!-- galary -->
      
            
            <!-- gallary -->
            
            @foreach ($contents as $content)
            <div class="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span><i class="fa fa-star" style="color:#ee8b2d;" aria-hidden="true"></i>
                              {{   App\Http\Controllers\PagesController::getWoord($content->id) }}
                            </span> 
                                {{ $content->title }}</h3>
                    </div>
                    <div class="panel-body">
                          
                            
                             <table class="table table-borderless" cellspacing="0">
                                    <tr>
                                    <td class="col-md-9" rowspan="7">
                                            <a href="/posts/{{ $content->id }}" class="thumbnail">
                                          <img class-"main-post-img" src="/images/posts/{{ $content->image }}" alt="{{ $content->title }}" />
                                        </a>
                                    </td><tr style="height:5px"><td></td><td></td></tr>
                                    <tr style="height:10px;"><td><h5><span>Available </span></td>
                                        <td>{{ $content->quantity }}</h5></td></tr>
                                    <tr style="height:10px;"><td><h5><span>Price </span></td>
                                        <td>{{ $content->price }}</h5></td></tr>
                                    <tr style="height:10px;"><td><h5><span>Category</span></td>
                                        <td><div>{{ $content->catname }}</div></h5></td></tr>
                                    <tr><td><h5>Tags</td>
                                        <td style="padding: 12px 0; margin:0">
                                            <?php $post = App\Post::find($content->id);
                                        foreach ($post->tags as $tag) {
                                           echo '<span class="label label-default">'. $tag->name .'</span> '; } ?>
                                        </h5></td>
                                        <tr style="height:5px"><td></td><td></td></tr></tr>
                                    </tr>
                                    <tr>
                                    <td colspan="3">
                                        <p>{{ $content->description }}</p>
                                    </td>
                                    </tr>
                            
                         </table>
                     </div>
                     <div class="panel-footer">
                     <!-- Button trigger modal -->
                     @if(Auth::check())
                     @if( $content->user_id != Auth::user()->id)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#order-confirm{{$content->id}}">
                              Order
                            </button>
                    @include('modals.order_confirm')
                     
                     <div class="info pull-right">
                        Posted by <a href="#">{{ $content->username }} </a> on  {{ date('j M,  Y - h:ia', strtotime($content->created_at)) }}</div>
                     </div>
                     @endif
                     @endif
                     
                </div>
              </div>
            @endforeach
            
            <div class="text-center">
                {!! $contents->links(); !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}
    
    <script type="text/javascript">
        $('.select2-multi').select2();
        $(".select2-multi").select2().val();
    </script>
@endsection


































   <div class="row">
        <div class="col-md-6 col-md-offset-3">
        @foreach ($posts as $post)
                      <!-- Post Section -->
                            <div class="well">
                                <span class="post-title"><i class="fa fa-star" style="color:#ee8b2d;" aria-hidden="true"></i> 3.5
                                   {{ $post->title }} </span> 
                                   
                                <div  style="position:inline; float:right">
                                    <table>
                                        <tr>
                                            <td>
                                                {!! Html::linkRoute('posts.edit', 'Edit', $post->id, array('class' => 'btn btn-default')) !!}
                                            </td>
                                            <td style="width: 1.5px;"></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post{{$post->id}}">
                                                  Delete
                                                </button>
                                                @include('modals.delete_post')
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    
                                </div>
                            </div>
                            
                            
                            
                            <table>
                                <tr>
                                    <td rowspan ="2">
                                        <div class="users-post-img">
                                        <a href="/posts/{{ $post->id }}" class="thumbnail">
                                         <img src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}">
                                         </a>
                                        </div> 
                                    </td>
                                    <td style="text-align:left">
                                     <div class="post-details pull-right" style="display:inline;"> 
                                        <p class="post-desc">{{ substr($post->description, 0, 60) }} {{ strlen($post->description) > 60 ? "..." : "" }}</p>
                                           <h5>Available:<span> {{ $post->quantity }} </span></h5>
                                           <h5>Price:<span> £{{ $post->price }} <span></h5>
                                           <h5>Category:<span>  {{ $post->category()->first()->name }} <span> </h5>
                                           <h5>Tags:  
                                           @foreach ($post->Tags()->take(4)->get() as $tag)
                                        <span class="label label-default">{{ $tag->name }}</span>
                                        @endforeach
                                            </h5>
                                     </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Posted at: {{ date('j M,  Y - h:ia', strtotime($post->created_at)) }}</td>
                                </tr>
                            </table>
                        
                            <br>
                            <hr>
                         <!-- end post section --> 
                         
         @endforeach
        </div>
    </div>
    
