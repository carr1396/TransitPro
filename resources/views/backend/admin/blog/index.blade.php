@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('tab-content')
  <a href="{{route('dashboard.admin.blog.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create New Blog Post</a>
  <table class='table table-striped  table-hover'>
    <thead>
      <tr>
        <th>Title</th>
        <th>Slug</th>
        <th>Author</th>
        <th>Published</th>
        <th>Visit</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
        <tr class="{{$post->present()->publishedHighlight()}}">
          <td>{{$post->title}}</td>
          <td>{{$post->slug}}</td>
          <td>{{$post->authored->name()}}</td>
          <td>{{$post->present()->publishedDate()}}</td>
          <td><a href="{{route('blog.post', [$post->id, $post->slug])}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a></td>
          <td><a href="{{route('dashboard.admin.blog.edit', $post->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a href="{{route('dashboard.admin.blog.confirm', $post->id)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="6">
            No Posts Added yet
          </td>
        </tr>
        @endforelse
    </tbody>
  </table>
  {!! $posts->render() !!}
@endsection
