@extends('layouts.admin')

@section('title', 'Delete '.$user->name())

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.users.destroy', $user->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A User Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This User', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.users.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
