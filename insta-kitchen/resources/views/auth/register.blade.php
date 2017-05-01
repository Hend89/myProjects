@extends('main')

@section('title', 'Login')

@section('content')
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open() !!}
            
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
                
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                
                {{ Form::label('password_confirmation', 'Confirm Password') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
               
                
                {{ Form::label('phone_no', 'Phone Number') }}
                {{ Form::text('phone_no', null, ['class' => 'form-control']) }}
            
                {{ Form::label('dob', 'Date of birth') }}
                {{Form::date('dob',  \Carbon\Carbon::now(), ['class' => 'form-control']) }}
            
             
               
                {{ Form::label('country', 'Country') }}
                {{ Form::text('country', null, ['class' => 'form-control']) }}
            
                {{ Form::label('city', 'Cirty') }}
                {{ Form::text('city', null, ['class' => 'form-control']) }}
            
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address', null, ['class' => 'form-control']) }}
                
                
            
                <br>
                <br>
                {{ Form::submit('Register', [ 'class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')


@endsection