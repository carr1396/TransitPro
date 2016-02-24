@extends('layouts.backend')


@section('sidebar')
  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
        <a href="#" class="thumbnail">
          @if(Auth::user()->image)
            <img src="{{Auth::user()->image}}" alt="{{Auth::user()->name()}}" class="img-fluid">
          @else
            <img src="{{theme('/images/icon.png')}}" alt="{{Auth::user()->name()}}" class="img-fluid">
          @endif
        </a>
        <li>
          <a href=""><i class="fa fa-dashboard fa-fw"></i> {{Auth::user()->display_name ?: Auth::user()->name()}}</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-files-o fa-fw"></i> Pages <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.pages.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.pages.create')}}">Create</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-sticky-note fa-fw"></i> Posts <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.blog.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.blog.create')}}">Create</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Users <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.users.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.users.create')}}">Create</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Vehicles <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.vehicles.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.vehicles.create')}}">Create</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Vehicle Types <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.types.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.types.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Orders <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.orders.index')}}">Show All</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Drivers <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.drivers.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.drivers.create')}}">Create</a>
            </li>
          </ul>
          <!-- /.nav-second-level -->
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Districts <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.districts.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.districts.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Locations <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.locations.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.locations.create')}}">Create</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fa fa-users fa-fw"></i> Routes <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="{{route('dashboard.admin.troutes.index')}}">Show All</a>
            </li>
            <li>
              <a href="{{route('dashboard.admin.troutes.create')}}">Create</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.sidebar-collapse -->
  </div>
@endsection
@section('toolbar')
  <a class="btn btn-default btn-sm" href="/account/administrator" role="button">Activities</a>
  <a class="btn btn-primary btn-sm" href="/account/administrator/site/views" role="button">Views</a>
@endsection
@section('content')
  @yield('tab-content')
@endsection
