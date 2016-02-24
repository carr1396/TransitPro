@extends('layouts.admin')

@section('title', 'Order '.$order->id.' Receipt')

@section('content')
<h2 class="page-header">Order {{$order->id}} Receipt</h2>
<a class="btn btn-primary btn-sm " href="route('dashboard.admin.orders.index')" role="button">Show All Orders</a>
<ul class="list-group">
  <li class="list-group-item">No: {{$order->id}} <span class="label label-{{$order->paid?'success':'danger'}}">({{$order->paid?'Paid':'Not Paid'}})</span></li>
  <li class="list-group-item">Amount:{{$order->amount}}</li>
  <li class="list-group-item">User: ({{$order->user->email}}) {{$order->user->email}}</li>
  <li class="list-group-item">Vehicle: {{$order->vehicle->number_plate}} - {{$order->vehicle->make.' ('.$order->vehicle->model.')'}}</li>
  <li class="list-group-item">Address:{{$order->address}}</li>
  <li class="list-group-item">Address 2:{{$order->address2?:'N/A'}}</li>
  <li class="list-group-item">Contact Phone:{{$order->phone}}</li>
  <li class="list-group-item">Contact Phone 2:{{$order->phone2?:'N/A'}}</li>
</ul>
@endsection
