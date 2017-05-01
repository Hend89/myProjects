@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h2> Create New Post</h2>
            <hr>
            {!! Form::open(array('route' => 'posts.store', 'files' => true, 'data-parsley-validate' =>'')) !!}
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
            
                
                {{ Form::label('category', 'Category') }}
                <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                    @endforeach
                </select>
                
                    {{ Form::label('tags', 'Tags') }}
                    <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
                        @endforeach
                    </select>
                
                
                {{ Form::label('image', 'Image') }}
                {{ Form::file('image', null, array('class' => 'form-control')) }}
                
                {{  Form::submit('Post', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top:10px;'))  }}
            {!! Form::close() !!}
            
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