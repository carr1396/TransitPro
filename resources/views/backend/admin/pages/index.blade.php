@extends('layouts.admin')

@section('tab-content')
  <a href="{{route('dashboard.admin.pages.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create Page</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Title</th>
        <th>Name</th>
        <th>URI</th>
        <th>Template</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @if ($pages->isEmpty())
          <tr>
            <td colspan="5">
              No Pages Yet
            </td>
          </tr>
        @else
          @foreach ($pages as $page)
          <tr class="{{$page->hidden?'warning':''}}">
            <td>
              {!! $page->present()->linkToPaddedTitle(route('dashboard.admin.pages.edit', $page->id)) !!}

              {{-- <span>{{$page->padded_title}}</span> --}}
            </td>
            <td>{{$page->name or 'N/A'}}</td>
            @if ($page->hidden)
            <td>{{$page->present()->prettyUri()}}</td>
            @else
            <td><a href="{{url($page->uri)}}">{{$page->present()->prettyUri()}}</a></td>
            @endif
            <td>{{$page->template or 'N/A'}}</td>
            <td><a href="{{route('dashboard.admin.pages.edit', $page->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{route('dashboard.admin.pages.confirm', $page->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
          </tr>
          @endforeach
        @endif
    </tbody>
  </table>
@endsection
