@extends('layouts.auth')

@section('title', 'Register')

@section('heading', 'Welcome Please Login')

@section('content')
{!! Form::open() !!}
  <div class="form-group">
    <div class="help-block">
      (<span class="text-danger"><i class="fa fa-asterisk"></i></span>) Fields required
      <br>
      (<span class="text-primary">^</span>) Fields Optional
    </div>
    {!!  Form::label('first_name') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
      {!!  Form::text('first_name', null, ['class' => 'form-control', 'placeholder'=>'First Name']) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::label('last_name') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
      {!!  Form::text('last_name', null, ['class' => 'form-control', 'placeholder'=>'Last Name']) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::label('other_names') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger">^</span>
      {!!  Form::text('other_names', null, ['class' => 'form-control', 'placeholder'=>'Other Names (If Any)']) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::label('email') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
      {!!  Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Email']) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::label('password') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
      {!!  Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::label('password_confirmation') !!}
    <div class="input-group">
      <span class="input-group-addon addon-danger"><i class="fa fa-asterisk"></i></span>
      {!!  Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Confirm Password')) !!}
    </div>
  </div>
  <div class="form-group">
    {!!  Form::submit('Register', ['class' => 'btn btn-lg btn-primary']) !!}
    <a href="{{route('auth.login')}}" class="btn btn-default pull-right">Login</a>
  </div>
{!! Form::close() !!}
@endsection
