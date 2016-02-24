@extends('layouts.backend')

@section('title', 'Delete '.$post->name)

@section('content')
  {!! Form::open(['method' =>'delete', 'route'=>['dashboard.admin.blog.destroy', $post->id]]) !!}
  <div class="alert alert-danger">
    <span class="glyphicon glyphicon-warning-sign"></span> Deleting A post Is
    Permanent And Can not Be Undone.
  </div>
  <div class="form-group">

    {!!  Form::submit('Yes, Delete This Post', ['class' => 'btn btn-danger']) !!}
    <a href="{{route('dashboard.admin.blog.index')}}" class="btn btn-success pull-right">
      <strong>No, Get me Out Of Here!</strong>
    </a>
  </div>
{!! Form::close() !!}
@endsection
