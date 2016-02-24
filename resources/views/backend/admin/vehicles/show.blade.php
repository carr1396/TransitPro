@extends('layouts.admin')

@section('content')

<h2 class="page-header">Vehicle</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Vehicle    </div>

    <div class="panel-body">

        <form action="{{ url('/vehicles') }}" method="POST" class="form-horizontal">

        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-6">
                <input type="text" name="type" id="type" class="form-control" value="{{$model['type'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="registration_number" class="col-sm-3 control-label">Registration Number</label>
            <div class="col-sm-6">
                <input type="text" name="registration_number" id="registration_number" class="form-control" value="{{$model['registration_number'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="capacity" class="col-sm-3 control-label">Capacity</label>
            <div class="col-sm-6">
                <input type="text" name="capacity" id="capacity" class="form-control" value="{{$model['capacity'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-6">
                <input type="text" name="image" id="image" class="form-control" value="{{$model['image'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="created_at" class="col-sm-3 control-label">Created At</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <label for="updated_at" class="col-sm-3 control-label">Updated At</label>
            <div class="col-sm-6">
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/vehicles') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>

        </form>


    </div>
</div>







@endsection
