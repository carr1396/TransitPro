@extends('layouts.account')

@section('title', 'Account')

@section('content')

  <h2>{{Auth::user()->name()}} Profile</h2>
  <div class="row">
    <div class="col-sm-10">
      @include('backend.partials.profile', ['user' => Auth::user()])
    </div>
  </div>
@endsection
