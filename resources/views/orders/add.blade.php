@extends('crudgenerator::layouts.master')

@section('content')


<h2 class="page-header">Order</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify Order    </div>

    <div class="panel-body">
                
        <form action="{{ url('/orders/save') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

                                    <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Id</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                </div>
            </div>
                                                                                                                        <div class="form-group">
                <label for="user_id" class="col-sm-3 control-label">User Id</label>
                <div class="col-sm-2">
                    <input type="number" name="user_id" id="user_id" class="form-control" value="{{$model['user_id'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="active" class="col-sm-3 control-label">Active</label>
                <div class="col-sm-2">
                    <input type="number" name="active" id="active" class="form-control" value="{{$model['active'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="vehicle_id" class="col-sm-3 control-label">Vehicle Id</label>
                <div class="col-sm-2">
                    <input type="number" name="vehicle_id" id="vehicle_id" class="form-control" value="{{$model['vehicle_id'] or ''}}">
                </div>
            </div>
                                                                                                            <div class="form-group">
                <label for="start" class="col-sm-3 control-label">Start</label>
                <div class="col-sm-3">
                    <input type="date" name="start" id="start" class="form-control" value="{{$model['start'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="end" class="col-sm-3 control-label">End</label>
                <div class="col-sm-3">
                    <input type="date" name="end" id="end" class="form-control" value="{{$model['end'] or ''}}">
                </div>
            </div>
                                                                                    <div class="form-group">
                <label for="booked" class="col-sm-3 control-label">Booked</label>
                <div class="col-sm-2">
                    <input type="number" name="booked" id="booked" class="form-control" value="{{$model['booked'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="pending" class="col-sm-3 control-label">Pending</label>
                <div class="col-sm-2">
                    <input type="number" name="pending" id="pending" class="form-control" value="{{$model['pending'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="paid" class="col-sm-3 control-label">Paid</label>
                <div class="col-sm-2">
                    <input type="number" name="paid" id="paid" class="form-control" value="{{$model['paid'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="amount" class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-2">
                    <input type="number" name="amount" id="amount" class="form-control" value="{{$model['amount'] or ''}}">
                </div>
            </div>
                                                                                    <div class="form-group">
                <label for="address" class="col-sm-3 control-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" id="address" class="form-control" value="{{$model['address'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="address2" class="col-sm-3 control-label">Address2</label>
                <div class="col-sm-6">
                    <input type="text" name="address2" id="address2" class="form-control" value="{{$model['address2'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="phone" class="col-sm-3 control-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{$model['phone'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="phone2" class="col-sm-3 control-label">Phone2</label>
                <div class="col-sm-6">
                    <input type="text" name="phone2" id="phone2" class="form-control" value="{{$model['phone2'] or ''}}">
                </div>
            </div>
                                                                                                                                    <div class="form-group">
                <label for="created_at" class="col-sm-3 control-label">Created At</label>
                <div class="col-sm-6">
                    <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="updated_at" class="col-sm-3 control-label">Updated At</label>
                <div class="col-sm-6">
                    <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}">
                </div>
            </div>
                        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/orders') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection