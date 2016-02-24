@extends('layouts.backend')
@section('sidebar')
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            {{-- <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li> --}}
            <a href="#" class="thumbnail">
              @if(Auth::user()->image)
                <img src="{{Auth::user()->image}}" alt="{{Auth::user()->name()}}" class="img-fluid">
              @else
                <img src="{{theme('/images/icon.png')}}" alt="{{Auth::user()->name()}}" class="img-fluid">
              @endif
            </a>
            <li class="{{isActiveRoute('backend.account.index')}}">
                <a href="{{route('backend.account.index')}}"><i class="fa fa-dashboard fa-fw"></i> {{Auth::user()->display_name ?: Auth::user()->name()}}</a>
            </li>
            <li class="{{isActiveRoute('backend.account.settings')}}">
                <a href="{{route('backend.account.settings')}}"><i class="fa fa-cogs fa-fw"></i>  Settings</a>
            </li>
            <li class="{{isActiveRoute('backend.account.address')}}">
                <a href="{{route('backend.account.address')}}"><i class="fa fa-location-arrow fa-fw"></i> Address Information</a>
            </li>
            <li class="{{isActiveRoute('account.orders.index')}}">
                <a href="{{route('account.orders.index')}}"><i class="fa fa-shopping-cart fa-fw"></i> Orders</a>
            </li>
            <li class="{{isActiveRoute('backend.images.index')}}">
                <a href="{{route('backend.images.index')}}"><i class="fa fa-file-image-o fa-fw"></i> Image Manager</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
@endsection
@section('content')
  @yield('tab-content')
@endsection
