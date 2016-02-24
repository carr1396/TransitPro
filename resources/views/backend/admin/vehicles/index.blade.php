@extends('layouts.admin')

@section('content')


<h2 class="page-header">{{ ucfirst('vehicles') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('vehicles') }}
        <a href="{{route('dashboard.admin.vehicles.create')}}" class="btn btn-xs btn-primary pull-right" role="button">
          <span class="glyphicon glyphicon-plus"></span>
           New vehicle
         </a>
    </div>
    <div class="container-fluid">
        <table class="table table-striped" id="thegrid">
          <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Number Plate</th>
                <th>Registration Number</th>
                <th>Capacity</th>
                <th>Fleet Number</th>
                <th>Last Updated</th>
                <th style="width:50px"></th>
                <th style="width:50px"></th>
                <th style="width:50px"></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($vehicles as $vehicle)
            <tr class="{{$vehicle->active?'success':''}}">
              <td>
                {{$vehicle->id}}
              </td>
              <td>
                {{$vehicle->vehicle_type->name}}
              </td>
              <td>
                {{$vehicle->number_plate}}
              </td>
              <td>
                {{$vehicle->registration_number}}
              </td>
              <td>
                {{$vehicle->capacity}}
              </td>
              <td>
                @if ($vehicle->vehicle_number)
                {{$vehicle->vehicle_number}}
                @else
                  @if (Auth::user()->isAdmin())
                    {{-- <a href="{{route('dashboard.admin.vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id])}}">Assign</a> --}}
                    <a href="{{route('vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id,  $vehicle->number_plate])}}">Assign</a>
                  @else
                    N/A
                  @endif
                @endif
              </td>
              <td>
                {{$vehicle->updated_at->diffInDays()}} Days Ago
              </td>
              <td><a href="{{route('vehicles.show', [lcfirst($vehicle->vehicle_type->name), $vehicle->id,  $vehicle->number_plate])}}"
                class="btn btn-sm btn-success"><span class="glyphicon glyphicon-eye-open"></span></a></td>
              <td><a href="{{route('dashboard.admin.vehicles.edit', $vehicle->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
              <td><a href="{{route('dashboard.admin.vehicles.confirm', $vehicle->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            @empty
            <tr>
              <td colspan="8">
                <p>No Vehicles Added Yet</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <p>{{$vehicles->render()}}</p>
</div>
@endsection
