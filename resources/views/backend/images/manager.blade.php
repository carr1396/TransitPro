@extends('layouts.account')

@section('content')
<div class="col-xs-12">
  <ul class="nav nav-tabs">

    <li class="nav-item {{isActiveRoute('backend.images.index')}}">
        <a href="{{route('backend.images.index')}}" class="nav-link {{isActiveRoute('backend.images.index')}}"><i class="fa fa-file-image-o fa-fw"></i>All User Images</a>
    </li>
    <li class="nav-item {{isActiveRoute('backend.images.create')}}">
        <a href="{{route('backend.images.create')}}" class="nav-link {{isActiveRoute('backend.images.create')}}"><i class="fa fa-plus fa-fw"></i><i class="fa fa-file-image-o fa-fw"></i>Create</a>
    </li>
    {{-- <li class="nav-item {{isActiveRoute('backend.images.index')}}">
        <a href="{{route('backend.images.index')}}" class="nav-link {{isActiveRoute('backend.images.index')}}"><i class="fa fa-file-image-o fa-fw"></i>All User Images</a>
    </li> --}}
  </ul>
  @yield('manager-content')
</div>
@endsection
