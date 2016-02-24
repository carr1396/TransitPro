@extends('layouts.admin')

@section('title', 'Delete '.$location->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.locations.destroy', $location->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A location Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This Location', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.locations.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
