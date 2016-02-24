@extends('layouts.auth')

@section('title', 'Password Reset')

@section('heading', 'Enter Email To Reset Password')

@section('content')
{!! Form::open() !!}
  <div class="form-group">
    {!!  Form::label('email') !!}
    {!!  Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group pull-right">
    {!!  Form::submit('Send Token', ['class' => 'btn btn-primary']) !!}
    <a href="{{route('auth.login')}}" class="small">Login</a>
  </div>
{!! Form::close() !!}
@endsection
