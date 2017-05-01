@extends('main')

@section('title', 'Categories')

@section('content')


<div class="row">
     <form action="{{ route('categories.index') }}" method="get" class="form-inline">
        <div class="form-group">
              <input type="text" class="form-control" name="s" placeholder ="Search" value="{{ isset($s) ? $s : '' }}">
        </div>
        <div class="form-group">
               <input type="submit" class="btn btn-primary">
        </div>
      </form>
</div>
    <div class="row">
      <div class="col-md-8">
        <h1>Categories</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                     {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}
                     {!! Form::submit('Delete', ['class' =>'btn btn-danger']) !!}
                     {!! Form::close() !!}
                            </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>  <!-- end col-md-8 -->
      
      <div class="col-md-3">
          <div class="well">
              {!! Form::open(['route' =>'categories.store', 'method' => "POST"]) !!}
              <h2>New Category</h2>
              
              {{ Form::label('name', 'Name ') }}
              {{ Form::text('name', null, ['class' =>'form-control']) }}
              <br>
              {{ Form::submit('Add', ['class' => 'btn btn-primary btn-block']) }}
              
              {!! Form::close() !!}
          </div>
      </div>
       <div class="text-center">
                {!! $categories->appends(['s' => $s])->links() !!}
        </div>
      
    </div> <!-- end row -->
    
@stop