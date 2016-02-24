@extends('layouts.admin')
@section('tab-content')
  <div class='container-fluid log-container'>
    <div class="row ">
      <section class="col-md-12">
        @yield('administrator-logs')
      </section>
    </div>
  </div>
  
@endsection
