@extends('layouts.backend')
@section('sidebar')
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href=""><i class="fa fa-dashboard fa-fw"></i> {{Auth::user()->display_name ?: Auth::user()->name()}}</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
@endsection
@section('content')
  @yield('tab-content')
@endsection
