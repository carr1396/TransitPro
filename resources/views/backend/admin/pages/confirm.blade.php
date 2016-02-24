@extends('layouts.admin')

@section('title', 'Delete '.$page->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.pages.destroy', $page->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A page Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This Page', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.pages.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
