@extends('layouts.admin')
@section('title', $troute->exists ? 'Editing '.$troute->name : ' Create New troute' )

@section('tab-content')
<p class="pull-right"><a href="{{route('dashboard.admin.troutes.index')}}">See All Transit Routes</a></p>

  <div class='container-fluid '>
    <div class="row">

      <div class="col-md-12">
        @if(count($locations)<=0)
          <div class="alert alert-danger">There Are No locations Added Please Add location Before troutes</div>
        @endif
        {!! Form::model($troute, [
          'method' => $troute->exists ? 'put': 'post',
          'route' => $troute->exists ? ['dashboard.admin.troutes.update', $troute->id]: ['dashboard.admin.troutes.store']
          ]) !!}
          @if($troute->exists)
            <div class="col-sm-4">
              <div class="checkbox">
                <label for="active" >
                  {{-- {!!  Form::checkbox('hidden') !!} --}}
                  {{ Form::checkbox('active', '1', $troute->active) }}
                  Active
                  <span class="help-block text-muted"></span>
                </label>
              </div>
            </div>
          @endif
          <div class="col-sm-12">
            <div class="form-group">
              {!!  Form::label('name') !!}
              {!!  Form::text('name', null, ['class' => 'form-control']) !!}
              <span class="help-block text-muted">Transit Route Names Should Be short utmost 3 letters (number or character) and all alphabets should be capitalized. It is easiar to name each route starting with the abbreviation of the the district it starts in.</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!!  Form::label('start_location') !!}
              <div class="input-group">
                <span class="input-group-addon">*</span>
                {!!  Form::select('start_location', $locations,null, ['class' => 'form-control' , 'required' =>'Required']) !!}
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!!  Form::label('end_location') !!}
              <div class="input-group">
                <span class="input-group-addon">*</span>
                {!!  Form::select('end_location', $locations,null, ['class' => 'form-control' , 'required' =>'Required']) !!}
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              {!!  Form::label('expectedDuration') !!}
              {!!  Form::text('expectedDuration', null, ['class' => 'form-control bfh-number']) !!}
              <p class="help-block">Optional value can be added later</p>
            </div>
          </div>
          <div class="form-group pull-right">
            {!!  Form::submit($troute->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
