@extends('layouts.admin')

@section('title', 'Delete '.$vehicle->number_plate)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.vehicles.destroy', $vehicle->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A Vehicle Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This Vehicle', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.vehicles.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
