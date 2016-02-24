@extends('layouts.account')

@section('title', 'Account')

  @section('content')


    <h2 class="page-header">{{ ucfirst('orders') }}</h2>

    <div class="panel panel-default">
      <div class="panel-heading">
        List of {{ ucfirst('orders') }}
      </div>

      <div class="panel-body">
        <div class="">
          <table class="table table-striped" id="thegrid">
            <thead>
              <tr>
                <th>Id</th>
                <th>Vehicle</th>
                <th>Start</th>
                <th>End</th>
                <th>Paid</th>
                <th>Amount</th>
                <th>Created At</th>
                <th style="width:50px"></th>
                <th style="width:50px"></th>
              </tr>
            </thead>
            <tbody>
              @if(count($orders)<=0)
                <tr>
                  <td colspan="10">
                    You Haven't Made Any Orders yet
                  </td>
                </tr>
              @endif
              @foreach($orders as $order)
                <td>{{$order->id}}</td>
                <td> <a href="/vehicles/minivan/{{$order->vehicle_id}}/{{$order->vehicle->number_plate}}"> {{$order->vehicle->number_plate}} {{$order->vehicle->number_plate}}</a></td>
                <td>{{$order->start->toDayDateTimeString()}}</td>
                <td>{{$order->end->toDayDateTimeString()}}</td>
                <td>{{$order->paid?'Yes':'No'}}</td>
                <td>{{floatval($order->amount)}}</td>
                <td>{{$order->created_at->toDayDateTimeString()}}</td>
                <td><a href="{{route('account.orders.show', $order->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                <td>
                  {!! Form::model($order, ['route' => ['account.orders.destroy', $order->id],
                    'method' => 'DELETE'
                    ]) !!}
                    <div class="form-group">

                      {!! Form::submit('Delete', array('class'=>'btn btn-xs btn-danger', 'Onclick' => 'return ConfirmDelete()')) !!}

                    </div>
                    {!! Form::close() !!}
                  </td>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      function ConfirmDelete()
      {
        var x = confirm("Are you sure you want to delete?");
        if (x)
        return true;
        else
        return false;
      }
      </script>

    @endsection
