<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') &mdash; TransitPro</title>
    <link rel="stylesheet" href="{{url('fonts/nixie.css')}}">
    <link rel="stylesheet" href="{{theme('css/backend.css')}}" media="screen" title="no title" charset="utf-8">
    <link rel="icon" href="/favicon.ico">
  </head>
  <style media="screen">
    body{
      background: #0b6c95;
    }
  </style>
  <body>
    <div class='container'>
      <div class="row vertical-center">
        <div class='col-md-3'>

        </div>
        <div class='col-md-6'>
          <div class="col-md-12 text-center">
            <img src="{{theme('images/icon.png')}}" alt="Transit Pro" class="icon-half" />
          </div>
          <div class="panel panel-{{$errors->any() ? 'danger': 'default'}} panel-login">
            <div class="panel-heading">
              <h3 class="panel-title text-center">@yield('heading')</h3>
            </div>
            <div class="panel-body">
              @if($errors->any())
              <div class="alert alert-danger">
                <strong>Errors!</strong>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              @if($status)
                <div class="alert alert-info">
                  <p>
                    {{$status}}
                  </p>
                </div>
              @endif
              @yield('content')
            </div>
          </div>
        </div>
        <div class='col-md-3'>

        </div>
      </div>
    </div>
  </body>
</html>
