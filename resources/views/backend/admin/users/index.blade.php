@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
  <a href="{{route('dashboard.admin.users.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create Users</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
          <td>{{$user->name()}}</td>
          <td>{{$user->email}}</td>
          <td><a href="{{route('dashboard.admin.users.edit', $user->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a href="{{route('dashboard.admin.users.confirm', $user->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="4">
            No Users Yet
          </td>
        </tr>
        @endforelse
    </tbody>
  </table>
  {!! $users->render() !!}
@endsection
