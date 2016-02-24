@extends('layouts.auth')

@section('title', 'Login')

@section('heading', 'Welcome Please Login')

@section('content')
{!! Form::open() !!}
  <div class="form-group">
    {!!  Form::label('email') !!}
    {!!  Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Email']) !!}
  </div>
  <div class="form-group">
    {!!  Form::label('password') !!}
    {!!  Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) !!}
  </div>
  <div class="form-group">
    <div class='checkbox-inline'>
      <label for="remember">
        {!!  Form::checkbox('remember', 'remember', true) !!}
        Remember Me
      </label>
    </div>
  </div>
  <div class="form-group">
    {!!  Form::submit('Login', ['class' => 'btn btn-lg btn-primary']) !!}
    <p class="pull-right">
      <a href="{{route('auth.register')}}" class="btn btn-default">Register</a>
      <a href="{{route('auth.password.email')}}" class="btn small pull-right">&nbsp; Forgot Password?</a>
    </p>
  </div>
{!! Form::close() !!}
@endsection
