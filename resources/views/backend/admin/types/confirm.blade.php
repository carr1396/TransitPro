@extends('layouts.admin')

@section('title', 'Delete '.$type->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.types.destroy', $type->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A type Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This type', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.types.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
