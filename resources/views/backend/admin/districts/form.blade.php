@extends('layouts.admin')
@section('title', $district->exists ? 'Editing '.$district->name : ' Create New district' )

@section('tab-content')
<p class="pull-right"><a href="{{route('dashboard.admin.districts.index')}}">See All districts</a></p>
  <div class='container-fluid '>
    <div class="row">
      <div class="col-md-12">
        {!! Form::model($district, [
          'method' => $district->exists ? 'put': 'post',
          'route' => $district->exists ? ['dashboard.admin.districts.update', $district->id]: ['dashboard.admin.districts.store']
          ]) !!}
          @if($district->exists)
            <div class="col-sm-4">
              <div class="checkbox">
                <label for="active" >
                  {{-- {!!  Form::checkbox('hidden') !!} --}}
                  {{ Form::checkbox('active', '1', $district->active) }}
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
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {!!  Form::label('abbreviation') !!}
              {!!  Form::text('abbreviation', null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              {!!  Form::label('squareArea', 'Square Area (Km)') !!}
              {!!  Form::text('squareArea', null, ['class' => 'form-control']) !!}
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
          <div class="col-sm-4">
            <div class="form-group">
              {!!  Form::label('elevation') !!}
              {!!  Form::text('elevation', null, ['class' => 'form-control']) !!}
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
            {!!  Form::submit($district->exists ?'Save':'Create', ['class' => 'btn btn-primary']) !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
