@extends('layouts.admin')

@section('title', 'Edit Order')
  @section('content')


    <h2 class="page-header">Order</h2>

    <div class="panel panel-default">
      <div class="panel-heading text-right">
        <a class="btn btn-primary btn-sm " href="route('dashboard.admin.orders.index')" role="button">Show All Orders</a>    </div>

        <div class="panel-body">

            {!! Form::model($order, [
              'method' => $order->exists ? 'put': 'order',
              'route' => $order->exists ? ['dashboard.admin.orders.update', $order->id]: ['dashboard.admin.orders.store']
              ]) !!}
            <div class="form-group">
              <div class="col-sm-12">
                <label for="active" class=" checkbox-inline">
                  {{ Form::checkbox('active', '1', $order->active) }}
                   Active </label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="booked" class=" checkbox-inline">{{ Form::checkbox('booked', '1', $order->booked) }}  Booked</label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <label for="paid" class=" checkbox-inline">{{ Form::checkbox('paid', '1', $order->paid) }}  Paid </label>
              </div>
            </div>
            <div class="form-group">
              <label for="start" class="col-sm-12 control-label">Start</label>
              <div class="col-sm-12">
                <input type="text" name="start" id="start" class="form-control" value="{{$order['start'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="end" class="col-sm-12 control-label">End</label>
              <div class="col-sm-12">
                <input type="text" name="end" id="end" class="form-control" value="{{$order['end'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="amount" class="col-sm-12 control-label">Amount</label>
              <div class="col-sm-2">
                <input type="number" name="amount" id="amount" class="form-control" value="{{$order['amount'] or ''}}" readonly="">
              </div>
            </div>
            <div class="form-group">
              <label for="address" class="col-sm-12 control-label">Address</label>
              <div class="col-sm-12">
                <input type="text" name="address" id="address" class="form-control" value="{{$order['address'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="address2" class="col-sm-12 control-label">Address2</label>
              <div class="col-sm-12">
                <input type="text" name="address2" id="address2" class="form-control" value="{{$order['address2'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="col-sm-12 control-label">Phone</label>
              <div class="col-sm-12">
                <input type="text" name="phone" id="phone" class="form-control" value="{{$order['phone'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <label for="phone2" class="col-sm-12 control-label">Phone2</label>
              <div class="col-sm-12">
                <input type="text" name="phone2" id="phone2" class="form-control" value="{{$order['phone2'] or ''}}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-12">
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-plus"></i> Update Order Information
                </button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
            </div>
          {!! Form::close() !!}

        </div>
      </div>
      <script charset="utf-8">
      $(document).ready(function() {
        (function(){
          $('input[name=start]').datetimepicker({
            allowInputToggle : true,
            format:'YYYY-MM-DD HH:mm:ss',
            showClear:true
          });
          $('input[name=end]').datetimepicker({
            allowInputToggle : true,
            format:'YYYY-MM-DD HH:mm:ss',
            showClear:true
          });
        })();
      });
      </script>
    @endsection
