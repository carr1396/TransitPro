@extends('backend.admin.index')
@section('title', 'Views '.$view_logs['unique']. ' Unique vistor(s)')

  @section('administrator-logs')
    <div class="col-md-12 text-center">
      <h3>Day Visit Logs:</h3>
      <div class="log-chart" id='log-chart-day'>

      </div>
    </div>
    {{-- <canvas id="day-chart-canvas" width="300" height="300"></canvas> --}}
    <div class="col-md-12 text-center">
      <h3>Year Visit Logs:</h3>
      <div class="log-chart" id='log-chart-year'>

      </div>
    </div>
    <br>
    {{-- <canvas id="year-chart-canvas" width="300" height="300"></canvas> --}}
    @include('footer')

  @endsection
