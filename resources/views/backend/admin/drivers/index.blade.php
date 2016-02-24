@extends('layouts.admin')

@section('content')


<h2 class="page-header">{{ ucfirst('vehicle drivers') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('drivers') }}
        <a href="{{route('dashboard.admin.drivers.create')}}" class="btn btn-xs btn-primary pull-right" role="button">
          <span class="glyphicon glyphicon-plus"></span>
           New driver
         </a>
    </div>
    <div class="container-fluid">
        <table class="table table-striped" id="thegrid">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>License</th>
              <th style="width:50px"></th>
              <th style="width:50px"></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($drivers as $driver)
            <tr>
              <td>
                {{$driver->id}}
              </td>
              <td>
                {{$driver->user->name()}}
              </td>
              <td>
                {{$driver->license}}
              </td>
              <td>
                <a href="{{route('dashboard.admin.drivers.edit', $driver->id)}}" class="btn btn-xs btn-primary" title="Edit">
                  <span class="glyphicon glyphicon-edit"></span>
                </a>
              </td>
              <td>
                <a href="{{route('dashboard.admin.drivers.confirm', $driver->id)}}" class="btn btn-xs btn-danger" title="Delete">
                  <span class="glyphicon glyphicon-remove-sign"></span>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5">
                <p>No drivers Added Yet</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <p>{{$drivers->render()}}</p>
</div>


@endsection
