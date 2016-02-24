@extends('layouts.admin')

@section('title', 'Delete '.$driver->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.drivers.destroy', $driver->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A driver Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This driver', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.drivers.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
