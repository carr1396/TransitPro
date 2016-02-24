@extends('layouts.auth')

@section('title', 'Reset Password')

@section('heading', 'Enter New Password')

@section('content')
{!! Form::open() !!}
  {!!  Form::hidden('token', $token) !!}
  <div class="form-group">
    {!!  Form::label('email') !!}
    {!!  Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!!  Form::label('password') !!}
    {!!  Form::password('password', array('class' => 'form-control')) !!}
  </div>
  <div class="form-group">
    {!!  Form::label('password_confirmation') !!}
    {!!  Form::password('password_confirmation', array('class' => 'form-control')) !!}
  </div>
  <div class="form-group pull-right">
    {!!  Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}
    <a href="{{route('auth.login')}}" class="small">Login</a>
  </div>
{!! Form::close() !!}
@endsection
