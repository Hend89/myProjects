@extends('main')

@section('title', 'Forgot Passwrd')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                
                <div class="panel-body">
                    {!! Form::open(['url' => 'password/email', 'method' =>"POST"]) !!}
                        
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', null, ['class' => 'form-control']) }}
                        <br>
                        {{ Form::submit('Send', ['class' => 'btn btn-primary btn-block']) }}
                        
                        {!! Form::close() !!}
                
                
                </div>
            </div>
            
        </div>
    </div>

@stop