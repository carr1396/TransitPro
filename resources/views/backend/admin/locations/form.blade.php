@extends('layouts.admin')
@section('title', $location->exists ? 'Editing '.$location->name : ' Create New location' )

@section('tab-content')
<p class="pull-right"><a href="{{route('dashboard.admin.locations.index')}}">See All locations</a></p>

  <div class='container-fluid '>
    <div class="row">

      <div class="col-md-12">
        @if(count($districts)<=0)
          <div class="alert alert-danger">There Are No Districts Added Please Add District Before Locations</div>
        @endif
        {!! Form::model($location, [
          'method' => $location->exists ? 'put': 'post',
          'route' => $location->exists ? ['dashboard.admin.locations.update', $location->id]: ['dashboard.admin.locations.store']
          ]) !!}
          <div class="col-sm-12">
            <div class="form-group">
              {!!  Form::label('name') !!}
              {!!  Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              {!!  Form::label('district_id') !!}
              <div class="input-group">
                <span class="input-group-addon">*</span>
                {!!  Form::select('district_id', $districts,null, ['class' => 'form-control' , 'required' =>'Required']) !!}
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              {!!  Form::label('latitude') !!}
              {!!  Form::text('latitude', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              {!!  Form::label('longitude') !!}
              {!!  Form::text('longitude', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              {!!  Form::label('address') !!}
              {!!  Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              {!!  Form::label('description') !!}
              {!!  Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="form-group pull-right">
            {!!  Form::submit($location->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
