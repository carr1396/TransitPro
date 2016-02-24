@extends('layouts.admin')

@section('tab-content')
  <a href="{{route('dashboard.admin.locations.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create location</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @if ($locations->isEmpty())
          <tr>
            <td colspan="5">
              No locations Yet
            </td>
          </tr>
        @else
          @foreach ($locations as $location)
          <tr class="{{$location->active?'success':''}}">
            <td>{{$location->name or 'N/A'}}</td>
            <td>{{$location->longitude or 'N/A'}}</td>
            <td>{{$location->latitude or 'N/A'}}</td>
            <td><a href="{{route('dashboard.admin.locations.edit', $location->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{route('dashboard.admin.locations.confirm', $location->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
          </tr>
          @endforeach
        @endif
    </tbody>
  </table>
@endsection
