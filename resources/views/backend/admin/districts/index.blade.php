@extends('layouts.admin')

@section('tab-content')
  <a href="{{route('dashboard.admin.districts.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create district</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @if ($districts->isEmpty())
          <tr>
            <td colspan="5">
              No districts Yet
            </td>
          </tr>
        @else
          @foreach ($districts as $district)
          <tr class="{{$district->active?'warning':''}}">
            <td>{{$district->name or 'N/A'}}</td>
            <td>{{$district->longitude or 'N/A'}}</td>
            <td>{{$district->latitude or 'N/A'}}</td>
            <td><a href="/map/{{$district->name}}/{{$district->id}}/bus_routes" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-eye-open"></span></a></td>
            <td><a href="{{route('dashboard.admin.districts.edit', $district->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{route('dashboard.admin.districts.confirm', $district->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
          </tr>
          @endforeach
        @endif
    </tbody>
  </table>
@endsection
