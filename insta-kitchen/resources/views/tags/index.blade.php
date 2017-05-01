@extends('main')

@section('title', 'Tags')

@section('content')
    <div class="row">
      <div class="col-md-8">
        <h1>Tags</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm{{$tag->id}}">
                           Delete</button>
                        @include('modals.delete_tag')</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>  <!-- end col-md-8 -->
      
      <div class="col-md-3">
          <div class="well">
              {!! Form::open(['route' =>'tags.store', 'method' => "POST"]) !!}
              <h2>New Tag</h2>
              
              {{ Form::label('name', 'Name ') }}
              {{ Form::text('name', null, ['class' =>'form-control']) }}
              <br>
              {{ Form::submit('Add', ['class' => 'btn btn-primary btn-block']) }}
              
              {!! Form::close() !!}
          </div>
      </div>
      
    </div> <!-- end row -->
    
@stop