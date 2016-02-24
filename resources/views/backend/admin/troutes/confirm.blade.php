@extends('layouts.admin')

@section('title', 'Delete '.$troute->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.troutes.destroy', $troute->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A troute Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This troute', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.troutes.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
