@extends('main')

@section('title', 'Edit Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h2>Edit Post</h2>
            <hr>
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' =>'PUT', 'files' => true, 'data-parsley-validate' =>'']) !!}
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'data-parsley-maxlength' => '120')) }}
           
                {{ Form::label('description', 'Discription') }}
                {{ Form::textarea('description', null, array('class' => 'form-control', 'required' => '', 'data-parsley-maxlength' => '250')) }}

                {{ Form::label('price', 'Price') }}
                
                <div class="input-group">
                <span class="input-group-addon" style="height:25px"id="basic-addon1">£</span>
                {{ Form::text('price', null, array('class' => 'form-control', 'aria-describedby' => 'basic-addon1' ,'required' => '', 'data-parsley-type' => 'number')) }}
                </div>
                
                {{ Form::label('quantity', 'Quantity') }}
                {{ Form::text('quantity', null, array('class' => 'form-control', 'required' => '', 'data-parsley-type' => 'integer')) }}
               
                  {{ Form::label('tags', 'Tags') }}
                         <?php $tag2 = array();
                        
                        foreach($tags as $tag) {
                            $tag2[] = $tag->id;
                        } ?>
                    <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                        @foreach ($alltags as $tag)
                            <option value="{{ $tag->id }}" {{ 
                           in_array($tag->id, $tag2) ? "selected='selected'" : "" }}"> {{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <br><br>
                   
                <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                        @if( $category->id == $post->category_id)
                            <option value="{{ $category->id }}" selected="{{ $post->category_id }}"> {{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}"> {{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                <br><br>
                        @if($post->image != 'default_food.jpg')
                         <div class="users-post-img">
                             <img src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}">
                         </div> 
                        @endif
                
                {{ Form::label('image', 'Image') }}
                {{ Form::file('image', null, array('class' => 'form-control')) }}
                  
                  
                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                {!! Html::linkRoute('posts.show', 'Cancel', $post->id, array('class' => 'btn btn-danger')) !!}
            
            
              {!! Form::close() !!}
              
                               
            
        </div>
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/parsley.min.js') !!}
    {!! Html::script('js/select2.min.js') !!}
    
    
    <script type="text/javascript">
        $('.select2-multi').select2();
       </script>
@endsection