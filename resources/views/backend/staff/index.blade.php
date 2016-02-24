@extends('layouts.staff')

@section('title', 'Account')

@section('content')

  {{Auth::user()->name()}} Profile
  <div class="row">
  
  </div>
@endsection
