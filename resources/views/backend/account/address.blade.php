@extends('layouts.account')

@section('title', 'Addressing Information')

@section('content')

  <h2>{{Auth::user()->name()}} Profile Addressing Information</h2>
  <div class="row">
    <div class="col-sm-12">
      @if(Auth::user())
        {!! Form::model(Auth::user(), [
          'method' => 'put',
          'route' =>  ['backend.account.address.store', Auth::user()->id]
          ]) !!}
            <div class="form-group">
              {!!  Form::label('address') !!}
              <div class="input-group">
                <span class="input-group-addon addon-danger">*</span>
                {!!  Form::text('address', null, ['class' => 'form-control', 'placeholder'=>'Address 1', 'required'=>'Address 1']) !!}
              </div>
            </div>
            <div class="form-group">
              {!!  Form::label('address2', 'Address 2 (Optional) ') !!}
              <div class="input-group">
                <span class="input-group-addon addon-info">o</span>
                {!!  Form::text('address2', null, ['class' => 'form-control', 'placeholder'=>'Address 2']) !!}
              </div>
            </div>
            <div class="form-group">
              {!!  Form::label('phone') !!}
              <div class="input-group">
                <span class="input-group-addon addon-danger">*</span>
                {!!  Form::text('phone', null, ['class' => 'form-control', 'placeholder'=>'Phone Number', 'required'=>'required']) !!}
              </div>
            </div>
            <div class="form-group">
              {!!  Form::label('phone2', 'Phone 2 (Optional) ') !!}
              <div class="input-group">
                <span class="input-group-addon addon-info">o</span>
                {!!  Form::text('phone2', null, ['class' => 'form-control', 'placeholder'=>'Secondary Phone Number']) !!}
              </div>
            </div>
          <div class="form-group pull-left">
            {!!  Form::submit('Update Your Addressing Information', ['class' => 'btn btn-primary']) !!}
          </div>
        {!! Form::close() !!}

      @else
        <div class="jumbotron-hr">
          <p>Failed To Load Profile Data</p>
        </div>
      @endif
    </div>
  </div>
@endsection
