@extends('layouts.account')

@section('title', 'Account')

@section('content')

  {{Auth::user()->name()}} Profile
  <div class="row">
    <div class="col-sm-10">
      @include('backend.partials.profile', ['user' => Auth::user()])
    </div>
  </div> 
@endsection
