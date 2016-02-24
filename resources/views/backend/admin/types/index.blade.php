@extends('layouts.admin')

@section('content')


<h2 class="page-header">{{ ucfirst('vehicle types') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('types') }}
        <a href="{{route('dashboard.admin.types.create')}}" class="btn btn-xs btn-primary pull-right" role="button">
          <span class="glyphicon glyphicon-plus"></span>
           New Type
         </a>
    </div>
    <div class="container-fluid">
        <table class="table table-striped" id="thegrid">
          <thead>
            <tr>
              <th>Id</th>
              <th>Dame</th>
              <th>Description</th>
              <th style="width:50px"></th>
              <th style="width:50px"></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($types as $type)
            <tr>
              <td>
                {{$type->id}}
              </td>
              <td>
                {{$type->name}}
              </td>
              <td>
                <p>{{$type->description}}</p>
              </td>
              <td>
                <a href="{{route('dashboard.admin.types.edit', $type->id)}}" class="btn btn-xs btn-primary" title="Edit">
                  <span class="glyphicon glyphicon-edit"></span>
                </a>
              </td>
              <td>
                <a href="{{route('dashboard.admin.types.confirm', $type->id)}}" class="btn btn-xs btn-danger" title="Delete">
                  <span class="glyphicon glyphicon-remove-sign"></span>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5">
                <p>No Types Added Yet</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <p>{{$types->render()}}</p>
</div>


@endsection
