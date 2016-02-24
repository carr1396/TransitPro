@extends('backend.images.manager')

@section('title', $image->exists ? 'Editing '.$image->name : 'Create User Image')

@section('manager-content')

    {!! Form::model($image, [
      'method' => $image->exists ? 'put': 'image',
      'route' => $image->exists ? ['backend.images.update', $image->id]: ['backend.images.store'],
      'files'=>true
      ]) !!}

     <!-- image name Form Input -->
     @if(!$image->exists)
       <div class="form-group">
          {!! Form::label('name', 'Image name:') !!}
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
       </div>

       <!-- mobile_image_name Form Input -->
       <div class="form-group">
          {!! Form::label('mobile_image_name', 'Mobile Image Name:') !!}
          {!! Form::text('mobile_image_name', null, ['class' => 'form-control']) !!}
       </div>
     @endif





     <!-- is_something Form Input -->
     <div class="form-group">
        {!! Form::label('is_active', 'Is Active:') !!}
        {!! Form::checkbox('is_active') !!}
     </div>

     <!-- is_featured Form Input -->
     <div class="form-group">
        {!! Form::label('is_featured', 'Is Featured:') !!}
        {!! Form::checkbox('is_featured') !!}
     </div>

     <div class="form-group">
        {!! Form::label('is_private', 'Is Private:') !!}
        {!! Form::checkbox('is_private') !!}
     </div>

    <!-- form field for file -->
    <div class="form-group">
       {!! Form::label('image', 'Primary Image') !!}
       {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
    </div>

     <!-- form field for file -->
     <div class="form-group">
        {!! Form::label('mobile_image', 'Mobile Image') !!}
        {!! Form::file('mobile_image', null, array('required', 'class'=>'form-control')) !!}
     </div>

     <div class="form-group pull-right">
       {!!  Form::submit($image->exists ?'Upload Changes':'Upload New Image', ['class' => 'btn btn-primary']) !!}
     </div>

    {!! Form::close() !!}
@endsection
