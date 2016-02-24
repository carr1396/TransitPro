@extends('layouts.admin')

@section('tab-content')
  <a href="{{route('dashboard.admin.troutes.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create troute</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Start</th>
        <th>End</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @if ($troutes->isEmpty())
          <tr>
            <td colspan="5">
              No troutes Yet
            </td>
          </tr>
        @else
          @foreach ($troutes as $troute)
          <tr class="{{$troute->active?'success':''}}">
            <td>{{$troute->name or 'N/A'}}</td>
            <td>{{$troute->start->name or 'N/A'}}</td>
            <td>{{$troute->end->name or 'N/A'}}</td>
            <td><a href="{{route('dashboard.admin.troutes.edit', $troute->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{route('dashboard.admin.troutes.confirm', $troute->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
          </tr>
          @endforeach
        @endif
    </tbody>
  </table>
@endsection
