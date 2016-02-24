<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') &mdash; Transit Pro</title>

  <link rel="stylesheet" href="{{url('fonts/nixie.css')}}">
  <link rel="stylesheet" href="{{theme('css/backend.css')}}">
  <link rel="icon" href="/favicon.ico">
  <script src="{{theme('js/all.js')}}" charset="utf-8"></script>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-backend navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="glyphicon glyphicon-arrow-down"></span>
    </button> --}}
    <a class="navbar-brand" href="/account">TransitPro</a>

  </div>
  <!-- /.navbar-header -->
  {{-- <div class="navbar-collapse-navbar navbar-collapse"> --}}

  @if(Auth::user())
    <ul class="nav navbar-nav  navbar-top-links navbar-left navbar-collapse">
      <li>
        <a href="/"> <i class="fa fa-user fa-fw"></i>Site</a>
      </li>
      <li class="{{isActiveRoute('backend.account.index')}}">
        <a href="{{route('backend.account.index')}}"><i class="fa fa-user fa-fw"></i>Account</a>
      </li>
      @if (Auth::user()->isAdmin())
        <li class="{{isActiveRoute('admin.index')}}">
          <a href="{{route('admin.index')}}"> <i class="fa fa-user fa-fw"></i> Administration</a>
        </li>
      @endif
      {{-- @if (Auth::user()->isStaff())
        <li class="{{isActiveRoute('dashboard.staff.index')}}">
          <a href="{{route('dashboard.staff.index')}}"> <i class="fa fa-user fa-fw"></i> Staff</a>
        </li>
      @endif --}}
    </ul>
  @endif
  <ul class="nav navbar-top-links navbar-right navbar-collapse">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-messages">
        <li>
          <a href="#">
            <div>
              <strong>John Smith</strong>
              <span class="pull-right text-muted">
                <em>Yesterday</em>
              </span>
            </div>
            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
          </a>
        </li>
        <li class="divider"></li>
      </ul>
      <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->

    <!-- /.dropdown -->
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-user">
      </li>
      <li><a href="/account/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
      </li>
      @if (Auth::user())
        <li class="{{isActiveRoute('backend.account.index')}}">
          <a href="{{route('backend.account.index')}}"><i class="fa fa-user fa-fw"></i>Account</a>
        </li>
        @if (Auth::user()->isAdmin())
          <li class="{{isActiveRoute('admin.index')}}">
            <a href="{{route('admin.index')}}"> <i class="fa fa-user fa-fw"></i> Admin</a>
          </li>
        @endif
      @endif
      <li class="divider"></li>
      @if(Auth::user())
        <li><span class="navbar-text">Hello, {{Auth::user()->display_name ?: Auth::user()->name()}}</span></li>
        <li><a href="{{route('auth.logout')}}"> <i class="fa fa-sign-in fa-fw"></i> Logout</a></li>
      @else
        <li><a href="{{route('auth.login')}}"><i class="fa fa-sign-out fa-fw"></i> Login</a></li>
      @endif
    </ul>
    <!-- /.dropdown-user -->
  </li>
  <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

@yield('sidebar')
<!-- /.navbar-static-side -->
</nav>

<div id="page-wrapper">
  <div class="toolbar">@yield('toolbar')</div>
  <div class='row'>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 '>
      {{-- <h3>@yield('title')</h3> --}}
      @if($errors->any())

        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errors!</strong>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if($status)
        <div class="alert alert-info  alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <p>
            {{$status}}
          </p>
        </div>
      @endif

      <div>@yield('content')</div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->
@include('main-footer')
<script charset="utf-8" src="{{theme('js/logCharts.js')}}"></script>
<script charset="utf-8">

  $(document).ready(function() {

    var sideHeight = $('.sidebar').outerHeight();
    var wrapperHeight = $('#page-wrapper').outerHeight();
    var diff1 = sideHeight - wrapperHeight;
    var diff2 =wrapperHeight -  sideHeight;
    $('.main-footer').css('margin-top', diff1>0?diff1:diff2);
    if(diff1<0){
      $('.main-footer').css('display', 'none');
    }
  });
</script>
</body>
</html>
