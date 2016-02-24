<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; TransitPro</title>

    <link rel="stylesheet" href="{{url('fonts/nixie.css')}}">
    <link rel="stylesheet" href="{{theme('css/frontend.css')}}">
    <link rel="icon" href="/favicon.ico">
    <script src="{{theme('js/all.js')}}" charset="utf-8"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img src="{{theme('images/logo-128.png')}}" alt="TransitPro" />
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            @include('partials.navigation')
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::user())

              <li class="dropdown">
                <a href="#">
                  Hello, {{Auth::user()->display_name ?: Auth::user()->name()}}
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="">
                  <li class="{{isActiveRoute('backend.account.index')}}">
                    <a href="{{route('backend.account.index')}}"><span class="fa fa-fw fa-user"></span> Account</a>
                  </li>
                  <li class="{{isActiveRoute('auth.logout')}}">
                    <a href="{{route('auth.logout')}}"> <span class="fa fa-fw fa-sign-out"></span> Logout</a>
                  </li>
                </ul>
              </li>
            @endif
            @if(!Auth::user())
               <li><a href="{{route('auth.login')}}">Login</a></li>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class='wrapper'>
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
      @yield('content')
    </div>
    @include('main-footer')
  </body>
</html>
