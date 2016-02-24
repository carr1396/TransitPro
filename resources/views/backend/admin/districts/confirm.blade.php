@extends('layouts.admin')

@section('title', 'Delete '.$district->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.districts.destroy', $district->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A district Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This district', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.districts.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
